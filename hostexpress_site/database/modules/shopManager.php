<?php 

require_once dirname(__DIR__, 1) . '/config/config.php';
require_once dirname(__DIR__, 1) . '/middleware/authMiddleware.php';
require_once __DIR__ . '/responseManager.php';
include_once root . '/conexao.php';
$Conexao = Conexao::conectar();
$authData = authMiddleware();

class Shop
{
  /**
   * Função para buscar todos os produtos da loja
   */
  public static function getAllProducts(): void
  {
    try {
      global $Conexao, $authData;
      $email = $authData['sub'];
        
      $query = "
        SELECT * FROM he_produtos A
        INNER JOIN he_empresas B ON A.EMPRESA_ID = B.EMPRESA_ID
        WHERE B.EMAIL = :email
      ";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      if ($stmt->rowCount() > 0) {
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        Response::success($products, 'Produtos buscados com sucesso');
      } else {
        Response::notFound('Nenhum produto encontrado');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function getProductById(int $id): void
  {
    try {
      global $Conexao;

      if (empty($id)) {
        Response::badRequest('ID do produto não informado');
      }

      $query = "SELECT * FROM he_produtos WHERE PRODUTO_ID = :id";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        Response::success($product, 'Produto encontrado');
      } else {
        Response::notFound('Produto não encontrado');
      }
    } catch (\Exception $e) {
      Response::handleException($e);
    }
  }

  public static function addProduct(array $data): void
  {
    try {
      global $Conexao, $auth;
      $email = $auth->user('email');

      foreach($data as $key => $value) {
        if(empty($value)) {
          Response::badRequest("Campo {$key} não pode ser vazio");
        }
      }

      // Buscar EMPRESA_ID pelo email da sessão
      if (empty($email)) {
        Response::badRequest('Usuário não autenticado');
      }
      $queryEmpresa = "SELECT EMPRESA_ID FROM he_empresas WHERE EMAIL = :email LIMIT 1";
      $stmtEmpresa = $Conexao->prepare($queryEmpresa);
      $stmtEmpresa->bindParam(':email', $email, PDO::PARAM_STR);
      $stmtEmpresa->execute();
      $empresa = $stmtEmpresa->fetch(PDO::FETCH_ASSOC);
      if (!$empresa) {
        Response::notFound('Empresa não encontrada para o usuário logado');
      }
      $empresaId = $empresa['EMPRESA_ID'];

      $query = "
        INSERT INTO he_produtos (DESCRICAO, CATEGORIA, UNIDADE, QTD, PRECO_UN, EMPRESA_ID)
        VALUES (:descr, :category, :unit, :qtd, :price, :shopID)
      ";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':descr', $data['DESCR'], PDO::PARAM_STR);
      $stmt->bindParam(':qtd', $data['QTD'], PDO::PARAM_STR);
      $stmt->bindParam(':category', $data['CATEGORY'], PDO::PARAM_STR);
      $stmt->bindParam(':price', $data['PRICE'], PDO::PARAM_STR);
      $stmt->bindParam(':unit', $data['UNITY'], PDO::PARAM_STR);
      $stmt->bindParam(':shopID', $empresaId, PDO::PARAM_INT);

      if ($stmt->execute()) {
        $productId = $Conexao->lastInsertId();
        Response::success(['productId' => $productId], 'Produto adicionado com sucesso');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function updateProduct(array $data): void
  {
    try {
      global $Conexao;

      if (empty($data)) {
        Response::badRequest('ID do produto ou dados incompletos');
      }
  
      $query = "
        UPDATE he_produtos 
        SET DESCRICAO = :description, CATEGORIA = :category, UNIDADE = :unit, PRECO_UN = :price 
        WHERE PRODUTO_ID = :id
      ";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':description', $data['DESCR'], PDO::PARAM_STR);
      $stmt->bindParam(':category', $data['CATEGORY'], PDO::PARAM_STR);
      $stmt->bindParam(':unit', $data['UNITY'], PDO::PARAM_STR);
      $stmt->bindParam(':price', $data['PRICE'], PDO::PARAM_STR);
      $stmt->bindParam(':id', $data['ID'], PDO::PARAM_INT);
  
      if ($stmt->execute()) {
        Response::success([], 'Produto atualizado com sucesso');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function deleteProduct(int $id): void
  {
    try {
      global $Conexao;

      if (empty($id)) {
        Response::badRequest('ID do produto não informado');
      }
  
      $query = "DELETE FROM he_produtos WHERE PRODUTO_ID = :id";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  
      if ($stmt->execute()) {
        Response::success([], 'Produto deletado com sucesso');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function registerShop(array $data): void
  {
    try {
      global $Conexao;

      foreach ($data as $key => $value) {
        if (empty($value)) {
          Response::badRequest("Campo {$key} não pode estar vazio");
        }
      }
  
      // Insere na tabela he_empresas
      $sql1 = "INSERT INTO he_empresas
        (CNPJ, ATIVO, RAZAO_SOCIAL, NOME_FANTASIA, TELEFONE, ENDERECO, ENDERECO_NUM, CIDADE, BAIRRO, CEP, COMPLEMENTO, EMAIL, ESPECIALIDADE)
        VALUES (:CNPJ, 'S', :RAZAO_SOCIAL, :NOME, :TELEFONE, :ENDERECO, :ENDERECO_NUM, :CIDADE, :BAIRRO, :CEP, :COMPLEMENTO, :EMAIL, :ESPECIALIDADE)";
      $stmt1 = $Conexao->prepare($sql1);
      $stmt1->bindParam(':CNPJ', $data['CNPJ'], PDO::PARAM_STR);
      $stmt1->bindParam(':RAZAO_SOCIAL', $data['RAZAO_SOCIAL'], PDO::PARAM_STR);
      $stmt1->bindParam(':NOME', $data['NOME'], PDO::PARAM_STR);
      $stmt1->bindParam(':TELEFONE', $data['TELEFONE'], PDO::PARAM_STR);
      $stmt1->bindParam(':ENDERECO', $data['ENDERECO'], PDO::PARAM_STR);
      $stmt1->bindParam(':ENDERECO_NUM', $data['ENDERECO_NUM'], PDO::PARAM_STR);
      $stmt1->bindParam(':CIDADE', $data['CIDADE'], PDO::PARAM_STR);
      $stmt1->bindParam(':BAIRRO', $data['BAIRRO'], PDO::PARAM_STR);
      $stmt1->bindParam(':CEP', $data['CEP'], PDO::PARAM_STR);
      $stmt1->bindParam(':COMPLEMENTO', $data['COMPLEMENTO'], PDO::PARAM_STR);
      $stmt1->bindParam(':EMAIL', $data['EMAIL'], PDO::PARAM_STR);
      $stmt1->bindParam(':ESPECIALIDADE', $data['ESPECIALIDADE'], PDO::PARAM_STR);
      $stmt1->execute();

      $SENHA_HASH = password_hash($data['SENHA'], PASSWORD_DEFAULT);

      // Insere na tabela he_users
      $sql2 = "INSERT INTO he_users(USER, PASSWORD, TYPE, NAME)
          VALUES(:EMAIL, :SENHA, 'SHOP', :RAZAO_SOCIAL)";
      $stmt2 = $Conexao->prepare($sql2);
      $stmt2->bindParam(':EMAIL', $data['EMAIL'], PDO::PARAM_STR);
      $stmt2->bindParam(':SENHA', $SENHA_HASH, PDO::PARAM_STR);
      $stmt2->bindParam(':RAZAO_SOCIAL', $data['RAZAO_SOCIAL'], PDO::PARAM_STR);
      $stmt2->execute();

      if ($stmt2->execute()) {
        Response::success([], 'Loja registrada com sucesso!');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function getShopInfo(): void
  {
    try {
      global $Conexao, $auth;
      $email = $auth->user('email');

      if (empty($email)) {
        Response::badRequest('Usuário ainda não autenticado');
      }

      $query = "SELECT * FROM he_empresa WHERE EMAIL = :email";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();

      if ($stmt->rowCount() > 0) {
        $shopInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        Response::success($shopInfo, 'Informações da loja buscadas com sucesso');
      } else {
        Response::notFound('Loja não encontrada');
      }
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function updateShopInfo(array $data): void
  {
    try {
      global $Conexao, $auth;
      $email = $auth->user('email');

      if (empty($email)) {
        Response::badRequest('Usuário ainda não autenticado');
      }
      foreach($data as $key => $value) {
        if(empty($value)){
          Response::badRequest("Campo {$key} não pode estar vazio");
        }
      }
  
      $query = "
        UPDATE he_empresa 
        SET NOME = :name, CNPJ = :cnpj, ENDERECO = :address, TELEFONE = :phone 
        WHERE EMAIL = :email
      ";
      $stmt = $Conexao->prepare($query);
      $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
      $stmt->bindParam(':cnpj', $data['cnpj'], PDO::PARAM_STR);
      $stmt->bindParam(':address', $data['address'], PDO::PARAM_STR);
      $stmt->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
        Response::success([], 'Informações da loja atualizadas com sucesso');
      } 
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }

  public static function updateProductPhoto(string $path, int $id) :void
  {
    try {
      global $Conexao;

      $query = "
        UPDATE he_produtos
        SET FOTO_PRODUTO = :path
        WHERE PRODUTO_ID = :id;
      ";
      $stm = $Conexao->prepare($query);
      $stm->bindParam(':path', $path, PDO::PARAM_STR);
      $stm->bindParam(':id', $id, PDO::PARAM_INT);
      $stm->execute();
      Response::success([], 'Foto adicionada');
    } catch (PDOException $e) {
      Response::internalError($e->getMessage());
    } catch (Exception $e) {
      Response::sendJson($e->getCode(), $e->getMessage());
    }
  }
}