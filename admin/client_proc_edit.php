<!DOCTYPE html>
<html>
  <head>
  <meta charset="UTF-8">
    <title>Intranet Codemaze</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
        function showModal(message,redirectUrl) {
            console.log(message); // Adiciona este log
          // Define o conteúdo do corpo do modal
          document.getElementById('modalBodyContent').innerText = message;
          // Abre o modal
          $('#alertModal').modal('show');

            // Adiciona um evento de clique ao botão de fechar
            document.getElementById('closeModal').onclick = function() {
            // Redireciona para a URL fornecida
            window.location.href = redirectUrl;
        };
        }
    </script>

  </body>
</html>

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
            echo "Cliente salvop com sucesso.";               
                     
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
