<?php

require_once dirname(__DIR__, 1) . '/config/config.php';
require ROOT . '/vendor/autoload.php';
require_once ROOT . '/modules/responseManager.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class User
{
  private string $secretKey;
  private string $issuer = 'https://hostexpress.ct.ws';
  private string $audience = 'https://hostexpress.ct.ws';
  private int $tokenLifetime = 3600; // 1 hora

  public function __construct() {
    $this->secretKey = getenv('secretKey');
  }

  /**
   * Gera e retorna o token JWT com dados do usuário
   * O mesmo é utilizado no localStorage do navegador
   * para requisições futuras do usuário
   * @param userData array contendo as informações de login do usuário
   * @return token uma string codificada em JWT 
   * contendo as informações da sessão do usuário  
   */
  public function generateToken(array $userData): string
  {
    $payload = [
      'iss'   => $this->issuer,
      'aud'   => $this->audience,
      'iat'   => time(),
      'exp'   => time() + $this->tokenLifetime,
      'sub'   => $userData['id'],
      'nome'  => $userData['nome'],
      'email' => $userData['email']
    ];

    return JWT::encode($payload, $this->secretKey, 'HS256');
  }

  /**
   * Valida o token enviado via Authorization header
   */
  public function validateToken(): void
  {
    $jwt = $this->getTokenFromHeader();

    try {
      JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
    } catch (ExpiredException $e) {
      Response::unauthorized('Token expirado.');
    } catch (\Exception $e) {
      Response::sendJson($e->getCode(), 'Erro ao validar o token: ' . $e->getMessage());
    }
  }

  /**
   * Retorna um campo específico do token
   * @param field Recebe o campo que será buscado
   * @return Response Retorna em array a chave e valor do campo buscado
   */
  public function getTokenField(string $field): void
  {
    $jwt = $this->getTokenFromHeader();

    try {
      $decoded = JWT::decode($jwt, new Key($this->secretKey, 'HS256'));
      $value = $decoded->$field ?? null;

      if ($value === null) {
        Response::notFound("Campo '{$field}' não encontrado no token.");
      }

      Response::success(['field' => $field, 'value' => $value]);
    } catch (ExpiredException $e) {
      Response::unauthorized('Token expirado.');
    } catch (\Exception $e) {
      Response::sendJson($e->getCode(), 'Erro ao decodificar token: ' . $e->getMessage());
    }
  }

  /**
   * Busca o token enviado no header da requisição
   * @return token Retorna o token enviado,
   * ou envia um erro 401 de não autorizado
   */
  public function getTokenFromHeader(): ?string
  {
    $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

    if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
      return $matches[1];
    }

    Response::unauthorized('Token de autenticação ausente ou malformado.');
  }
}
