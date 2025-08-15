<?php 

require_once dirname(__DIR__, 1) . '/config/config.php';

define('paymentMode', 'sandbox');

$pagseguroApi = paymentMode === "sandbox" 
  ? 'https://sandbox.api.pagseguro.com' 
  : 'https://api.pagseguro.com';

?>
