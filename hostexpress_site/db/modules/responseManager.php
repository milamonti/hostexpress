<?php

class Response
{
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

    private static function sendJson(int $status, string $message, array $data = []): void
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

    public static function badRequest(string $message = 'Requisição inválida'): void
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

    public static function methodNotAllowed(string $message = 'Método não permitido'): void
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
     * Verifica o erro do SQL e retorna a resposta filtrada e com o status code correto
     * @param PDOException $e
     */

    public static function sqlError(PDOException $e): void
    {
        $errorInfo = self::getErrorInfoSql($e);
        $statusCode = self::getErrorStatusCodeSql($errorInfo['code']);
        self::sendJson($statusCode, $errorInfo['message'], []);
    }


    private static function getErrorInfoSql(PDOException $e): array
    {
        // Verifica se a exceção possui informações de erro do driver

        $errorInfo = $e->errorInfo;
        $realCode = $errorInfo[1] ?? 0;
        $driverMessage = $errorInfo[2] ?? $e->getMessage();

        if ($realCode > 0 && !empty($driverMessage)) {
            return [
                'code' => (int) $realCode,
                'message' => self::getErrorMessageSql($driverMessage),
                'sqlstate' => $errorInfo[0] ?? '',
                'source' => 'driver_specific'
            ];
        }

        // Se não tiver informações de erro, tenta extrair do throw
        $fallbackCode = self::getErrorCodeSql($e->getMessage());

        return [
            'code' => $fallbackCode ?: (int) $e->getCode(),
            'message' => self::getErrorMessageSql($e->getMessage()),
            'sqlstate' => $errorInfo[0] ?? '',
            'source' => 'fallback'
        ];
    }
    /**
     * Extrai o código de erro do throw do sql
     */
    private static function getErrorCodeSql(string $message): ?int
    {
        $patterns = [
            '/Mensagem\s+(\d+)/i',
            '/Error\s+(\d+)/i',
            '/Code\s+(\d+)/i'
        ];

        // percorre a mensagem e tenta encontrar o código de erro
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $message, $matches)) {
                return (int) $matches[1];
            }
        }
        // se não encontrar nenhum padrão, retorna null
        return null;
    }

    /**
     *  Pega só o essencial da mensagem do erro do sql server
     */
    private static function getErrorMessageSql(string $msg): string
    {
        $patterns = [
            '/^\[Microsoft\]\[ODBC Driver \d+ for SQL Server\]\[SQL Server\]/i',
            '/^SQLSTATE\[[^\]]+\]:\s*\[Microsoft\]\[ODBC Driver \d+ for SQL Server\]\[SQL Server\]/i',
            '/^SQLSTATE\[[^\]]+\]:\s*/i',
            '/^\[SQL Server\]/i',
            '/^Mensagem\s+\d+,\s+Nível\s+\d+,\s+Estado\s+\d+,\s+Linha\s+\d+\s*/i'
        ];


        // percorre todos aqueles padrões de texto de erro do sql e vai removendo
        foreach ($patterns as $pattern) {
            $msg = preg_replace($pattern, '', $msg);
        }

        // retorna a mensagem ja removendo espaços em brancos e caracteres desnecessários
        return trim($msg, " .\r\n\t");
    }
    private static function getErrorStatusCodeSql(int $code): int
    {
        $codes = [
            50400 => self::HTTP_BAD_REQUEST,
            50401 => self::HTTP_UNAUTHORIZED,
            50403 => self::HTTP_FORBIDDEN,
            50404 => self::HTTP_NOT_FOUND,
            50409 => self::HTTP_CONFLICT,
            50500 => self::HTTP_INTERNAL_SERVER_ERROR,
        ];

        if (isset($codes[$code])) {
            return $codes[$code];
        }

        /**
         * códigos personalizados
         */
        if ($code >= 50000 && $code < 60000) {
            $httpCode = $code - 50000;
            return match ($httpCode) {
                400, 401, 403, 404, 405, 409, 500 => $httpCode,
                default => self::HTTP_INTERNAL_SERVER_ERROR,
            };
        }

        return match ($code) {
            2 => self::HTTP_NOT_FOUND,           // Não encontrado
            515 => self::HTTP_BAD_REQUEST,       // Cannot insert NULL
            547 => self::HTTP_CONFLICT,          // Foreign key constraint
            2601 => self::HTTP_CONFLICT,         // Duplicate key
            2627 => self::HTTP_CONFLICT,         // Unique constraint
            8152 => self::HTTP_BAD_REQUEST,      // String truncation
            default => self::HTTP_INTERNAL_SERVER_ERROR,
        };
    }
}
 