<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário

// Evita cache das páginas
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

class LoginSystem extends SITE_ADMIN
{
    public function validateUser($email, $password, $area)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "SELECT USA_IDUSERADMIN, USA_DCSENHA, USA_DCEMAIL, USA_DCNOME, USA_DCSEXO, USA_DCNIVELDEACESSO, USA_STPROSPEC FROM USA_USERADMIN WHERE USA_DCEMAIL = :email";
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
                $_SESSION['user_nivelacesso'] = $user['USA_DCNIVELDEACESSO'];

                if($area == "Intranet")
                {
                    echo '<meta http-equiv="refresh" content="0;url=intranet.php">'; // Redireciona após login bem-sucedido
                    exit();
                }
                else
                    if($user['USA_STPROSPEC'] != "SIM")
                    {
                        echo '<meta http-equiv="refresh" content="0;url=noAuth.html">'; // Redireciona após login bem-sucedido
                        exit();
                    }
                    else
                        {
                            echo '<meta http-equiv="refresh" content="0;url=table_prospec.php">'; // Redireciona após login bem-sucedido
                            exit(); 
                        }
            } else 
                {
                    $_SESSION = [];
                    session_destroy();
                    echo "Usuário ou senha incorretos."; 
                }
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Sua chave secreta
    $secretKey = "6LcZHF4qAAAAAB8x_VRiQoivWpb5kzz_SOy8EwIT"; 

    // O token enviado pelo reCAPTCHA v2
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verifique se o token foi recebido
    if (!empty($recaptchaResponse)) 
    {
        
        // Verifique o reCAPTCHA fazendo uma solicitação à API do Google
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");
        $responseKeys = json_decode($response, true);

        // Verifique o sucesso da validação
        if ($responseKeys["success"]) 
        {

            $email = $_POST['email'];
            $password = $_POST['password'];
            $area = $_POST['area'];

            $loginSystem = new LoginSystem();
            $result=$loginSystem->validateUser($email, $password, $area);
        }
        else 
            {
                // Validação falhou
                echo "Falha na verificação do reCAPTCHA. Por favor, tente novamente.";
            }
    }
    else 
        {
            // reCAPTCHA não foi resolvido
            echo "Por favor, complete o reCAPTCHA.";
        }
}
 
?>
