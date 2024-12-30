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
    $descricao = $_POST['descricao'];
    $tipo = $_POST['tipo'];
    $nomecampanha = $_POST['nomecampanha'];
    $iniciopub = $_POST['iniciopub'];
    $fimpub = $_POST['fimpub'];   
    $imagem = $_FILES['imagem'];   
    
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "_img/publicidade/$cliente/"; // Diretório onde as imagens serão salvas
        $timestamp = round(microtime(true) * 1000);
        $nomeCampanhaFile = str_replace(' ', '', basename($_FILES['imagem']['name']));
        $uploadFile = $uploadDir . $timestamp ."_".$nomeCampanhaFile;

        // Verifica se o diretório existe, caso contrário, cria
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                echo "Erro: Não foi possível criar o diretório de upload.";
                exit;
            }
        }

        // Validação do tipo de arquivo (apenas imagens)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($_FILES['imagem']['type'], $allowedTypes)) {
            echo "Erro: Tipo de arquivo não permitido.";
            exit;
        }
    
        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            echo "Imagem enviada com sucesso: " . $uploadFile;
        }    
    }

    $registerPubli = new registerPubli();
    
    $result = $registerPubli->insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem);
}
?>
