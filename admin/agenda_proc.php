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
    public function insertAgenda($titulo,$dtinicio,$dtfim,$status,$descricao,$funcionario)
    {
        try {
                    $result = $this->insertAgendaInfo($titulo,$dtinicio,$dtfim,$status,$descricao,$funcionario);
                    echo "Atividade cadastrada com sucesso."; 

        } catch (PDOException $e) {  
            echo "Erro ao cadastrar a atividade."; 
        } 
    }

    function formatarData($dataEntrada) {
        // Verifica se a data inclui hora (formato com hora: "DD/MM/YYYY HH:MM")
        if (!empty($dataEntrada) && strpos($dataEntrada, ' ') !== false) {
            // Data com hora
            $dataHora = DateTime::createFromFormat('d/m/Y H:i', $dataEntrada);
            if ($dataHora !== false) {
                // Formata para o formato MySQL (YYYY-MM-DD HH:MM:SS)
                return $dataHora->format('Y-m-d H:i:s');
            } else {
                // Erro no formato de data e hora
                echo "Formato de data e hora inválido para $dataEntrada.";
                return false;
            }
        } else {
            // Data sem hora
            $dataSemHora = DateTime::createFromFormat('d/m/Y', $dataEntrada);
            if ($dataSemHora !== false) {
                // Formata para o formato MySQL (YYYY-MM-DD)
                return $dataSemHora->format('Y-m-d') . ' 00:00:00'; // Define horário como 00:00:00
            } else {
                // Erro no formato de data
                echo "Formato de data inválido para $dataEntrada.";
                return false;
            }
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
    $funcionario = $_POST['funcionario'];
    $registerAgenda = new registerAgenda();
    $datainiFormatada = $registerAgenda->formatarData($dtinicio);
    $datafimFormatada = $registerAgenda->formatarData($dtfim);
    $result = $registerAgenda->insertAgenda($titulo,$datainiFormatada,$datafimFormatada,$status,$descricao,$funcionario);
}
?>
