<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


class deleteProspec extends SITE_ADMIN
{
    public function deleteProspec($PRC_IDPROSPEC_CLIENTES)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "DELETE FROM PRC_PROSPEC_CLIENTES WHERE PRC_IDPROSPEC_CLIENTES = :PRC_IDPROSPEC_CLIENTES";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':PRC_IDPROSPEC_CLIENTES', $PRC_IDPROSPEC_CLIENTES, PDO::PARAM_STR);
            $stmt->execute();

            echo "Prospecção deletada com sucesso.";
            

        } catch (PDOException $e) {  
            echo "Não foi possível deletar a prospecção.";
        } 
    }
}

// Processa a requisição GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
 
     $deleteProspec = new deleteProspec();
     $deleteProspec->deleteProspec($id);
 }
 ?>