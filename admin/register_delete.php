<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


class deleteUser extends SITE_ADMIN
{
    public function deleteUser($USA_IDUSERADMIN)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "DELETE FROM USA_USERADMIN WHERE USA_IDUSERADMIN = :USA_IDUSERADMIN";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':USA_IDUSERADMIN', $USA_IDUSERADMIN, PDO::PARAM_STR);
            $stmt->execute();

            echo "Usuário deletado com sucesso.";
            

        } catch (PDOException $e) {  
            echo "Não foi possível deletar o usuário.";
        } 
    }
}

// Processa a requisição GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
 
     $deleteUser = new deleteUser();
     $deleteUser->deleteUser($id);
 }
 ?>