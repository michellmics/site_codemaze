<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


class registerUser extends SITE_ADMIN
{
    public function insertUser($email, $senha, $nome, $sexo, $foto)
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
                    $result = $this->insertUserInfo($email, $nome, $sexo, $passHash, $foto);
                    
                    $SUBJECT = "Cadastro de novo usuário administrador";
                    $MSG = "O usuário(a) $nome com e-mail $email foi cadastrado como administrador da intranet da Codemaze.";
                    
                    $this->notifyEmail($SUBJECT, $MSG); //notificação por email
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

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['foto']['tmp_name'];
        $fileName = $_FILES['foto']['name'];
        $fileSize = $_FILES['foto']['size'];
        $fileType = $_FILES['foto']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Extensões permitidas
        $allowedExts = ['jpg', 'jpeg', 'png'];

        // Verifica a extensão e o tamanho do arquivo
        if (in_array($fileExtension, $allowedExts) && $fileSize < 2 * 1024 * 1024) { // 2MB máximo
            // Define o diretório para salvar a foto
            $uploadDir = 'uploads/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFile = $uploadDir . $newFileName;

            echo $fileTmpPath;
            exit();

            // Move o arquivo para o diretório de uploads
            if (move_uploaded_file($fileTmpPath, $uploadFile)) {
                $foto = $uploadFile; // Caminho da foto
            } else {
                echo "Erro ao fazer upload da foto.";
                exit();
            }
        } else {
            echo "Formato de arquivo inválido ou o arquivo é muito grande.";
            exit();
        }
    }

    $registerUser = new registerUser();
    $registerUser->insertUser($email, $senha, $nome, $sexo, $foto);
}
?>
