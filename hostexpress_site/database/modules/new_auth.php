<?php

require_once '../config/config.php';
include_once ROOT . '/conexao.php';
$Conexao = Conexao::conectar();

class JWTAuthWithDB
{
    private string $secretKey;
    private string $refreshSecret;
    private string $alg = 'HS256';
    private int $accessExpire;
    private int $refreshExpire;

    public function __construct(string $secretKey, string $refreshSecret, int $accessExpire = 900, int $refreshExpire = 604800)
    {
      $this->secretKey = $secretKey;
      $this->refreshSecret = $refreshSecret;
      $this->accessExpire = $accessExpire;
      $this->refreshExpire = $refreshExpire;
    }

    public function login(string $username, string $password): ?array
    {
      global $Conexao;
      $stmt = $Conexao->prepare("SELECT id, full_name, password_hash, role FROM users WHERE username = ?");
      $stmt->execute([$username]);
      $row = $stmt->fetch(\PDO::FETCH_ASSOC);
      if (!$row || !password_verify($password, $row['password_hash'])) {
        return null;
      }

      $payload = ['sub' => $row['id'], 'username' => $username, 'nome' => $row['full_name'], 'role' => $row['role']];
      $accessToken = $this->generateToken($payload, $this->accessExpire, $this->secretKey);
      $refreshToken = $this->generateToken(['sub' => $row['id']], $this->refreshExpire, $this->refreshSecret);

      return ['access_token' => $accessToken, 'refresh_token' => $refreshToken];
    }

    public function refresh(string $refreshToken): ?string
    {
        $data = $this->validateToken($refreshToken, $this->refreshSecret);
        if (!$data) return null;

        $stmt = $Conexao->prepare("SELECT username, full_name, role FROM users WHERE id = ?");
        $stmt->execute([$data['sub']]);
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) return null;

        $payload = ['sub' => $data['sub'], 'username' => $row['username'], 'nome' => $row['full_name'], 'role' => $row['role']];
        return $this->generateToken($payload, $this->accessExpire, $this->secretKey);
    }

    public function authorize(): ?array
    {
        $auth = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
        if (!preg_match('/Bearer\s+(.+)/', $auth, $m)) return null;

        return $this->validateToken($m[1], $this->secretKey);
    }

    private function generateToken(array $payload, int $expireInSec, string $key): string
    {
        $header = ['alg' => $this->alg, 'typ' => 'JWT'];
        $payload['exp'] = time() + $expireInSec;
        $payload['iat'] = time();
        $base64Header = $this->base64UrlEncode(json_encode($header));
        $base64Payload = $this->base64UrlEncode(json_encode($payload));
        $signature = $this->sign("$base64Header.$base64Payload", $key);
        return "$base64Header.$base64Payload.$signature";
    }

    private function validateToken(string $token, string $key): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) return null;
        [$h,$p,$s] = $parts;
        if (!hash_equals($this->sign("$h.$p", $key), $s)) return null;
        $pl = json_decode($this->base64UrlDecode($p), true);
        if (!$pl || time() > ($pl['exp'] ?? 0)) return null;
        return $pl;
    }

    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    private function base64UrlDecode(string $data): string
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
    private function sign(string $data, string $key): string
    {
        return $this->base64UrlEncode(hash_hmac('sha256', $data, $key, true));
    }
}