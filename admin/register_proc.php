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
    public function insertUser($email, $senha, $nome, $sexo, $foto, $nivel)
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
                //exit();
            } else 
                {
                    $passHash = password_hash($senha, PASSWORD_DEFAULT);
                    $result = $this->insertUserInfo($email, $nome, $sexo, $passHash, $foto, $nivel);
                    
                    $SUBJECT = "Cadastro de novo usuário administrador";
                    $MSG = "O usuário(a) $nome com e-mail $email foi cadastrado como administrador da intranet da Codemaze.";
                    
                    $this->notifyEmail($SUBJECT, $MSG); //notificação por email
                    echo "Usuário cadastrado com sucesso."; 
                    
                }
        } catch (PDOException $e) {  
            echo "Erro ao cadastrar usuário."; 
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $sexo = $_POST['sexo'];
    $nivel = $_POST['nivel'];

     // Verifica se o arquivo foi enviado
     $foto = null;
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
 
             // Redimensiona a imagem para 75x75
             $image = null;
             if ($fileExtension == 'jpg' || $fileExtension == 'jpeg') {
                 $image = imagecreatefromjpeg($fileTmpPath);
             } elseif ($fileExtension == 'png') {
                 $image = imagecreatefrompng($fileTmpPath);
             }
 
             if ($image !== null) {
                 // Redimensiona a imagem
                 $resizedImage = imagescale($image, 75, 75); // Redimensiona para 75x75 pixels
 
                 // Salva a imagem redimensionada
                 if ($fileExtension == 'jpg' || $fileExtension == 'jpeg') {
                     imagejpeg($resizedImage, $uploadFile);
                 } elseif ($fileExtension == 'png') {
                     imagepng($resizedImage, $uploadFile);
                 }
 
                 // Libera a memória
                 imagedestroy($image);
                 imagedestroy($resizedImage);
 
                 // Caminho da foto
                 $foto = $uploadFile;
             } else {
                 echo "Erro ao processar a imagem.";
                 exit();
             }
         } else {
             echo "Formato de arquivo inválido ou o arquivo é muito grande.";
             exit();
         }
     }
 
     // Cria o objeto de registro de usuário e chama o método insertUser
     $registerUser = new registerUser();
     $registerUser->insertUser($email, $senha, $nome, $sexo, $foto, $nivel);
 }
 ?>