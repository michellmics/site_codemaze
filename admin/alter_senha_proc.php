<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class LoginSystem extends SITE_ADMIN
{
    public function validaAlterPass($senha, $novasenha, $novasenha_repeat, $id)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            $this->getUserInfoById(1);
            var_dump($this->ARRAY_USERINFOBYID);
            echo "teste 2";
            die();



            /*

            // Prepara a consulta SQL para verificar o usuário
            $sql = "SELECT USA_IDUSERADMIN, USA_DCSENHA, USA_DCEMAIL, USA_DCNOME, USA_DCSEXO FROM USA_USERADMIN WHERE USA_DCEMAIL = :email";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Se o usuário for encontrado e a senha for válida
            if ($user && password_verify($password, $user['USA_DCSENHA'])) {
                $_SESSION['user_id'] = $user['USA_IDUSERADMIN']; // Armazena o ID na sessão
                $_SESSION['user_name'] = $user['USA_DCNOME'];
                $_SESSION['user_email'] = $user['USA_DCEMAIL'];
                $_SESSION['user_sexo'] = $user['USA_DCSEXO'];
                echo '<meta http-equiv="refresh" content="0;url=alter_senha.php">'; // Redireciona após login bem-sucedido
                exit();
            } else 
                {
                    $_SESSION = [];
                    session_destroy();
                    echo "Usuário ou senha incorretos."; 
                }
                    */
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
//if ($_SERVER['REQUEST_METHOD'] === 'POST') 
//{
            $senha = $_POST['senha'];
            $novasenha = $_POST['novasenha'];
            $novasenha_repeat = $_POST['novasenha_repeat'];
            $id = $_SESSION['user_id'];
            echo "aqui1";
            $loginSystem = new LoginSystem();
            $result=$loginSystem->validaAlterPass($senha, $novasenha, $novasenha_repeat, $id);
//}
 
?>

