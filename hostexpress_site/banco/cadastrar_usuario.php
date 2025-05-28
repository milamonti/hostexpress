<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once 'conexao.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

$conexao = new Conexao();  
$db = $conexao->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['etapa'] === 'enviar_codigo') {
        $dados = $_POST;

        foreach ($dados as $key => $value) {
            $dados[$key] = trim($value);
        }

        $codigo = rand(100000, 999999); 
        $_SESSION['codigo_verificacao'] = $codigo;
        $_SESSION['dados_cadastro'] = $dados;

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
            $mail->addAddress($dados['email'], $dados['nome']);

            $mail->isHTML(true);
            $mail->Subject = 'Código de Verificação - HostExpress';
            $mail->Body = "Olá <strong>{$dados['nome']}</strong>,<br>Seu código de verificação é: <strong>$codigo</strong>";
            $mail->send();

            echo json_encode(['success' => true, 'message' => 'Código enviado.']);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Erro ao enviar e-mail.', 'erro' => $mail->ErrorInfo]);
        }
        exit;
    }

    if ($_POST['etapa'] === 'verificar_codigo') {
        $codigoEnviado = $_POST['codigo'] ?? '';
        $codigoSalvo = $_SESSION['codigo_verificacao'] ?? '';
        $dados = $_SESSION['dados_cadastro'] ?? [];

        if ($codigoEnviado != $codigoSalvo) {
            echo json_encode(['success' => false, 'message' => 'Código incorreto.']);
            exit;
        }

        try {
            $sql = "INSERT INTO he_clientes 
                    (NOME, EMAIL, SENHA, TELEFONE, ENDERECO, ENDERECO_NUM, CIDADE, BAIRRO, CEP, COMPLEMENTO) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $db->prepare($sql);
            $senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);

            $stmt->execute([
                $dados['nome'], $dados['email'], $senhaHash, $dados['celular'],
                $dados['rua'], $dados['num'], $dados['cidade'], $dados['bairro'],
                $dados['cep'], $dados['complemento']
            ]);

            unset($_SESSION['codigo_verificacao'], $_SESSION['dados_cadastro']);

            echo json_encode(['success' => true, 'message' => 'Cadastro finalizado com sucesso!']);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Erro ao salvar no banco.', 'erro' => $e->getMessage()]);
        }
        exit;
    }
}
?>
