<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos
//include 'modal_ok.php';

session_start(); // Inicia a sessão para armazenar dados do usuário


class registerClient extends SITE_ADMIN
{
    public function updateClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep,$bairro)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }
                
            $result = $this->updateClientInfo($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep,$bairro);
           // echo "Cliente atualizado com sucesso. <a href='table_cliente.php'>VOLTAR</a>";   
            echo "Cliente atualizado com sucesso";             
                     
        } catch (PDOException $e) {  
            echo "Erro: " . $e->getMessage(); 
        } 
    }
}

// Processa a requisição POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    
    $nome = $_POST['nome'];
    $cpfcnpj = $_POST['cpfcnpj'];
    $razaosocial = $_POST['razaosocial'];
    $email = $_POST['email'];
    $telefone1 = $_POST['telefone1'];
    $telefone2 = $_POST['telefone2'];
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $observacoes = $_POST['observacoes'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $cep = $_POST['cep'];
    $registerClient = new registerClient();
    $result = $registerClient->updateClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep,$bairro);
}
?>
