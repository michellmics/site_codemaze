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
    $imagem = $_POST['imagem'];
    
    $registerPubli = new registerPubli();
    
    $result = $registerPubli->insertPubli($cliente,$descricao,$tipo,$nomecampanha,$iniciopub,$fimpub,$imagem);
}
?>
