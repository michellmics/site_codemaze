<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class LoginSystem extends SITE_ADMIN
{
    public function validateUser($email, $password)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "SELECT USA_IDUSERADMIN, USA_DCSENHA, USA_DCEMAIL FROM USA_USERADMIN WHERE USA_DCEMAIL = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Se o usuário for encontrado e a senha for válida
            if ($user && password_verify($password, $user['USA_DCSENHA'])) {
                //session_start(); 
                $_SESSION['user_id'] = $user['USA_IDUSERADMIN']; // Armazena o ID na sessão
                header("Location: dashboard.php"); // Redireciona após login bem-sucedido
                exit();
            } else 
                {
                    $_SESSION = [];
                    session_destroy();
                    echo "Usuário o senha incorretos."; 
                }
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginSystem = new LoginSystem();
    $loginSystem->validateUser($email, $password);
}
?>
