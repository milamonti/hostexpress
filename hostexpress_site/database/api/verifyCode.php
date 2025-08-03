<?php

if(session_status() == PHP_SESSION_NONE){
  session_start();
}

require_once '../config/config.php';
require_once MODULES . '/responseManager.php';
require ROOT . '/libs/PHPMailer/PHPMailer.php';
require ROOT . '/libs/PHPMailer/SMTP.php';
require ROOT . '/libs/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$code = $_POST['CODE'];
$email = $_POST['EMAIL'];

$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'hostexpressjundiai@gmail.com';
  $mail->Password = 'kwvs ukak jgel gjvi'; 
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom('hostexpressjundiai@gmail.com', 'HostExpress');
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = 'Código de Verificação - HostExpress';
  $mail->Body = "Olá! Seja bem-vindo ao HostExpress! Seu código de verificação é: <strong>$code</strong>";
  $mail->send();

  Response::success([], 'Código enviado!');
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao enviar o código: ' . $e->getMessage());
}
