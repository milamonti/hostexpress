<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
require '../PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

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

    exit(json_encode([
        'status' => true
    ]));
} catch (\Exception $e) {
    http_response_code($e instanceof PDOException ? (500) : $e->getCode());
    exit(json_encode([
        'status' => false,
        'message' => 'Error on sending code: '. $e->getMessage() . ' on line ' .$e->getLine()
    ]));
}