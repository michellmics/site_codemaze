<?php
  include_once 'objetos.php'; 
  include 'modal.php';

  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
  if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
  }

  $idCLient = $_GET['id'];
  $siteAdmin = new SITE_ADMIN();
  $siteAdmin->getClientInfoById($idCLient); 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  
  <style>
    /* Modal Background */
    .modal {
      display: none; /* Hidden by default */
      position: fixed;
      z-index: 1; /* Sit on top */
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.4); /* Dark background */
    }

    /* Modal Content */
    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%; /* Could be adjusted */
    }

    .modal-header, .modal-footer {
      padding: 10px;
      text-align: center;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
  </style>

</head>
<body class="skin-blue">
  <div class="wrapper">
    <div class="content-wrapper" style="margin-left: 0px; background-color: white;">
      <section class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Cadastro de Clientes</h3>
              </div>
              <form role="form" method="POST" action="client_proc_edit.php">
                <!-- Campos do formulário -->
                <div style="width: 100%; margin-bottom: 20px;">
                  <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
                    <div style="flex: 1;">
                      <label>NOME</label>
                      <input type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="40" class="form-control" placeholder="Enter ..." name="nome" value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_NMNAME"]; ?>" />
                    </div>
                    <div style="flex: 1;">
                      <label>CPF/CNPJ</label>
                      <input required type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="24" class="form-control" placeholder="00000000000000" name="cpfcnpj" value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCCPFCNPJ"]; ?>" />
                    </div>
                    <div style="flex: 1;">
                      <label>RAZÃO SOCIAL</label>
                      <input type="text" style="width: 100%; text-transform: uppercase;" maxlength="40" class="form-control" placeholder="Enter ..." name="razaosocial" value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCRSOCIAL"]; ?>" />
                    </div>
                  </div>
                </div>

                <div class="box-footer">
                  <button type="button" class="btn btn-warning" onclick="window.history.back()">VOLTAR</button>
                  <button type="submit" name="salvar_empresa_1" class="btn btn-primary">SALVAR CADASTRO</button>
                  <!-- Button to Open Modal -->
                  <button type="button" class="btn btn-info" id="myBtn">Exibir Modal</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Modal -->
  <div id="myModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span class="close" id="closeBtn">&times;</span>
        <h2>Este é o seu modal!</h2>
      </div>
      <div class="modal-body">
        <p>Conteúdo do modal aqui...</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="document.getElementById('myModal').style.display='none'">Fechar</button>
      </div>
    </div>
  </div>

  <script>
    // Abrir Modal
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var closeBtn = document.getElementById("closeBtn");

    btn.onclick = function() {
      modal.style.display = "block";
    }

    closeBtn.onclick = function() {
      modal.style.display = "none";
    }

    // Fechar o modal ao clicar fora dele
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

  <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src='plugins/fastclick/fastclick.min.js'></script>
  <script src="dist/js/app.min.js" type="text/javascript"></script>
  <script src="dist/js/demo.js" type="text/javascript"></script>
</body>
</html>
