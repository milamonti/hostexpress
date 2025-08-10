<?php

require_once __DIR__ . '/../config/config.php';
require_once root . '/conexao.php';
include_once __DIR__ . '/responseManager.php';
$Conexao = Conexao::conectar();

class Auth
{
  private int $timeout = 1800;

  public function __construct()
  {
    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }

    $this->checkSessionTimeout();
  } 

  // === Sessão ===

  /**
   * Função usada para definir valores na sessão do usuário
   * @param key Chave definida na sessão
   * @param value Valor para a chave atribuída
  */
  public function set(string $key, mixed $value): void
  {
    $_SESSION[$key] = $value;
  }

  /**
   * Função usada para buscar valores na sessão do usuário
   * @param key Chave buscada na sessão
   * @return value Valor da chave definida na sessão
  */
  public function get(string $key, mixed $default = null): mixed
  {
    return $_SESSION[$key] ?? $default;
  }

  /**
   * Função usada para verificar se um usuário possui uma chave definida na sessão
   * @param key Valor buscado na sessão
   * @return bool Retorna verdadeiro ou falso dependendo
   * da presença da chave na sessão  
  */
  public function has(string $key): bool
  {
    return isset($_SESSION[$key]);
  }

  /**
   * Função usada para remover uma chave da sessão
   * @param key Valor removido da sessão
  */
  public function remove(string $key): void
  {
    unset($_SESSION[$key]);
  }

  /**
   * Função que regenera o id da sessãp
   */
  public function regenerate(): void
  {
    session_regenerate_id(true);
  }

  /**
   * Função que destrói a sessão
   */
  public function destroy(): void
  {
    $_SESSION = [];
    session_destroy();
  }

  private function updateLastActivity(): void
  {
    $_SESSION['_last_activity'] = time();
  }

  private function checkSessionTimeout(): void
  {
    $last = $_SESSION['_last_activity'] ?? time();
    if (time() - $last > $this->timeout) {
      $this->logout();
    } else {
      $this->updateLastActivity();
    }
  }

  // === Autenticação ===

  public function authenticateUser(string $email, string $password) :?array
  {
    global $Conexao;

    $email = strtolower(trim($email));
    $password = trim($password);

    $QUERY = <<<SQL
      SELECT NAME, PASSWORD, TYPE
      FROM he_users
      WHERE USER = :EMAIL
    SQL;

    $stm = $Conexao->prepare($QUERY);
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
        'email' => $email,
        'name' => $response['NAME'],
        'role' => $response['TYPE']
      ];
    }

    Response::unauthorized('Usuário ou senha incorretos!');
    return null;
  }

  public function login(string $email, string $password): void
  {
    $this->regenerate();
    $authData = $this->authenticateUser($email, $password);

    if ($authData) {
      $_SESSION['auth'] = [
        'email' => $authData['email'],
        'name' => $authData['name'],
        'role' => $authData['role']
      ];
      $this->updateLastActivity();
      Response::success();
    }
  }

  public function logout(): void
  {
    $this->destroy();
    session_start();
  }

  public  function isLoggedIn(): bool
  {
    return isset($_SESSION['auth']);
  }

  public  function user(string $campo): mixed
  {
    if (!$this->isLoggedIn()) return null;

    if ($campo === null) {
      return $_SESSION['auth'];
    }

    return $_SESSION['auth'][$campo] ?? null;
  }

  public  function hasRole(string $role): bool
  {
    return $this->user('role') === $role;
  }
}

?>