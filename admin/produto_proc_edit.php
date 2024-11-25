<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


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
               
        } catch (PDOException $e) {  
            echo "ERRO: Não foi possível atualizar o produto.";  
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
