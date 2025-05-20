<?php
class Conexao {
    private $host = 'localhost';
    private $dbname = 'hostexpress';
    private $usuario = 'root';
    private $senha = '';
    private $conexao;

    public function conectar() {
        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->senha
            );
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conexao;
        } 
        catch (PDOException $e) {
            echo 'Erro de conexão: ' . $e->getMessage();
            exit;
        }
    }
}
?>
