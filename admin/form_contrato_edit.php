<?php
  include_once 'objetos.php'; 
 
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    //header("Location: index.php");
    //exit();
  }

  if ($_SESSION['user_nivelacesso'] != "FINANCEIRO" && $_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
  {
    header("Location: noAuth.html");
    exit();
  }

  $id = $_GET['id'];

  $siteAdmin = new SITE_ADMIN(); 
  $siteAdmin->getContratoInfoById($id);
  $siteAdmin->getClientInfoById($siteAdmin->ARRAY_CONTRATOINFO[0]["CLI_IDCLIENT"]);
  $siteAdmin->getProductInfoById($siteAdmin->ARRAY_CONTRATOINFO[0]["PRS_IDPRODUTO_SERVICO"]);


function convertDate($date) 
{
    $dateObj = DateTime::createFromFormat('Y-m-d', $date); 
    return $dateObj ? $dateObj->format('d/m/Y') : null;  // Retorna null se a data for inválida
}

// Converte as datas recebidas do formulário
$siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTINICONTRATO"] = convertDate($siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTINICONTRATO"]); 
$siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTENDCONTRATO"] = convertDate($siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTENDCONTRATO"]); 
$siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTCONTRATACAO"] = convertDate($siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTCONTRATACAO"]); 
$siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTPRAZOENTREGA"] = convertDate($siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTPRAZOENTREGA"]); 
$siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTVENCIMENTO"] = convertDate($siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTVENCIMENTO"]); 




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
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
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
                  <h3 class="box-title">Gestão de Contratos</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form id="form-empresa" role="form" method="POST">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- NOME DO CLIENTE PRODUTO OU SERVIÇO -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">
			
      <div style="flex: 1; min-width: 400px;">
			<label>NOME DO CLIENTE</label>
			<select readonly name="cliente" class="form-control" style="width: 100%; text-transform: uppercase;">
      <option value="<?php echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_IDCLIENT"]; ?>"> <?php echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_NMNAME"]; ?></option>
      </select>      
      </div>			

			<div style="flex: 1; min-width: 240px;">
			<label>PRODUTO OU SERVIÇO</label>
			<select readonly name="produto" class="form-control" style="width: 100%; text-transform: uppercase;">
      <option value="<?php echo $siteAdmin->ARRAY_PRODUCTINFO[0]["PRS_IDPRODUTO_SERVICO"]; ?>"><?php echo $siteAdmin->ARRAY_PRODUCTINFO[0]["PRS_NMNOME"]; ?> </option>
      </select>
      </div>			

      <div style="flex: 1; min-width: 130px;">
			<label>TIPO COBRANÇA</label>
			<select readonly class="form-control" name="tipocobranca" style="width: 100%;">
                	<option value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPERIODOCOBRANCA"] ?>"><?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPERIODOCOBRANCA"] ?></option>
                	<option value="UNICA">ÚNICA</option>
                	<option value="MENSAL">MENSAL</option>
                  <option value="TRIMESTRAL">TRIMESTRAL</option>
                  <option value="SEMESTRAL">SEMESTRAL</option>
                  <option value="ANUAL">ANUAL</option>
      </select>
      </div>						
			<div style="flex: 1; min-width: 130px;">
			<label>DT CONTRATO</label>
      <i class="fa fa-calendar"></i>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTCONTRATACAO"] ?>" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="dtcontrato" name="dtcontrato"   />
			</div>

      <div style="flex: 1;">
			<label>N. CONTRATO</label>
			<input readonly  type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control"  name="numcontrato" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_IDGESTAO_CONTRATO"] ?>" />
			</div>
		</div>
		</div>
		<!-- NOME DO CLIENTE PRODUTO OU SERVIÇO --> 

    <!-- INICIO CONTRATO FIM CONTRATO DATA ENTREGA -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
      
      <div style="flex: 1; min-width: 80px;">
			<label>INICIO CONTRATO</label>
      <i class="fa fa-calendar"></i>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTINICONTRATO"] ?>" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="iniciocontrato" name="iniciocontrato"   />
			</div>

      <div style="flex: 1; min-width: 90px;">
			<label>FIM CONTRATO</label>
      <i class="fa fa-calendar"></i>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTENDCONTRATO"] ?>" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="fimcontrato" name="fimcontrato"   />
			</div>

      <div style="flex: 1; min-width: 90px;">
			<label>DATA ENTREGA</label>
      <i class="fa fa-calendar"></i>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTPRAZOENTREGA"] ?>" minlength="10" maxlength="10" class="form-control" placeholder="DD/MM/YYYY" id="prazoentrega" name="prazoentrega"   />
			</div>
      
      <div style="flex: 1; min-width: 350px;">
			<label>E-MAIL PARA FATURAMENTO</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCEMAILCOBRANCA"] ?>" minlength="5" maxlength="40" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor, insira um e-mail válido, como exemplo@dominio.com" class="form-control"  placeholder="Digite seu email"  name="emailfaturamento"  />
			</div>
			<div style="flex: 1; min-width: 150px;">
			<label>TEL FATURAMENTO</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCTELEFONECOBRANCA"] ?>" minlength="11" maxlength="12" pattern="[0-9\- ]*" title="Apenas números, espaços e hífens são permitidos" class="form-control" id="telfaturamento" required name="telfaturamento" />
			</div>

      <div style="flex: 1; min-width: 40px;">
			<label>STATUS</label>
			<select class="form-control" name="statuscontrato" style="width: 100%;">
                	<option value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_STCONTRATO"] ?>"><?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_STCONTRATO"] ?></option>
                	<option value="ATIVO">ATIVO</option>
                	<option value="INATIVO">INATIVO</option>
            		</select>
			</div>

			</div>
		</div>
    <!-- INICIO CONTRATO FIM CONTRATO DATA ENTREGA -->   

    <!-- fORMA DE PAGAMENTO DATA VENCIMENTO PERÍODO DESCONTO -->         
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
      
      <div style="flex: 1; min-width: 50px;">
			<label>DESCONTO (%)</label>
			<input readonly type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCDESCONTO"] ?>" value="0" maxlength="150" class="form-control" placeholder="EX.: 50"  name="desconto"   />
			</div>

      <div style="flex: 1; min-width: 40px;">
			<label>PER. DESC. (DIAS)</label>
			<input readonly type="text" pattern="\d*"  value="0" placeholder="Ex.: 60" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPERIODO_DESCONTO"] ?>" title="Digite apenas números" style="width: 100%; text-transform: uppercase;" maxlength="2" class="form-control" id="periododesconto" name="periododesconto"   />
			</div>
      
      <div style="flex: 1; min-width: 50px;">
			<label>CARÊNCIA (DIAS)</label>
			<input readonly type="text" pattern="\d*" value="0" placeholder="Ex.: 15" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPERIODO_CARENCIA"] ?>" title="Digite apenas números" style="width: 100%; text-transform: uppercase;" maxlength="2" class="form-control"  id="carencia"  name="carencia"   />
			</div>

      <div style="flex: 1; min-width: 110px;">
			<label>PARCELAMENTO</label>
			<select readonly class="form-control" name="parcelamento" style="width: 100%;">
                	<option value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPARCELAMENTO"] ?>"><?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCPARCELAMENTO"] ?></option>
                	<option value="1">1X</option>
                  <option value="2">2X</option>
                  <option value="3">3X</option>
                  <option value="4">4X</option>
                  <option value="5">5X</option>
                  <option value="6">6X</option>
                  <option value="7">7X</option>
                  <option value="8">8X</option>
                  <option value="9">9X</option>
                  <option value="10">10X</option>
                  <option value="11">11X</option>
                  <option value="12">12X</option>                	
      </select>
			</div>

      <div style="flex: 1; min-width: 50px;">
			<label>VALOR PARCELA</label>
			<input readonly inputmode="decimal" pattern="[0-9]*\.?[0-9]*" type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCVALOR"] ?>" maxlength="150" class="form-control" placeholder="R$0.000,00"  id="valor" name="valor"   />
			</div>

      <div style="flex: 1; min-width: 90px;">
			<label>VENCIMENTO</label>
      <i class="fa fa-calendar"></i>
			<input readonly type="text" style="width: 100%; text-transform: uppercase;" value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DTVENCIMENTO"] ?>" maxlength="50" class="form-control" placeholder="DD/MM/YYYY" id="dtvencimento" name="dtvencimento"   />
			</div>

      <div style="flex: 1; min-width: 160px;">
			<label>FORMA DE PAG.</label>
			<select class="form-control" name="formapagamento" style="width: 100%;">
                	<option value="<?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCFORMAPAGAMENTO"] ?>"><?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCFORMAPAGAMENTO"] ?></option>
                	<option value="CARTAO DE CREDITO">C. DE CRÉDITO</option>
                	<option value="PIX">PIX</option>
                  <option value="BOLETO">BOLETO</option>
                  <option value="TRANSF BANCARIA">TRANSF BANCÁRIA</option>
            		</select>
			</div>


			</div>
		</div>
    <!-- fORMA DE PAGAMENTO DATA VENCIMENTO PERÍODO DESCONTO -->
		<!-- DESCRIÇÃO-->
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div class="form-group" style="flex: 0 0 100%;">
                      	<label>DESCRIÇÃO</label>
                      	<textarea class="form-control"  name="descricao" style="width: 100%;" maxlength="600" rows="6" placeholder="Escreva aqui a descrição do serviço contratado.">
                        <?php echo $siteAdmin->ARRAY_CONTRATOINFO[0]["GEC_DCDESCRICAO"] ?>
                        </textarea>
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
    

