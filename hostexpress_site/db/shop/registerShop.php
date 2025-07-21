<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

header('Content-Type: application/json;charset=utf-8');

include_once '../../conexao.php';
$conexao = Conexao::conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $CNPJ = $_POST['CNPJ'];
        $RAZAO_SOCIAL = $_POST['RAZAO_SOCIAL'];
        $NOME = $_POST['NOME'];
        $TELEFONE = $_POST['TELEFONE'];
        $ENDERECO = $_POST['ENDERECO'];
        $ENDERECO_NUM = $_POST['ENDERECO_NUM'];
        $CIDADE = $_POST['CIDADE'];
        $BAIRRO = $_POST['BAIRRO'];
        $CEP = $_POST['CEP'];
        $COMPLEMENTO = $_POST['COMPLEMENTO'] ?? null;
        $EMAIL = $_POST['EMAIL'];
        $ESPECIALIDADE = $_POST['ESPECIALIDADE'];
        $SENHA = $_POST['SENHA'];

        $SENHA_HASH = password_hash($SENHA, PASSWORD_DEFAULT);

        // Verifica se o usuário já existe
        $check = $conexao->prepare("SELECT 1 FROM he_users WHERE USER = :EMAIL");
        $check->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
        $check->execute();
        if ($check->fetch()) {
            http_response_code(409);
            exit(json_encode(['message' => 'Usuário já existe']));
        }

        // Insere na tabela he_empresas
        $sql1 = "INSERT INTO he_empresas
            (CNPJ, ATIVO, RAZAO_SOCIAL, NOME_FANTASIA, TELEFONE, ENDERECO, ENDERECO_NUM, CIDADE, BAIRRO, CEP, COMPLEMENTO, EMAIL, ESPECIALIDADE)
            VALUES (:CNPJ, 'S', :RAZAO_SOCIAL, :NOME, :TELEFONE, :ENDERECO, :ENDERECO_NUM, :CIDADE, :BAIRRO, :CEP, :COMPLEMENTO, :EMAIL, :ESPECIALIDADE)";
        $stmt1 = $conexao->prepare($sql1);
        $stmt1->bindParam(':CNPJ', $CNPJ, PDO::PARAM_STR);
        $stmt1->bindParam(':RAZAO_SOCIAL', $RAZAO_SOCIAL, PDO::PARAM_STR);
        $stmt1->bindParam(':NOME', $NOME, PDO::PARAM_STR);
        $stmt1->bindParam(':TELEFONE', $TELEFONE, PDO::PARAM_STR);
        $stmt1->bindParam(':ENDERECO', $ENDERECO, PDO::PARAM_STR);
        $stmt1->bindParam(':ENDERECO_NUM', $ENDERECO_NUM, PDO::PARAM_STR);
        $stmt1->bindParam(':CIDADE', $CIDADE, PDO::PARAM_STR);
        $stmt1->bindParam(':BAIRRO', $BAIRRO, PDO::PARAM_STR);
        $stmt1->bindParam(':CEP', $CEP, PDO::PARAM_STR);
        $stmt1->bindParam(':COMPLEMENTO', $COMPLEMENTO, PDO::PARAM_STR);
        $stmt1->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
        $stmt1->bindParam(':ESPECIALIDADE', $ESPECIALIDADE, PDO::PARAM_STR);
        $stmt1->execute();

        // Insere na tabela he_users
        $sql2 = "INSERT INTO he_users(USER, PASSWORD, TYPE, NAME)
            VALUES(:EMAIL, :SENHA, 'SHOP', :RAZAO_SOCIAL)";
        $stmt2 = $conexao->prepare($sql2);
        $stmt2->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
        $stmt2->bindParam(':SENHA', $SENHA_HASH, PDO::PARAM_STR);
        $stmt2->bindParam(':RAZAO_SOCIAL', $RAZAO_SOCIAL, PDO::PARAM_STR);
        $stmt2->execute();

        echo json_encode(['status' => true]);
        exit;
    } catch (\Exception $e) {
        http_response_code($e instanceof PDOException ? 500 : $e->getCode());
        exit(json_encode([
            'status' => false,
            'message' => $e->getMessage() .' on line '. $e->getLine()
        ]));
    }
}