<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class registerClient extends SITE_ADMIN
{
    public function updateClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }
                
            $result = $this->updateClientInfo($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep);
            echo "Cliente editado com sucesso.";                  
                     
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
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $observacoes = $_POST['observacoes'];
    $status = $_POST['status'];
    $id = $_POST['id'];
    $cep = $_POST['cep'];
    $registerClient = new registerClient();
    $result = $registerClient->updateClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$status,$id,$cep);
}
?>
