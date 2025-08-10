<?php 

require dirname(__DIR__, 1) . '/config/config.php';
require_once root . '/database/modules/responseManager.php';
require_once root . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(root);
$dotenv->load();

class Payment {
  private string $accessToken;

  private array $headers;
  
  public function __construct() {
    $this->accessToken = $_ENV['accessToken'];
    $this->headers  = [
      'Authorization' => "Bearer {$this->accessToken}",
      'accept' => 'application/json',
      'content-type' => 'application/json',
      'x-client-id' => '<your-client-id>',
      'x-client-secret' => '<your-client-secret>',
    ];
  }

  
}

?>
