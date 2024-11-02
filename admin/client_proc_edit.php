<?php
include_once 'objetos.php'; // Carrega a classe de conexão e objetos
include 'modal_ok.php';

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
            echo "<script>showModal('Cliente atualizado com sucesso.');</script>";               
                     
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
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body class="skin-blue">

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>

    <script>
        function showModal(message) {
          // Define o conteúdo do corpo do modal
          document.getElementById('modalBodyContent').innerText = message;
          // Abre o modal
          $('#alertModal').modal('show');
        }
    </script>

  </body>
</html>