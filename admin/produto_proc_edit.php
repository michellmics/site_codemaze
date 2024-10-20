<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class updateProduct extends SITE_ADMIN
{
    public function updateProduct($nome,$tipo,$investimento,$status,$descricao,$id)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }            
            
            $this->updateProductInfo($nome,$tipo,$investimento,$status,$descricao,$id);
            echo "Produto atualizado com sucesso.";
            sleep(4);
            header("Location: table_produto.php");                             
               
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $investimento = $_POST['investimento'];
    $status = $_POST['status'];
    $descricao = $_POST['descricao'];
    $id = $_POST['id'];
    $updateProduct = new updateProduct();
    $result = $updateProduct->updateProduct($nome,$tipo,$investimento,$status,$descricao,$id);
}
?>
