<?php

class Response
{
  // Constantes já definidas de códigos de retorno HTTP
  const HTTP_OK = 200;
  const HTTP_CREATED = 201;
  const HTTP_ACCEPTED = 202;
  const HTTP_BAD_REQUEST = 400;
  const HTTP_UNAUTHORIZED = 401;
  const HTTP_FORBIDDEN = 403;
  const HTTP_NOT_FOUND = 404;
  const HTTP_METHOD_NOT_ALLOWED = 405;
  const HTTP_CONFLICT = 409;
  const HTTP_UNPROCESSABLE_ENTITY = 422;
  const HTTP_INTERNAL_SERVER_ERROR = 500;

  /**
   * Função que principal da classe que retorna um JSON para o JavaScript,
   * com as informações sobre a requisição
   * @param status Código HTTP da requisição
   * @param message Mensagem enviada para a requisição
   * @param data Informações buscadas na requisição.
   * 
   * Todas as outras funções posteriormente usam esta para enviar
   * retorno já pré-definido para o Front-end
   */
  public static function sendJson(int $status, string $message, array $data = []): void
  {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-cache, must-revalidate');

    $response = [
      'status' => $status,
      'success' => $status < 400,
      'message' => $message,
      'data' => $data
    ];

    exit(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
  }

  public static function success(array $data = [], string $message = 'Operação realizada com sucesso'): void
  {
    self::sendJson(self::HTTP_OK, $message, $data);
  }

  public static function created(array $data = [], string $message = 'Recurso criado com sucesso'): void
  {
    self::sendJson(self::HTTP_CREATED, $message, $data);
  }

  public static function accepted(array $data = [], string $message = 'Requisição aceita para processamento'): void
  {
    self::sendJson(self::HTTP_ACCEPTED, $message, $data);
  }

  public static function badRequest(string $message = 'Requisição inválida ou malformada'): void
  {
    self::sendJson(self::HTTP_BAD_REQUEST, $message);
  }

  public static function unauthorized(string $message = 'Acesso não autorizado'): void
  {
    self::sendJson(self::HTTP_UNAUTHORIZED, $message);
  }

  public static function forbidden(string $message = 'Acesso negado'): void
  {
    self::sendJson(self::HTTP_FORBIDDEN, $message);
  }

  public static function notFound(string $message = 'Recurso não encontrado'): void
  {
    self::sendJson(self::HTTP_NOT_FOUND, $message);
  }

  public static function methodNotAllowed(string $message = 'Método de requisição não permitido'): void
  {
    self::sendJson(self::HTTP_METHOD_NOT_ALLOWED, $message);
  }

  public static function conflict(string $message = 'Conflito na requisição'): void
  {
    self::sendJson(self::HTTP_CONFLICT, $message);
  }

  public static function internalError(string $message = 'Erro interno do servidor'): void
  {
    self::sendJson(self::HTTP_INTERNAL_SERVER_ERROR, $message);
  }

  /**
   * Executa a saída correta quando ocorre uma exceção no código
   * @param Exception $e Recebe uma exceção qualquer em alguma requisição
   */
  public static function handleException(\Exception $e) :void
  {
    if($e instanceof PDOException){
      self::internalError($e->getMessage());
    } else {
      self::sendJson($e->getCode(), $e->getMessage());
    }
  }
}

?>
