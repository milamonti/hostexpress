<?php

include_once dirname(__DIR__, 1) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once modules . '/userManager.php';

if($_SERVER['REQUEST_METHOD'] !== "POST"){
  Response::methodNotAllowed();
}

if(!$_POST['EMAIL'] || !$_POST['SENHA']){
  Response::badRequest();
}

// Instancia a classe User e gera o JWT do usuário
$user = new User();
$user->login($_POST['EMAIL'], $_POST['SENHA']);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Pragma: no-cache");

?>
