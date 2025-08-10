<?php

include_once dirname(__DIR__, 1) . '/config/config.php';
require_once modules . '/userManager.php';
require_once modules . '/responseManager.php';
require root . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(root);
$dotenv->load();

/**
 * Função que realiza a autenticação do usuário
 * por meio da decodificação do token armazenado
 * no cookie da sessão. Caso encontrado retorna as 
 * informações armazenadas nele, do contrário retorna um 
 * JSON com código HTTP 403 de forbidden: 'Usuário não autenticado
 */
function authMiddleware()
{
  $user = new User();
  $token = $user->getTokenFromCookie();

  if (!$token) {
    Response::forbidden('Usuário ainda não autenticado.');
  }

  try {
    $decoded = \Firebase\JWT\JWT::decode(
      $token,
      new \Firebase\JWT\Key($_ENV['secretKey'], 'HS256')
    );

    // Transforma em array
    return (array) $decoded;
  } catch (\Firebase\JWT\ExpiredException $e) {
    Response::forbidden('Sessão expirada.');
  } catch (\Exception $e) {
    Response::forbidden('Erro ao autenticar usuário. ' . $e->getMessage());
  }
}

?>
