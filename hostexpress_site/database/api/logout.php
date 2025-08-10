<?php 

include_once dirname(__DIR__, 1) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/userManager.php';

try {
  User::clearToken();
  Response::success();
} catch (\Exception $e) {
  Response::handleException($e);
}

?>
