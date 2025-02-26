<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos

session_start(); // Inicia a sessão para armazenar dados do usuário


class registerClient extends SITE_ADMIN
{
    public function insertClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$bairro,$site)
    {
        try {
            // Cria conexão com o banco de dados
            if (!$this->pdo) {
                $this->conexao();
            }

            // Prepara a consulta SQL para verificar o usuário
            $sql = "SELECT CLI_IDCLIENT FROM CLI_CLIENT WHERE CLI_NMNAME = :nome";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Se o usuário for encontrado e a senha for válida
            if (isset($user['CLI_IDCLIENT'])) {
                echo "Cliente já está cadastrado."; 
                exit();
            } else 
                {
                    $result = $this->insertClientInfo($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$cep,$bairro,$site);
                    $SUBJECT = "Cadastro de novo cliente";
                    $MSG = "O cliente $nome com CPF/CNPJ $cpfcnpj foi cadastrado na intranet da Codemaze.";
                    
                    $this->notifyEmail($SUBJECT, $MSG); //notificação por email
                    echo $result; 
                                      
                     
                }
        } catch (PDOException $e) {  
            echo "ERRO: Não foi possível cadastrar o cliente.";
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
    $cep = $_POST['cep'];
    $site = $_POST['site'];
    $registerClient = new registerClient();
    $result = $registerClient->insertClient($nome,$cpfcnpj,$razaosocial,$email,$telefone1,$telefone2,$endereco,$estado,$cidade,$observacoes,$cep,$bairro,$site);
}
?>
