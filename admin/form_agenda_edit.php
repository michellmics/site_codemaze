<?php
  include_once 'objetos.php'; 

  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

  $readyonly="";

  if ($_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
  {
    $readyonly="readonly";
  }


  $siteAdmin = new SITE_ADMIN();


  $id = $_GET['id'];
  $siteAdmin->getAgendaInfoById($id);
  $userID = $siteAdmin->ARRAY_AGENDAINFO[0]["USA_IDUSERADMIN"];
  $siteAdmin->getUserInfoList(); 
  $siteAdmin->getUserInfo($userID); 
  
$dateIni = DateTime::createFromFormat('Y-m-d H:i:s', $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_DTINI"]);
$dateIniFormat = $dateIni->format('d/m/Y H:i');

$dateFim = DateTime::createFromFormat('Y-m-d H:i:s', $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_DTFIM"]);
$dateFimFormat = $dateFim->format('d/m/Y H:i');
  
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

   <!-- Carregar primeiro o jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Carregar depois o jQuery Mask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


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
                  <h3 class="box-title">Edição de Atividades</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="form-empresa" role="form" method="POST">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- STATUS TIPO NOME -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">
					
			<div style="flex: 1;">
			<label>FUNCIONÁRIO</label>
			<select required class="form-control" name="funcionario" style="width: 100%;" <? echo $readyonly ?>>
      <option value="<? echo $siteAdmin->ARRAY_USERINFO["USA_IDUSERADMIN"]; ?>" selected><? echo $siteAdmin->ARRAY_USERINFO["USA_DCNOME"]; ?></option>
          <?php
            // Verifica se o array não está vazio
            if (!empty($siteAdmin->ARRAY_USERINFOLIST)) {
                // Itera sobre o array de usuários
                foreach ($siteAdmin->ARRAY_USERINFOLIST as $user) {
                    // Exibe os nomes no select e usa o ID de usuário como valor
                    echo '<option value="' . htmlspecialchars($user['USA_IDUSERADMIN']) . '">' . htmlspecialchars($user['USA_DCNOME']) . '</option>';
                }
            }
          ?>
			</select> 
			</div> 
      <div style="flex: 3">
			<label>TÍTULO</label>
			<input <? echo $readyonly ?> required type="text" value="<? echo $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_DCTITULO"]; ?>" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="100" class="form-control" placeholder="Enter ..." name="titulo" />
			</div> 		
			
			<div style="flex: 1;"> 
			<label>DATA INICIO</label>
			<input required <? echo $readyonly ?> type="text" value="<? echo $dateIniFormat; ?>" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="DD/MM/YYYY" id="dtinicio" name="dtinicio"   />
			</div>
      <div style="flex: 1;">
			<label>DATA FIM</label>
      <input required <? echo $readyonly ?> type="text" value="<? echo $dateFimFormat; ?>" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="DD/MM/YYYY" id="dtfim" name="dtfim"   />
			</div>	

      <div style="flex: 1;">
			<label>STATUS</label>
			<select required class="form-control" name="status" style="width: 100%;">
                  <option value="<? echo $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_STSTATUS"]; ?>" selected><? echo $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_STSTATUS"]; ?></option>
                	<option value="PENDENTE">PENDENTE</option>
                	<option value="EM ANDAMENTO">EM ANDAMENTO</option>
                	<option value="CONCLUÍDO">CONCLUÍDO</option>
                	<option value="ATRASADO">ATRASADO</option>
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
                      	<textarea <? echo $readyonly ?> class="form-control"  style="width: 100%;" maxlength="1000" rows="10" placeholder="Enter ..." name="descricao"><? echo $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_DCDESC"]; ?></textarea>
                    	</div>
			</div>
		</div>
		<!-- DESCRICAO-->
    <div style="flex: 21;">
			<label style="display: none;">ID</label>
			<input type="text" style="width: 100%; text-transform: uppercase; display: none;" minlength="10" maxlength="50" class="form-control" placeholder="Enter ..." name="id" value="<? echo $siteAdmin->ARRAY_AGENDAINFO[0]["AGE_IDAGENDA"]; ?>" />
			</div>	


                  
                  <div class="box-footer">
                  <button type="button" name="voltar" class="btn btn-warning" onclick="window.history.back()">VOLTAR</button>
                  <button type="submit" id="salvar_empresa_1" name="salvar_empresa_1" class="btn btn-primary">SALVAR ATIVIDADE</button>
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
    <!-- SWEETALERT 2 -->   
    <script>
      function confirmAndSubmit(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        Swal.fire({
          title: 'Formulário de Atividades',
          text: "Têm certeza que deseja salvar?",
          showDenyButton: true,
          confirmButtonText: 'SALVAR',
          denyButtonText: `CANCELAR`,
          confirmButtonColor: "#4289a6",
          denyButtonColor: "#ff8a33",
          width: '600px', // Largura do alerta
          icon: 'warning',
          customClass: {
            title: 'swal-title', // Classe para o título
            content: 'swal-content', // Classe para o conteúdo (texto)
            confirmButton: 'swal-confirm-btn',
            denyButton: 'swal-deny-btn',
            htmlContainer: 'swal-text'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            // Capturar os dados do formulário
            var formData = $("#form-empresa").serialize();
            // Fazer a requisição AJAX
            $.ajax({
              url: "agenda_proc_edit.php", // URL para processamento
              type: "POST",
              data: formData,
              success: function (response) {
                Swal.fire({
              title: 'Salvo!',
              text: `${response}`,
              icon: 'success',
              width: '600px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              customClass: {
                title: 'swal-title', // Aplicando a mesma classe do título
                content: 'swal-content', // Aplicando a mesma classe do texto
                htmlContainer: 'swal-text',
                confirmButton: 'swal-confirm-btn'
              }
            }).then(() => {
                  // Redirecionar ou atualizar a página, se necessário
                  location.reload();
                });
              },
              error: function (xhr, status, error) {
                Swal.fire({
              title: 'Erro!',
              text: 'Erro ao atualizar o Cliente.',
              icon: 'error',
              width: '600px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              customClass: {
                title: 'swal-title', // Aplicando a mesma classe do título
                content: 'swal-content', // Aplicando a mesma classe do texto
                htmlContainer: 'swal-text',
                confirmButton: 'swal-confirm-btn'
              }
            });
              },
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelado', 'Nenhuma alteração foi salva.', 'info');
          }
        });
      }
      // Associar a função ao botão de submit
      $(document).ready(function () {
        $("#salvar_empresa_1").on("click", confirmAndSubmit);
      });
