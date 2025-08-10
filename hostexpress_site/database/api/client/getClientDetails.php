<?php 

include_once dirname(__DIR__, 2) . '/config/config.php';
include_once dirname(__DIR__, 2) . '/middleware/authMiddleware.php';
require_once modules . '/responseManager.php';
require_once modules . '/clientManager.php';

try {
  $authData = authMiddleware();

  Client::getClientByEmail($authData['sub']);
} catch (\Exception $e) {
  Response::handleException($e);
} 

?>
