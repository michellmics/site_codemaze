<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class registerUser extends SITE_ADMIN
{
    public function insertUser($email, $senha, $nome, $sexo)
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
            if (isset($user['USA_IDUSERADMIN'])) {
                echo "Usuário já cadastrado."; 
                exit();
            } else 
                {
                    $passHash = password_hash($senha, PASSWORD_DEFAULT);
                    $result = $this->insertUserInfo($email, $nome, $sexo, $passHash);
                    echo "Usuário cadastrado com sucesso."; 
                    
                }
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];

    $registerUser = new registerUser();
    $registerUser->insertUser($email, $senha, $nome, $sexo);
}
?>
