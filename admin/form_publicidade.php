<?php
  include_once 'objetos.php'; 
 
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

  if ($_SESSION['user_nivelacesso'] != "FINANCEIRO" && $_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
  {
    header("Location: noAuth.html");
    exit();
  }

  $siteAdmin = new SITE_ADMIN();
  $siteAdmin->getClientInfo();

  // Ordena o array de clientes em ordem alfabética pelo nome
  usort($siteAdmin->ARRAY_CLIENTINFO, function($a, $b) {
    return strcmp($a['CLI_NMNAME'], $b['CLI_NMNAME']);
  });

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
    <link href="https://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.1.3 -->
        <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  <!-- ######################################################## --> 
      <!-- SWEETALERT 2 --> 
      <!-- SweetAlert2 CSS -->
      <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
      <!-- SweetAlert2 JS -->
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
  <!-- ######################################################## --> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/ui/trumbowyg.min.css">
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/trumbowyg.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/plugins/colors/trumbowyg.colors.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trumbowyg@2.27.3/dist/plugins/colors/ui/trumbowyg.colors.min.css">


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
                  <h3 class="box-title">PUBLICIDADE</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                 <form id="form-empresa" role="form" method="POST" action="publicidade_proc.php" enctype="multipart/form-data">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- NOME DO CLIENTE PRODUTO OU SERVIÇO -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">

      <div style="flex: 1; min-width: 400px;">
			<label>CLIENTE DE ORIGEM</label>
			<select required name="cliente" class="form-control" style="width: 100%; text-transform: uppercase;">
        <option value="" disabled selected>Selecione o cliente</option>
        <?php foreach ($siteAdmin->ARRAY_CLIENTINFO as $cliente): ?>
            <option value="<?php echo htmlspecialchars($cliente['CLI_IDCLIENT']); ?>">
                <?php echo htmlspecialchars($cliente['CLI_NMNAME']); ?>
            </option>
        <?php endforeach; ?>
      </select>
      </div>
    
      <div style="flex: 1; min-width: 400px;">
			<label>CLIENTE DE DESTINO</label>
			<select required name="clientedestino" class="form-control" style="width: 100%; text-transform: uppercase;">
        <option value="" disabled selected>Selecione o cliente</option>
        <?php foreach ($siteAdmin->ARRAY_CLIENTINFO as $cliente): ?>
            <option value="<?php echo htmlspecialchars($cliente['CLI_IDCLIENT']); ?>">
                <?php echo htmlspecialchars($cliente['CLI_NMNAME']); ?>
            </option>
        <?php endforeach; ?>
      </select>
      </div>					
        
      <div style="flex: 1; min-width: 50px;">
			<label>TIPO</label>
			<select required class="form-control" name="tipo" style="width: 100%;">
                	<option value="" disabled selected>SELECIONE</option>
                	<option value="TEXTO">SOMENTE TEXTO</option>
                	<option value="IMAGEM">IMAGEM</option>
                  <option value="TEXTO_IMAGEM">TEXTO E IMAGEM</option>
      </select>
      </div>						      
		  </div>
		</div>
		<!-- NOME DO CLIENTE PRODUTO OU SERVIÇO --> 

    <!-- INICIO CONTRATO FIM CONTRATO DATA ENTREGA -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
      
      <div style="flex: 1; min-width: 130px;">
			<label>NOME DA CAMPANHA</label>
			<input required type="text" style="width: 100%; text-transform: uppercase;" minlength="5" maxlength="30" class="form-control" placeholder="" id="nomecampanha" name="nomecampanha"   />
			</div>

      <div style="flex: 1; min-width: 80px;">
			<label>INICIO PUB</label>
      <i class="fa fa-calendar"></i>
			<input required type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="iniciopub" name="iniciopub"   />
			</div>

      <div style="flex: 1; min-width: 90px;">
			<label>FIM PUB</label>
      <i class="fa fa-calendar"></i>
			<input required type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="fimpub" name="fimpub"   />
			</div>

      <div style="flex: 1; min-width: 30px;">
			<label>STATUS</label>
			<select required class="form-control" name="status" style="width: 100%;">
                	<option value="" disabled selected>SELECIONE</option>
                	<option value="ATIVA">ATIVA</option>
                	<option value="INATIVA">INATIVA</option>
      </select>
      </div>

      <div style="flex: 1; min-width: 90px;">
			<label>UPLOAD IMAGEM</label>
			<input type="file" accept="image/*" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="10" class="form-control" placeholder="" id="imagem" name="imagem"   />
			</div>
      
			</div>
		</div>

    <!-- LINK -->
    <div style="width: 100%; margin-bottom: 20px;">  
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

      <div style="flex: 1; min-width: 130px;">
			<label>HYPERLINK DA IMAGEM</label>
			<input required type="text" style="width: 100%; text-transform: uppercase;" minlength="10" class="form-control" placeholder="" id="link" name="link"   />
			</div>

			</div>
		</div>
    <!-- LINK -->

		<!-- DESCRIÇÃO-->
		<div style="width: 100%; margin-bottom: 20px;">  
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">

      <div class="form-group" style="flex: 0 0 100%;">
                      	<label>DESCRIÇÃO DA CAMPANHA (SERÁ IMPRESSO NO RODAPÉ DO SITE SE ELEGIVEL)</label>
                      	<textarea required class="form-control" id="descricao" name="descricao" style="width: 50%;" maxlength="250" rows="3" placeholder=""></textarea>
                    	</div>

			</div>
		</div>
		<!-- DESCRIÇÃO-->

                  <div class="box-footer">
                  <button type="button" name="voltar" class="btn btn-warning" onclick="window.history.back()">VOLTAR</button>
                  <button type="submit" id="salvar_empresa_1" name="salvar_empresa_1" class="btn btn-primary">SALVAR CADASTRO</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 1 -->

              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
      </div>   <!-- /.row -->
    </section><!-- /.content -->
<script>
    $('#descricao').trumbowyg({
        btns: [
            ['bold', 'italic'],
            ['foreColor'], // Adiciona a funcionalidade de cores
            ['link']
        ],
        plugins: {
            colors: {
                displayAsList: true // Exibe as cores em uma lista compacta (opcional)
            }
        }
    });
</script>

<script>
  $(document).ready(function() {
    Inputmask("99/99/9999", { placeholder: "dd/mm/aaaa" }).mask("#iniciopub");
    Inputmask("99/99/9999", { placeholder: "dd/mm/aaaa" }).mask("#fimpub");

    // Validação de data ao enviar o formulário
    $('#form-empresa').on('submit', function(event) {
      // Obter as datas
      var dataFim = $('#fimpub').val();
      var dataAtual = new Date();
      var partesDataFim = dataFim.split('/');
      var dataFimFormatada = new Date(partesDataFim[2], partesDataFim[1] - 1, partesDataFim[0]);

      // Comparar a data de fim com a data atual
      if (dataFimFormatada <= dataAtual) {
        event.preventDefault(); // Impede o envio do formulário
        Swal.fire({
          icon: 'error',
          title: 'Erro!',
          text: 'A data de FIM PUB deve ser maior que a data atual!',
        });
      }
    });
  });
</script>

    

<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->


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
