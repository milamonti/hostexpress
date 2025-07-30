<?php 

require_once __DIR__ . '/../config/config.php';
include_once ROOT . '/database/modules/responseManager.php';
include_once ROOT . '/database/modules/authManager.php';

$auth = new Auth();
$auth->logout();

?>