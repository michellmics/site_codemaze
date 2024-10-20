<?php
  include_once 'objetos.php'; 
 
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

  $siteAdmin = new SITE_ADMIN();


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
                  <h3 class="box-title">Cadastro de Clientes</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="client_proc.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- NOME  CPF/CNPJ RAZÃO SOCIAL-->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">
			<div style="flex: 1;">
			<label>NÚMERO DO CONTRATO</label>
			<input type="text" style="width: 30%; text-transform: uppercase;" pattern="[0-9]*"  class="form-control" placeholder="00000000000000" name="contrato" />
			</div>					      
      <div style="flex: 1;">
			<label>NOME DO CLIENTE</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="50" class="form-control" placeholder="Enter ..." name="nome" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>" />
			</div>					
			<div style="flex: 1;">
			<label>CPF/CNPJ</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="18" pattern="[0-9]*"   title="Apenas números são permitidos" class="form-control" placeholder="00000000000000" name="cpfcnpj"  value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>" />
			</div>					
			<div style="flex: 1;">
			<label>RAZÃO SOCIAL</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="Enter ..." name="razaosocial"  value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>" />
			</div>
			</div>
		</div>
		<!-- Nome  CPF/CNPJ RAZÃO SOCIAL-->
        	<!-- E-MAIL  TELEFONE 1 TELEFONE 2-->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div style="flex: 1;">
			<label>E-MAIL</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="5" maxlength="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor, insira um e-mail válido, como exemplo@dominio.com" class="form-control"  placeholder="Digite seu email"  name="email"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
			<div style="flex: 1;">
			<label>TELEFONE 1</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="12" pattern="[0-9\- ]*"  title="Apenas números, espaços e hífens são permitidos" class="form-control" placeholder="Digite o telefone (ex: 19 1234-5678)" required name="telefone1"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
			<div style="flex: 1;">
			<label>TELEFONE 2</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="12" pattern="[0-9\- ]*"  title="Apenas números, espaços e hífens são permitidos" class="form-control" placeholder="Digite o telefone (ex: 19 1234-5678)" name="telefone2"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
			</div>
		</div>
        	<!-- E-MAIL  TELEFONE 1 TELEFONE 2-->
        	<!-- ENDEREÇO  ESTADO  CIDADE -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
      <div style="flex: 6; min-width: 150px;">
			<label>ENDEREÇO</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="150" class="form-control" placeholder="Enter ..."  name="endereco"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
      <div style="flex: 2; min-width: 150px;">
			<label>CEP</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="12" class="form-control" placeholder="Enter ..."  name="cep"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
			<div style="flex: 2; min-width: 100px;">
			<label>ESTADO</label>
			<select class="form-control" name="estado" style="width: 100%;">
                	<option value="" disabled selected>Selecione...</option>
                	<option value="AC">AC</option>
                	<option value="AL">AL</option>
                	<option value="AP">AP</option>
                	<option value="AM">AM</option>
                	<option value="BA">BA</option>
                	<option value="CE">CE</option>
                	<option value="DF">DF</option>
                	<option value="ES">ES</option>
                	<option value="GO">GO</option>
                	<option value="MA">MA</option>
                	<option value="MT">MT</option>
                	<option value="MS">MS</option>
                	<option value="MG">MG</option>
                	<option value="PA">PA</option>
                	<option value="PB">PB</option>
                	<option value="PR">PR</option>
                	<option value="PE">PE</option>
                	<option value="PI">PI</option>
                	<option value="RJ">RJ</option>
                	<option value="RN">RN</option>
                	<option value="RS">RS</option>
                	<option value="RO">RO</option>
                	<option value="RR">RR</option>
                	<option value="SC">SC</option>
                	<option value="SP">SP</option>
                	<option value="SE">SE</option>
                	<option value="TO">TO</option>
            		</select>
			</div>
			<div style="flex: 4; min-width: 150px;">
			<label>CIDADE</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="Enter ..." name="cidade"  value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>" />
			</div>
			</div>
		</div>
    <!-- ENDEREÇO  ESTADO  CIDADE-->
		<!-- OBSERVAÇÕES-->
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div class="form-group" style="flex: 0 0 50%;">
                      	<label>OBSERVAÇÕES</label>
                      	<textarea class="form-control"  name="observacoes" style="width: 100%;" maxlength="200" rows="5" placeholder="Enter ..."></textarea>
                    	</div>
			</div>
		</div>
		<!-- OBSERVAÇÕES-->
			


                  
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
