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

  

  die();

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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

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
                  <h3 class="box-title">Cadastro de Produtos e Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="produto_proc.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- STATUS TIPO NOME -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">
			<div style="flex: 1;">
			<label>NOME DO PRODUTO OU SERVIÇO</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="50" class="form-control" placeholder="Enter ..." name="nome" />
			</div>					
			<div style="flex: 1;">
			<label>TIPO</label>
			<select class="form-control" name="tipo" style="width: 100%;">
                	<option value="" disabled selected>Selecione...</option>
                	<option value="HOSTING STANDARD">HOSTING</option>
                	<option value="CONSULTORIA WEB">CONSULTORIA</option>
                	<option value="GESTÃO DE TRÁFEGO">GESTÃO DE TRÁFEGO</option>
                	<option value="DESENVOLVIMENTO">DESENVOLVIMENTO</option>
                	<option value="GESTÃO DE MIDIA SOCIAL">GESTÃO DE MIDIA SOCIAL</option>
			</select>
			</div>     
			
			<div style="flex: 1;"> 
			<label>VALOR(R$)</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" id="investimento" placeholder="Enter ..." name="investimento" />
			</div>
      <div style="flex: 1;">
			<label>STATUS</label>
			<select class="form-control" name="status" style="width: 100%;">
          <option value="" disabled selected>Selecione...</option>
          <option value="ATIVO">ATIVO</option>
          <option value="INATIVO">INATIVO</option>
      </select>
			</div>	
			</div>
		</div>
		<!-- STATUS TIPO NOME --> 
        	
		<!-- DESCRICAO-->
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div class="form-group" style="flex: 0 0 50%;">
                      	<label>DESCRIÇÃO</label>
                      	<textarea class="form-control"  style="width: 100%;" maxlength="150" rows="5" placeholder="Enter ..." name="descricao"></textarea>
                    	</div>
			</div>
		</div>
		<!-- DESCRICAO-->
			


                  
                  <div class="box-footer">
                    <button type="submit" name="salvar_empresa_1" class="btn btn-primary">SALVAR CADASTRO</button>
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
<script>
$(document).ready(function () {
    $('#investimento').mask('000.000.000,00', { reverse: true });
});

$('form').on('submit', function () {
    let valor = $('#investimento').val().replace(/\./g, '').replace(',', '.');
    $('#investimento').val(valor);  // Altera o valor do input para decimal
});
</script>

    <!-- jQuery 2.1.3 -->
    
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
