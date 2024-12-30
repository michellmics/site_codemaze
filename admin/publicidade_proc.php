<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário

class registerPubli extends SITE_ADMIN
{
    public function insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem,$status)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            $result = $this->insertPubliInfo($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem,$status);

            echo "Publicidade inserida com sucesso.";
        } catch (PDOException $e) {  
            echo "ERRO: Não foi possível inserir a publicidade.";
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{  
    $cliente = $_POST['cliente']; 
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $nomecampanha = $_POST['nomecampanha'];
    $iniciopub = $_POST['iniciopub'];
    $fimpub = $_POST['fimpub'];   
    $status = $_POST['status'];  

    // Verificação do arquivo de imagem 
    if (isset($_FILES['imagem'])) {
        echo "Código de erro do arquivo: " . $_FILES['imagem']['error']; // Mostra o código de erro
    }

    // Defina o limite de tamanho máximo de upload (em bytes)
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    
    if ($_FILES['imagem']['size'] > $maxFileSize) {
        echo "O arquivo é muito grande. O tamanho máximo permitido é 5MB.";
        exit();
    }
    
    // Verifica se o arquivo foi enviado e se não ocorreu erro no upload
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        echo "Arquivo recebido: " . $_FILES['imagem']['name']; // Verifica se o arquivo foi enviado
        $uploadDir = "_img/publicidade/$cliente/"; // Diretório onde as imagens serão salvas
        $timestamp = round(microtime(true) * 1000);
        $nomeCampanhaFile = strtolower(str_replace(' ', '', basename($_FILES['imagem']['name'])));
        $uploadFile = $uploadDir . $timestamp ."_".$nomeCampanhaFile;

        // Verifica se o diretório existe, caso contrário, cria
        if (!is_dir($uploadDir)) {
            echo "O diretório de upload não existe. Tentando criar...<br>";
            if (!mkdir($uploadDir, 0755, true)) {
                echo "Erro: Não foi possível criar o diretório de upload.";
                exit;
            } else {
                echo "Diretório criado com sucesso.<br>";
            }
        }

        // Validação do tipo de arquivo (apenas imagens)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        echo "Tipo do arquivo: " . $_FILES['imagem']['type'] . "<br>"; // Exibe o tipo de arquivo
        if (!in_array($_FILES['imagem']['type'], $allowedTypes)) {
            echo "Erro: Tipo de arquivo não permitido.";
            exit;
        }

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            echo "Imagem enviada com sucesso: " . $uploadFile . "<br>";
        } else {
            echo "Erro ao mover o arquivo para o diretório de upload.<br>";
        }
    } else {
        echo "Erro no upload ou nenhum arquivo foi enviado.<br>";
    }
        $registerPubli = new registerPubli();
        $result = $registerPubli->insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$uploadFile,$status);

        echo "<br><br><a href='javascript:window.history.back()' class='btn btn-warning'>VOLTAR</a>";
}
?>
