<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}


class registerAgenda extends SITE_ADMIN
{
    public function insertAgenda($titulo,$dtinicio,$dtfim,$status,$descricao)
    {
        try {
                    $result = $this->insertAgendaInfo($titulo,$dtinicio,$dtfim,$status,$descricao);
                    echo "Atividade cadastrada com sucesso."; 

        } catch (PDOException $e) {  
            echo "Erro ao cadastrar a atividade."; 
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $titulo = $_POST['titulo'];
    $dtinicio = $_POST['dtinicio'];
    $dtfim = $_POST['dtfim'];
    $status = $_POST['status'];
    $descricao = $_POST['descricao'];
    $registerAgenda = new registerAgenda();
    $result = $registerAgenda->insertAgenda($titulo,$dtinicio,$dtfim,$status,$descricao);
}
?>
