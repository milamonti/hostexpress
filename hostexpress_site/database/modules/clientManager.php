<?php 

require_once '../config/config.php';
require_once __DIR__ . '/responseManager.php';
include_once ROOT . '/conexao.php';
$Conexao = Conexao::conectar();

class Client 
{
  /**
   * Função para buscar todos os clientes
   */
  public static function getAllClients(): void
  {
    try {
      global $Conexao;

      $query = "SELECT * FROM he_clientes";
      $stmt = $Conexao->prepare($query);
      $stmt->execute();
  
      if ($stmt->rowCount() > 0) {
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::success($clients, 'Clientes buscados com sucesso');
      } else {
        Response::notFound('Nenhum cliente encontrado');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    } 
  }

    /**
     * 
     * Função que busca o cliente pelo e-mail já autenticado no login
     * @param email $email
     * @return void
     * 
     **/
    public static function getClientByEmail(String $email): void
    {
        try {
            global $Conexao;
    
            if (empty($email)) {
                Response::badRequest('E-mail não informado');
            }
    
            $query = "
                SELECT A.* 
                FROM he_clientes A
                INNER JOIN he_users B ON A.EMAIL = B.USER
                WHERE B.USER = :email
            ";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $client = $stmt->fetch(PDO::FETCH_ASSOC);
                Response::success($client, 'Cliente encontrado');
            } else {
                Response::notFound([], 'Cliente não encontrado');
            }
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        } 
    }

    public static function updateClient(String $id)
    {
        try {
            global $Conexao;
        
            $query = "
                UPDATE he_clientes
                SET NOME = :NOME, EMAIL = :EMAIL,
                    TELEFONE = :TELEFONE, CEP = :CEP,
                    ENDERECO = :ENDERECO, ENDERECO_NUM = :ENDERECO_NUM,
                    BAIRRO = :BAIRRO, CIDADE = :CIDADE
                WHERE ID = :ID	
            ";
            $stm = $Conexao->prepare($query);
            $stm->bindParam(':NOME', $NOME, PDO::PARAM_STR);
            $stm->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
            $stm->bindParam(':TELEFONE', $TELEFONE, PDO::PARAM_STR);
            $stm->bindParam(':ENDERECO', $ENDERECO, PDO::PARAM_STR);
            $stm->bindParam(':ENDERECO_NUM', $ENDERECO_NUM, PDO::PARAM_STR);
            $stm->bindParam(':BAIRRO', $BAIRRO, PDO::PARAM_STR);
            $stm->bindParam(':CIDADE', $CIDADE, PDO::PARAM_STR);
            $stm->bindParam(':ID', $ID, PDO::PARAM_STR);
            $stm->bindParam(':CEP', $CEP, PDO::PARAM_STR);
            $stm->execute();
            Response::success([], 'Cliente atualizado com sucesso');
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        }
    }

    public static function deleteClient(String $id): void
    {
        try {
            global $Conexao;
    
            if (empty($id)) {
                Response::badRequest('ID do cliente não informado');
                return;
            }
    
            $query = "DELETE FROM he_clientes WHERE ID = :id";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                Response::success([], 'Cliente deletado com sucesso');
            } else {
                Response::notFound([], 'Cliente não encontrado ou já deletado');
            }
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        }
    }

  public static function registerClient(array $data): void
  {
    try {
      global $Conexao;

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
      $check = $conexao->prepare("SELECT 1 FROM he_users WHERE USER = :EMAIL");
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
      $stm1 = $conexao->prepare($query1);
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
      $stm2 = $conexao->prepare($query2);
      $stm2->bindParam(':EMAIL', $EMAIL, PDO::PARAM_STR);
      $stm2->bindParam(':SENHA', $SENHA_HASH, PDO::PARAM_STR);
      $stm2->bindParam(':NOME', $NOME, PDO::PARAM_STR);
      $stm2->execute();

      Response::success([], 'Cliente registrado com sucesso');        
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), 'Erro ao registrar cliente: ' . $e->getMessage());
    }
  }           
}

?>