</script> 
<style>
  /* Estilos para aumentar o tamanho da fonte */
  .swal-title {
    font-size: 36px !important; /* Tamanho maior para o título */
  }

  .swal-text {
    font-size: 24px !important; /* Tamanho maior para o conteúdo */
  }

  /* Aumentar o tamanho dos textos dos botões */
  .swal-confirm-btn,
  .swal-deny-btn,
  .swal-cancel-btn {
    font-size: 20px !important; /* Tamanho maior para os textos dos botões */
    padding: 12px 12px !important; /* Aumenta o espaço ao redor do texto */
  }
</style>
<!-- ######################################################## --> 
<!-- SWEETALERT 2 -->   


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
<script>
  $(document).ready(function () {
    // Aplica a máscara de data e hora
    $('#dtinicio').mask('00/00/0000 00:00', { placeholder: "__/__/____ __:__" });
    $('#dtfim').mask('00/00/0000 00:00', { placeholder: "__/__/____ __:__" });

    // Validação para hora e minutos
    function validateTimeInput(input) {
      let timeValue = input.val().trim();
      let timeParts = timeValue.split(' '); // Divide em data e hora
      if (timeParts.length === 2) {
        let time = timeParts[1].split(':'); // Divide a hora em horas e minutos
        let hour = parseInt(time[0], 10);
        let minute = parseInt(time[1], 10);

        // Se a hora for maior que 23 ou minuto maior que 59, exibe um alerta
        if (hour > 23) {
          input.val(timeParts[0] + ' 23:59');
          alert('Hora não pode ser maior que 23!');
        } else if (minute > 59) {
          input.val(timeParts[0] + ' ' + hour + ':59');
          alert('Minuto não pode ser maior que 59!');
        }
      }
    }

    // Validação para a data
    function validateDateInput(input) {
      let dateValue = input.val().trim();
      let dateParts = dateValue.split(' '); // Divide em data e hora
      if (dateParts.length === 2) {
        let date = dateParts[0].split('/'); // Divide a data em dia, mês e ano
        let day = parseInt(date[0], 10);
        let month = parseInt(date[1], 10);
        let year = parseInt(date[2], 10);

        // Se o ano for maior que 2100, exibe um alerta
        if (year > 2100) {
          input.val('31/12/2100 23:59');
          alert('Ano não pode ser maior que 2100!');
        }
        // Se o mês for maior que 12, exibe um alerta
        else if (month > 12) {
          input.val('31/12/2100 23:59');
          alert('Mês não pode ser maior que 12!');
        }
        // Se o dia for maior que 31, exibe um alerta
        else if (day > 31) {
          input.val('31/12/2100 23:59');
          alert('Dia não pode ser maior que 31!');
        }
      }
    }

    // Valida os campos quando o usuário sai do campo (blur)
    $('#dtinicio').on('blur', function () {
      validateTimeInput($(this));
      validateDateInput($(this));
    });

    $('#dtfim').on('blur', function () {
      validateTimeInput($(this));
      validateDateInput($(this));
    });
  });
</script>
    <!-- jQuery 2.1.3 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

  </body>
</html>
