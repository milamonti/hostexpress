<?php

require_once dirname(__DIR__, 1) . '/config/config.php';
require_once root . '/conexao.php';
require_once __DIR__ . '/responseManager.php';

$Connection = Connection::connect();

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class User
{
  private string $secretKey;
  private string $issuer = BASE_URL;
  private string $audience = BASE_URL;
  private int $tokenLifetime = 3600; // 1 hora

  public function __construct()
  {
    $this->secretKey = $_ENV['secretKey'];
    // $this->clearToken();
  }

  /**
   * Gera o token JWT com dados do usuário e define no cookie
   * @param userData array com as informações do usuário
   */
  public function generateToken(array $userData): void
  {
    $payload = [
      'iss'   => $this->issuer,
      'aud'   => $this->audience,
      'iat'   => time(),
      'exp'   => time() + $this->tokenLifetime,
      'sub'   => $userData['user'],
      'name'  => $userData['name'],
      'role' => $userData['role']
    ];

    $jwt = JWT::encode($payload, $this->secretKey, 'HS256');

    // Define o cookie HTTP-only
    setcookie(
      'token',
      $jwt,
      [
        'expires'  => time() + $this->tokenLifetime,
        'path'     => '/',
        'secure'   => !XAMPP, // usar HTTPS em produção
        'httponly' => true,
        'samesite' => 'Strict'
      ]
    );

    Response::success([], 'Token salvo no cookie!');
  }

  /**
   * Valida o token enviado via cookie
   */
  public function validateToken() :bool
  {
    $jwt = $this->getTokenFromCookie();

    if (!$jwt) {
      return false;
    }

    try {
      JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
      return true;
    } catch (ExpiredException $e) {
      Response::unauthorized('Token expirado.');
      return false;
    } catch (\Exception $e) {
      Response::handleException($e);
      return false;
    }
  }

  /**
   * Retorna um campo específico do token
   * @param string $field Campo procurado no token
   * @return string $valor Valor do campo buscado no token
   */
  public function getTokenField(string $field) :?string
  {
    $jwt = $this->getTokenFromCookie();

    if (!$jwt) return null;

    try {
      $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));

      $value = $decoded->$field ?? null;

      if ($value === null) return null;

      return (string) $value;
    } catch (ExpiredException $e) {
      return null;
    } catch (\Exception $e) {
      return null;
    }
  }


  /**
   * Obtém o token do cookie
   * @return string|null Retorna o token em string,
   * ou nulo caso não foi encontrado
   */
  public function getTokenFromCookie(): ?string
  {
    return $_COOKIE['token'] ?? null;
  }

  /**
   * Remove o cookie do token (logout)
   */
  public static function clearToken(): void
  {
    setcookie('token', '', [
      'expires' => time() - 3600,
      'path' => '/',
      'secure' => true,
      'httponly' => true,
      'samesite' => 'Strict'
    ]);
  }

  /**
   * Função que autentica o usuário baseado no email e senha
   * enviados pelo POST
   * @param $email Email do usuário
   * @param password Senha do usuário
   * @return Array um array com as informações do usuário ou 
   * nulo em caso de falha 
   */
  public function authenticateUser(string $email, string $password) :?array
  {
    global $Connection;

    $email = strtolower(trim($email));
    $password = trim($password);

    $QUERY = <<<SQL
      SELECT NAME, PASSWORD, TYPE
      FROM he_users
      WHERE USER = :EMAIL
    SQL;

    $stm = $Connection->prepare($QUERY);
    $stm->bindParam(':EMAIL', $email, PDO::PARAM_STR);
    $stm->execute();
    $response = $stm->fetch(PDO::FETCH_ASSOC);

    if (!$response) {
      Response::notFound('Usuário não encontrado!');
      return null;
    }

    if (password_verify($password, $response['PASSWORD'])) {
      // Retorna dados do usuário para uso no login
      return [
        'user' => $email,
        'name' => $response['NAME'],
        'role' => $response['TYPE']
      ];
    }

    Response::unauthorized('Usuário ou senha incorretos!');
    return null;
  }

  public function Login(string $email, string $password) :void
  {
    $userData = $this->authenticateUser($email, $password);

    if(!$userData){
      Response::unauthorized("Falha ao autenticar o usuário");
      return;
    }

    try {
      $this->generateToken($userData);
    } catch (\Exception $e) {
      Response::handleException($e);
    }
  }
}

?>
