<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class updateContrato extends SITE_ADMIN
{
    public function updateContrato($numcontrato,
    $cliente, 
    $produto, 
    $iniciocontrato, 
    $fimcontrato, 
    $statuscontrato, 
    $tipocobranca,
    $formapagamento,
    $emailfaturamento,
    $telfaturamento, 
    $descricao,
    $dtcontrato,
    $prazoentrega, 
    $carencia,
    $desconto, 
    $periododesconto, 
    $dtvencimento,  
    $parcelamento, 
    $valor)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            $result = $this->updateContratoInfo($numcontrato,
            $cliente, 
            $produto, 
            $iniciocontrato, 
            $fimcontrato, 
            $statuscontrato, 
            $tipocobranca,
            $formapagamento,
            $emailfaturamento,
            $telfaturamento, 
            $descricao,
            $dtcontrato,
            $prazoentrega, 
            $carencia,
            $desconto, 
            $periododesconto, 
            $dtvencimento,  
            $parcelamento, 
            $valor);
            
            echo "Contrato atualizado com sucesso. <a href='table_contrato.php'>VOLTAR</a>";
                                      
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage();
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $cliente = $_POST['cliente']; 
    $produto = $_POST['produto']; 
    $tipocobranca = $_POST['tipocobranca']; 
    $dtcontrato = $_POST['dtcontrato']; 
    $numcontrato = $_POST['numcontrato']; 
    $iniciocontrato = $_POST['iniciocontrato']; 
    $fimcontrato = $_POST['fimcontrato']; 
    $prazoentrega = $_POST['prazoentrega']; 
    $emailfaturamento = $_POST['emailfaturamento'];
    $telfaturamento = $_POST['telfaturamento']; 
    $statuscontrato = $_POST['statuscontrato']; 
    $desconto = $_POST['desconto']; 
    $periododesconto = $_POST['periododesconto']; 
    $carencia = $_POST['carencia']; 
    $parcelamento = $_POST['parcelamento']; 
    $valor = $_POST['valor']; 
    $dtvencimento = $_POST['dtvencimento']; 
    $formapagamento = $_POST['formapagamento'];
    $descricao = $_POST['descricao'];
    $updateContrato = new updateContrato();
    
    $result = $updateContrato->updateContrato($numcontrato,
        $cliente, 
        $produto, 
        $iniciocontrato, 
        $fimcontrato, 
        $statuscontrato, 
        $tipocobranca,
        $formapagamento,
        $emailfaturamento,
        $telfaturamento, 
        $descricao,
        $dtcontrato,
        $prazoentrega, 
        $carencia,
        $desconto, 
        $periododesconto, 
        $dtvencimento,  
        $parcelamento, 
        $valor
    );

    
}
?>
