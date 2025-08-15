<?php 

require_once dirname(__DIR__, 1) . '/config/config.php';
require_once __DIR__ . '/responseManager.php';
include_once root . '/conexao.php';
$Connection = Connection::connect();

class Client 
{
  /**
   * Função para buscar todos os clientes cadastrados
  */
  public static function getAllClients(): void
  {
    try {
      global $Connection;

      $query = "SELECT * FROM he_clientes";
      $stmt = $Connection->prepare($query);
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::success($clients, 'Clientes buscados com sucesso');
      } else {
        Response::notFound('Nenhum cliente encontrado');
      }
    } catch(\Exception $e){
      Response::handleException($e);
    }
  }

  /** 
   * Função que busca o cliente pelo e-mail já autenticado no login
   * @param email email do cliente 
  */
  public static function getClientByEmail(String $email): void
  {
    try {
      global $Connection;

      if (!isset($email)) {
        Response::badRequest('E-mail não informado');
      }
  
      $query = "
        SELECT A.* 
        FROM he_clientes A
        INNER JOIN he_users B ON A.EMAIL = B.USER
        WHERE B.USER = :email
      ";
      $stmt = $Connection->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
        $client = $stmt->fetch(PDO::FETCH_ASSOC);
        Response::success($client, 'Cliente encontrado');
      } else {
        Response::notFound('Cliente não encontrado');
      }
    } catch(\Exception $e){
      Response::handleException($e);
    }
  }

  /**
   * Função que atualiza as informações do cliente
   * @param id ID do cliente
   * @param data Array com as informações novas do cliente
   */
  public static function updateClient(string $id, array $data) :void
  {
    try {
      global $Connection;
      
      $query = <<<SQL
        UPDATE he_clientes
        SET NOME = :NOME, EMAIL = :EMAIL,
          TELEFONE = :TELEFONE, CEP = :CEP,
          ENDERECO = :ENDERECO, ENDERECO_NUM = :ENDERECO_NUM,
          BAIRRO = :BAIRRO, CIDADE = :CIDADE
        WHERE ID = :ID	
      SQL;
      $stm = $Connection->prepare($query);
      $stm->bindParam(':NOME', $data['NOME'], PDO::PARAM_STR);
      $stm->bindParam(':EMAIL', $data['EMAIL'], PDO::PARAM_STR);
      $stm->bindParam(':TELEFONE', $data['TELEFONE'], PDO::PARAM_STR);
      $stm->bindParam(':ENDERECO', $data['ENDERECO'], PDO::PARAM_STR);
      $stm->bindParam(':ENDERECO_NUM', $data['ENDERECO_NUM'], PDO::PARAM_STR);
      $stm->bindParam(':BAIRRO', $data['BAIRRO'], PDO::PARAM_STR);
      $stm->bindParam(':CIDADE', $data['CIDADE'], PDO::PARAM_STR);
      $stm->bindParam(':ID', $id, PDO::PARAM_STR);
      $stm->bindParam(':CEP', $data['CEP'], PDO::PARAM_STR);
      $stm->execute();
      Response::success([], 'Cliente atualizado com sucesso');
    } catch(\Exception $e){
      Response::handleException($e);
    }
  }

  /**
   * Função que exclui os dados de um cliente
   * @param string $id ID do cliente
   */
  public static function deleteClient(String $id): void
  {
    try {
      global $Connection;

      if (empty($id)) {
        Response::badRequest('ID do cliente não informado');
        return;
      }
  
      $query = "DELETE FROM he_clientes WHERE ID = :id";
      $stmt = $Connection->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
        Response::success([], 'Cliente deletado com sucesso');
      } else {
        Response::notFound('Cliente não encontrado ou já deletado');
      }
    } catch(\Exception $e){
      Response::handleException($e);
    }
  }

  /**
   * Função que registra um cliente
   * @param array $data Array com as informações do cliente
   */
  public static function registerClient(array $data): void
  {
    try {
      global $Connection;

      if($_SERVER['REQUEST_METHOD'] !== 'POST'){
        Response::methodNotAllowed('Método inválido.');
      }

      foreach($data as $key => $value) {
        if(empty($value)) {
          Response::badRequest("Campo {$key} não pode ser vazio");
        }
      }

      $NOME = $data['NOME'];
      $TELEFONE = $data['TELEFONE'];
      $EMAIL = $data['EMAIL'];
      $SENHA = $data['SENHA'];
      $CEP = $data['CEP'];
      $ENDERECO = $data['ENDERECO'];
      $ENDERECO_NUM = $data['ENDERECO_NUM'];
      $BAIRRO = $data['BAIRRO'];
      $CIDADE = $data['CIDADE'];
      $COMPLEMENTO = $data['COMPLEMENTO'] ?? null;

      $SENHA_HASH = password_hash($SENHA, PASSWORD_DEFAULT);
  
      // Verifica se o usuário já existe
      $check = $Connection->prepare("SELECT 1 FROM he_users WHERE USER = :EMAIL");
      $check->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
      $check->execute();

      if ($check->fetch()) {
        Response::conflict('Usuário já existe');
      }

      // Insere na tabela he_clientes
      $query1 = "
        INSERT INTO he_clientes (NOME, EMAIL, TELEFONE, ENDERECO, ENDERECO_NUM, DATA_CADASTRO, CIDADE, BAIRRO, CEP, COMPLEMENTO)
        VALUES (:NOME, :EMAIL, :TELEFONE, :ENDERECO, :ENDERECO_NUM, NOW(), :CIDADE, :BAIRRO, :CEP, :COMPLEMENTO)
      ";
      $stm1 = $Connection->prepare($query1);
      $stm1->bindParam(':NOME', $NOME, PDO::PARAM_STR);
      $stm1->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
      $stm1->bindParam(':TELEFONE', $TELEFONE, PDO::PARAM_STR);
      $stm1->bindParam(':ENDERECO', $ENDERECO, PDO::PARAM_STR);
      $stm1->bindParam(':ENDERECO_NUM', $ENDERECO_NUM, PDO::PARAM_STR);
      $stm1->bindParam(':CIDADE', $CIDADE, PDO::PARAM_STR);
      $stm1->bindParam(':BAIRRO', $BAIRRO, PDO::PARAM_STR);
      $stm1->bindParam(':CEP', $CEP, PDO::PARAM_STR);
      $stm1->bindParam(':COMPLEMENTO', $COMPLEMENTO, PDO::PARAM_STR);
      $stm1->execute();

      // Insere na tabela he_users
      $query2 = "
        INSERT INTO he_users (USER, PASSWORD, TYPE, NAME)
        VALUES (:EMAIL, :SENHA, 'CLIENT', :NOME)
      ";
      $stm2 = $Connection->prepare($query2);
      $stm2->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
      $stm2->bindParam(':SENHA', $SENHA_HASH, PDO::PARAM_STR);
      $stm2->bindParam(':NOME', $NOME, PDO::PARAM_STR);
      $stm2->execute();

      Response::success([], 'Cliente registrado com sucesso');        
    } catch(\Exception $e){
      Response::handleException($e);
    }
  }           
}

?>