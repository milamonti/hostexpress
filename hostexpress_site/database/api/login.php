<?php

require_once '../config/config.php';
include_once ROOT . '/database/modules/responseManager.php';
include_once ROOT . '/database/modules/authManager.php';

if(!$_POST['EMAIL'] || !$_POST['SENHA']){
  Response::badRequest();
}

// Instancia a classe Auth e executa o login do usuário
$auth = new Auth();
$auth->login($_POST['EMAIL'], $_POST['SENHA']);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Pragma: no-cache");
