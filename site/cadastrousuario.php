<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'conexao.php';

$conexao = new Conexao();
$db = $conexao->conectar();
if (!$db) {
    die("Erro na conexão com o banco de dados.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $celular = $_POST['celular'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $endereco = $_POST['rua'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $endereconum = $_POST['num'] ?? '';
    $complemento = $_POST['complemento'] ?? '';

    if (empty($nome) || empty($celular) || empty($email) || empty($senha) || empty($cep) || empty($endereco) || empty($bairro) || empty($cidade) || empty($estado) || empty($endereconum)) {
        echo json_encode(['success' => false, 'Message' => 'Todos os campos são obrigatórios.']);
        exit();
    }

    //$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO clientes (nome, celular, email, senha, cep, endereco, bairro, cidade, estado, endereconum, complemento) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $celular);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $senha);
        $stmt->bindParam(5, $cep);
        $stmt->bindParam(6, $endereco);
        $stmt->bindParam(7, $bairro);
        $stmt->bindParam(8, $cidade);
        $stmt->bindParam(9, $estado);
        $stmt->bindParam(10, $endereconum);
        $stmt->bindParam(11, $complemento);

        $stmt->execute();

        $_SESSION['user_id'] = $db->lastInsertId();

        header('Location: index.html');
        exit;
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'Message' => $e->getMessage()]);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $sql = "SELECT bairro FROM clientes WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $bairro = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($bairro) {
        echo json_encode(['bairro' => $bairro['bairro']]);
    } else {
        echo json_encode(['bairro' => 'Bairro não encontrado']);
    }
}
?>
