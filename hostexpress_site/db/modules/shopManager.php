<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/conexao.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/hostexpress_site/db/modules/responseManager.php';
$Conexao = Conexao::conectar();

class Shop
{
    /**
     * Função para buscar todos os produtos da loja
     */
    public static function getAllProducts(): void
    {
        try {
            global $Conexao;
            
            $query = "
                SELECT * FROM he_produtos A
                INNER JOIN he_empresa B ON A.EMPRESA_ID = B.EMPRESA_ID
                WHERE B.EMAIL = :email
            ";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':email', $_SESSION['EMAIL'], PDO::PARAM_STR);
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
                Response::notFound([], 'Produto não encontrado');
            }
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        }
    }

    public static function addProduct(array $data): void
    {
        try {
            global $Conexao;
    
            foreach($data as $key => $value) {
                if(empty($value)) {
                    Response::badRequest("Campo ${key} não pode ser vazio");
                }
            }
    
            $query = "
                INSERT INTO he_produtos (NOME, DESCRICAO, CATEGORIA, UNIDADE, CATEGORIA, PRECO_UN, EMPRESA_ID) 
                VALUES (:name, :description, :category, :price, :unit, :category, :shopID)
            ";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':unit', $data['unit'], PDO::PARAM_STR);
            $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
            $stmt->bindParam(':shopID', $data['shopID'], PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                Response::success([], 'Produto adicionado com sucesso');
            } else {
                Response::error('Erro ao adicionar produto');
            }
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        }
    }

    public static function updateProduct(int $id, array $data): void
    {
        try {
            global $Conexao;
    
            if (empty($id) || empty($data)) {
                Response::badRequest('ID do produto ou dados incompletos');
            }
    
            $query = "
                UPDATE he_produtos 
                SET DESCRICAO = :description, CATEGORIA = :category, UNIDADE = :unit, PRECO_UN = :price 
                WHERE PRODUTO_ID = :id
            ";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindParam(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
            $stmt->bindParam(':unit', $data['unit'], PDO::PARAM_STR);
            $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                Response::success([], 'Produto atualizado com sucesso');
            } else {
                Response::error('Erro ao atualizar produto');
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
            } else {
                Response::error('Erro ao deletar produto');
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
    
            if ($stmt->execute()) {
                Response::success([], 'Loja registrada com sucesso');
            } else {
                Response::error('Erro ao registrar loja');
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
            global $Conexao;
    
            if (empty($_SESSION['EMAIL'])) {
                Response::badRequest('Usuário ainda não autenticado');
            }
    
            $query = "SELECT * FROM he_empresa WHERE EMAIL = :email";
            $stmt = $Conexao->prepare($query);
            $stmt->bindParam(':email', $_SESSION['EMAIL'], PDO::PARAM_STR);
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
            global $Conexao;
    
            if (empty($_SESSION['EMAIL'])) {
                Response::badRequest('Loja ainda não autenticada');
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
            $stmt->bindParam(':email', $_SESSION['EMAIL'], PDO::PARAM_STR);
    
            if ($stmt->execute()) {
                Response::success([], 'Informações da loja atualizadas com sucesso');
            } else {
                Response::error('Erro ao atualizar informações da loja');
            }
        } catch (PDOException $e) {
            Response::internalError($e->getMessage());
        } catch (Exception $e) {
            Response::sendJson($e->getCode(), $e->getMessage());
        }
    }
}