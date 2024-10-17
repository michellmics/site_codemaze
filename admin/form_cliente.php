<?php
  include_once 'objetos.php'; 
  /*
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }
*/
  $siteAdmin = new SITE_ADMIN();
  $descEmpresa_1 = $siteAdmin->getDescInfo("EMPRESA",1);
  $descEmpresa_2 = $siteAdmin->getDescInfo("EMPRESA",2);

  $descServicos_1 = $siteAdmin->getDescInfo("SERVICOS",1);
  $descServicos_2 = $siteAdmin->getDescInfo("SERVICOS",2);
  $descServicos_3 = $siteAdmin->getDescInfo("SERVICOS",3);
  $descServicos_4 = $siteAdmin->getDescInfo("SERVICOS",4);
  $descServicos_5 = $siteAdmin->getDescInfo("SERVICOS",5);
  $descServicos_6 = $siteAdmin->getDescInfo("SERVICOS",6);
  $descServicos_7 = $siteAdmin->getDescInfo("SERVICOS",7);

    //salvar formularios
    if ($_SERVER['REQUEST_METHOD'] === 'POST') //botao salvar empresa_1
    {
      $titulo = $_POST['titulo'];      
      $descricao = $_POST['descricao']; 
      $id = $_POST['id'];
      $page = $_POST['page'];

      $result = $siteAdmin->updateDesc($titulo, $descricao, $id, $page);

      if (isset($result['error'])) 
      {
        echo "<div class='alert alert-danger'>" . $result['error'] . "</div>";      
      } 
      else 
        {
          echo "<div class='alert alert-success'>" . $result['success'] . "</div> ";      
        }
    }

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
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
  
  
<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->  
  <body class="skin-blue">
    <div class="wrapper">
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="margin-left: 0px; background-color: white;">
        <!-- Content Header (Page header) -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-10">
              <!-- general form elements -->

              <!-- INI BLOCO 1 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
                  <!-- Nome  CPF/CNPJ-->
                  <div class="form-group" style="display: flex; gap: 10px; align-items: center;">
                    <div style="flex: 1;">
                    <label>NOME</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/>
                    </div>
                    <div style="flex: 1;">
                    <label>CPF/CNPJ</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/>
                    <label>RAZÃO SOCIAL</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/
                    </div>
                  </div>
                  <!-- Nome  CPF/CNPJ-->

                  <!-- Nome  CPF/CNPJ-->
                  <div class="form-group" style="display: flex; gap: 10px; align-items: center; margin-top: 20px;">
                    <div style="flex: 1;">
                    <label>NOME</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/>
                    </div>
                    <div style="flex: 1;">
                    <label>CPF/CNPJ</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/>
                    <label>RAZÃO SOCIAL</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/
                    </div>
                  </div>
                  <!-- Nome  CPF/CNPJ-->



                  
                  <div class="box-footer">
                    <button type="submit" name="salvar_empresa_1" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 1 -->

              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
      </div>   <!-- /.row -->
    </section><!-- /.content -->

<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->



























































      <!-- Main content FIM -->

      

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
  </body>
</html>
