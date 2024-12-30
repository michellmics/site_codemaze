<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário

class registerPubli extends SITE_ADMIN
{
    public function insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            $result = $this->insertPubliInfo($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem);

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
    //$descricao = $_POST['descricao'];
    $tipo = "Nem entrou";
    //$tipo = $_POST['tipo'];
    $nomecampanha = $_POST['nomecampanha'];
    $iniciopub = $_POST['iniciopub'];
    $fimpub = $_POST['fimpub'];   

    // Verificação do arquivo de imagem
    if (isset($_FILES['imagem'])) {
        $descricao =  "Código de erro do arquivo: " . $_FILES['imagem']['error']; // Mostra o código de erro
    }
    
    // Verifica se o arquivo foi enviado e se não ocorreu erro no upload
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        echo "Arquivo recebido: " . $_FILES['imagem']['name']; // Verifica se o arquivo foi enviado
        $uploadDir = "_img/publicidade/"; // Diretório onde as imagens serão salvas
        $timestamp = round(microtime(true) * 1000);
        $nomeCampanhaFile = str_replace(' ', '', basename($_FILES['imagem']['name']));
        $uploadFile = $uploadDir . $timestamp ."_".$nomeCampanhaFile;

        // Verifica se o diretório existe, caso contrário, cria
        if (!is_dir($uploadDir)) {
            echo "O diretório de upload não existe. Tentando criar...<br>";
            if (!mkdir($uploadDir, 0755, true)) {
                $descricao = "Erro: Não foi possível criar o diretório de upload.";
                exit;
            } else {
                echo "Diretório criado com sucesso.<br>";
            }
        }

        // Validação do tipo de arquivo (apenas imagens)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        echo "Tipo do arquivo: " . $_FILES['imagem']['type'] . "<br>"; // Exibe o tipo de arquivo
        if (!in_array($_FILES['imagem']['type'], $allowedTypes)) {
            $descricao = "Erro: Tipo de arquivo não permitido.";
            exit;
        }

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            echo "Imagem enviada com sucesso: " . $uploadFile . "<br>";
        } else {
            $descricao = "Erro ao mover o arquivo para o diretório de upload.<br>";
        }
    } else {
        $descricao = "Erro no upload ou nenhum arquivo foi enviado.<br>";
    }
    $descricao = "Nemss entrou";

        $registerPubli = new registerPubli();
        $result = $registerPubli->insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$uploadFile);
   
}
?>
