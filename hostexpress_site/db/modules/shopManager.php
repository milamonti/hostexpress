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
    }

    public static function getProductById(int $id): void
    {
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
    }

    public static function addProduct(array $data): void
    {
        global $Conexao;

        if (
            empty($data['name']) || 
            empty($data['price']) || 
            empty($data['category']) ||
            empty($data['unit']) ||
            empty($data['description']) ||
            empty($data['shopID'])
        ) {
            Response::badRequest('Dados do produto incompletos');
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
    }
}