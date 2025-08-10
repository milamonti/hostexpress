<?php

require_once dirname(__DIR__, 1) . '/config/config.php';
require_once modules . '/responseManager.php';
require_once root . '/libs/PHPMailer/PHPMailer.php';
require_once root . '/libs/PHPMailer/SMTP.php';
require_once root . '/libs/PHPMailer/Exception.php';
require_once root . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(root);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD'] !== "POST"){
  Response::methodNotAllowed();
}

if(!$_POST['CODE'] || !$_POST['EMAIL']){
  Response::badRequest('E-mail ou código não enviados corretamente');
}

$code = $_POST['CODE'];
$email = $_POST['EMAIL'];

$mail = new PHPMailer(true);
try {
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'hostexpressjundiai@gmail.com';
  $mail->Password = $_ENV['emailPassword']; 
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
  $mail->Port = 587;

  $mail->setFrom('hostexpressjundiai@gmail.com', 'HostExpress');
  $mail->addAddress($email);

  $mail->isHTML(true);
  $mail->Subject = 'Código de Verificação - HostExpress';
  $mail->Body = $html = str_replace('{{CÓDIGO}}', $code, file_get_contents(dirname(__DIR__, 2) . '/php/emailBody.html'));
  $mail->send();

  Response::success([], 'Código enviado!');
} catch (\Exception $e) {
  Response::sendJson($e->getCode(), 'Erro ao enviar o código: ' . $e->getMessage());
}

?>
