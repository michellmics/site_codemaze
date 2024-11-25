<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


class registerProduct extends SITE_ADMIN
{
    public function insertProduct($nome,$tipo,$investimento,$status,$descricao)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "SELECT PRS_IDPRODUTO_SERVICO FROM PRS_PRODUTO_SERVICO WHERE PRS_NMNOME = :nome";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Se o usuário for encontrado e a senha for válida
            if (isset($user['PRS_IDPRODUTO_SERVICO'])) {
                echo "Produto já está cadastrado."; 
                exit();
            } else 
                {
                    $result = $this->insertProductInfo($nome,$tipo,$investimento,$status,$descricao);
                    echo "Produto cadastrado com sucesso."; 

                    
                     
                }
        } catch (PDOException $e) {  
            echo "Erro ao cadastrar o produto."; 
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
    $registerProduct = new registerProduct();
    $result = $registerProduct->insertProduct($nome,$tipo,$investimento,$status,$descricao);
}
?>
