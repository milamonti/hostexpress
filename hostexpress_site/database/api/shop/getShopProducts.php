<?php 

require_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once dirname(__DIR__, 2) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/shopManager.php';

try {
  
  authMiddleware();
  Shop::getAllProducts();

} catch(\Exception $e){
  Response::handleException($e);
}

?>
