<?php 

require_once dirname(__DIR__, 1) . '/config/config.php';
require_once root . '/vendor/autoload.php';

define('paymentMode', 'sandbox');
define('pagseguro_app_id', '');
define('pagseguro_app_key', '');

$pagseguroApi = paymentMode === "sandbox" 
  ? 'https://sandbox.api.pagseguro.com' 
  : 'https://api.pagseguro.com';

?>