<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->


    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- ######################################################## --> 
    <!-- SWEETALERT 2 -->   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      function confirmAndSubmit(event) {
        event.preventDefault(); // Impede o envio padrão do formulário
        Swal.fire({
          title: 'Formulário de Contrato',
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
              url: "contrato_proc_edit.php", // URL para processamento
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
              text: 'Erro ao atualizar o contrato.',
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

  <script>
    $(document).ready(function() {
      $('#dtcontrato').mask('00/00/0000', {
        placeholder: "__/__/____"
      });
    });

    $(document).ready(function() {
      $('#iniciocontrato').mask('00/00/0000', {
        placeholder: "__/__/____"
      });
    });

    $(document).ready(function() {
      $('#fimcontrato').mask('00/00/0000', {
        placeholder: "__/__/____"
      });
    });

    $(document).ready(function() {
      $('#prazoentrega').mask('00/00/0000', {
        placeholder: "__/__/____"
      });
    });

    $(document).ready(function() {
      $('#dtvencimento').mask('00/00/0000', {
        placeholder: "__/__/____"
      });
    });

    $(document).ready(function() {
      $('#telfaturamento').mask('00 00000-0000', {
        placeholder: "00 00000-0000"
      });
    });

    $(document).ready(function() {
    $('#valor').mask('R$ #.##0,00', { reverse: true });

    // Remover a máscara antes de enviar o formulário
    $('#form-dinheiro').on('submit', function(e) {
      const valorComMascara = $('#valor').val();
      const valorSemMascara = valorComMascara.replace(/[R$\s.]/g, '').replace(',', '.');
      $('#valor').val(valorSemMascara);
    });
  });

  </script>

  
 

  </body>
</html>
