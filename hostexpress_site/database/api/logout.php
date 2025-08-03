<?php 

require_once __DIR__ . '/../config/config.php';
include_once MODULES . '/responseManager.php';
include_once MODULES . '/authManager.php';

$auth = new Auth();
$auth->logout();

?>