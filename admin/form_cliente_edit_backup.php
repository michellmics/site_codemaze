<?php
  include_once 'objetos.php'; 
  include 'modal.php';

  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
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
                <form role="form" method="POST" action="client_proc_edit.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
        	<!-- NOME  CPF/CNPJ RAZÃO SOCIAL-->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center;">
      <div style="flex: 1;">
			<label>NOME</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="10" maxlength="40" class="form-control" placeholder="Enter ..." name="nome" value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_NMNAME"]; ?>" />
			</div>				
			<div style="flex: 1;">
			<label>CPF/CNPJ</label>
			<input required type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="24"   title="Apenas números são permitidos" class="form-control" placeholder="00000000000000" name="cpfcnpj"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCCPFCNPJ"]; ?>" />
			</div>					
			<div style="flex: 1;">
			<label>RAZÃO SOCIAL</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="40" class="form-control" placeholder="Enter ..." name="razaosocial"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCRSOCIAL"]; ?>" />
			</div>
			</div>
		</div>
		<!-- Nome  CPF/CNPJ RAZÃO SOCIAL-->
        	<!-- E-MAIL  TELEFONE 1 TELEFONE 2-->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div style="flex: 1;">
			<label>E-MAIL</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="5" maxlength="40" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Por favor, insira um e-mail válido, como exemplo@dominio.com" class="form-control"  placeholder="Digite seu email"  name="email"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCEMAIL"]; ?>" />
			</div>
			<div style="flex: 1;">
			<label>TELEFONE 1</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="12" pattern="[0-9\- ]*"  title="Apenas números, espaços e hífens são permitidos" class="form-control" placeholder="Digite o telefone (ex: 19 1234-5678)" required name="telefone1"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCTEL1"]; ?>" />
			</div>
			<div style="flex: 1;">
			<label>TELEFONE 2</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" minlength="11" maxlength="12" pattern="[0-9\- ]*"  title="Apenas números, espaços e hífens são permitidos" class="form-control" placeholder="Digite o telefone (ex: 19 1234-5678)" name="telefone2"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCTEL2"]; ?>" />
			</div>
			</div>
		</div>
        	<!-- E-MAIL  TELEFONE 1 TELEFONE 2-->
        	<!-- ENDEREÇO  ESTADO  CIDADE -->          
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div style="flex: 2; min-width: 150px;">
			<label>CEP</label>
			<input required type="text" style="width: 100%; text-transform: uppercase;" onblur="buscarEndereco()" maxlength="9" class="form-control" placeholder="Enter ..."  id="cep" name="cep"  value="<?php echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCCEP"]; ?>" />
			</div>
			<div style="flex: 6; min-width: 150px;">
			<label>ENDEREÇO</label>
			<input required type="text" style="width: 100%; text-transform: uppercase;" maxlength="150" class="form-control" placeholder="Enter ..."  id="endereco" name="endereco"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCADDRESS"]; ?>" />
			</div>
			<div style="flex: 3; min-width: 80px;">
			<label>BAIRRO</label>
			<input type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="Enter ..."  id="bairro" name="bairro"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCBAIRRO"]; ?>" />
			</div>
			<div style="flex: 2; min-width: 100px;">
			<label>ESTADO</label>
			<select required class="form-control" id="estado" name="estado" style="width: 100%;">
                	<option value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCSTATE"]; ?>"><? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCSTATE"]; ?></option>
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
			<input required id="cidade" type="text" style="width: 100%; text-transform: uppercase;" maxlength="50" class="form-control" placeholder="Enter ..." name="cidade"  value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCCITY"]; ?>" />
			</div>
			</div>
		</div>
    <!-- ENDEREÇO  ESTADO  CIDADE-->
		<!-- OBSERVAÇÕES-->
		<div style="width: 100%; margin-bottom: 20px;">
			<div class="form-group" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
			<div class="form-group" style="flex: 0 0 50%;">
                      	<label>OBSERVAÇÕES</label>
                      	<textarea class="form-control"  name="observacoes" style="width: 100%;" maxlength="250" rows="3" >
                        <? echo trim($siteAdmin->ARRAY_CLIENTINFO[0]["CLI_DCOBS"]); ?>
                        </textarea>
                    	</div>
			</div>

      <div style="flex: 2; min-width: 100px;">
			<label>STATUS</label>
			<select required class="form-control" name="status" style="width: 20%;">
                	<option value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_STSTATUS"]; ?>"><? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_STSTATUS"]; ?></option>
                  <option value="ATIVO">ATIVO</option>
                	<option value="INATIVO">INATIVO</option>
      </select>
			</div>
      <div style="flex: 2;">
			<label style="display: none;">ID</label>
			<input type="text" style="width: 100%; text-transform: uppercase; display: none;" minlength="10" maxlength="50" class="form-control" placeholder="Enter ..." name="id" value="<? echo $siteAdmin->ARRAY_CLIENTINFO[0]["CLI_IDCLIENT"]; ?>" />
			</div>			

		</div>
		<!-- OBSERVAÇÕES-->
			


                  
                  <div class="box-footer">
                    <button type="button" name="voltar" class="btn btn-warning" onclick="window.history.back()">VOLTAR</button>
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

	<script>
        // Função para buscar o endereço pela API ViaCEP
        function buscarEndereco() {
            let cep = document.getElementById('cep').value.replace(/\D/g, '');

            // Verifica se o CEP tem 8 dígitos
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro;
                            document.getElementById('bairro').value = data.bairro;
                            document.getElementById('cidade').value = data.localidade;
                            document.getElementById('estado').value = data.uf;
                        } else {
                            document.getElementById('endereco').value = null;
                            document.getElementById('bairro').value = null;
                            document.getElementById('cidade').value = null;
                            document.getElementById('estado').value = null;
                            document.getElementById('cep').value = null;
                            alert('CEP não encontrado!');
                        }
                    })
                    .catch(error => console.error('Erro na requisição:', error));
            } else {
				document.getElementById('endereco').value = null;
                document.getElementById('bairro').value = null;
                document.getElementById('cidade').value = null;
                document.getElementById('estado').value = null;
                document.getElementById('cep').value = null;
                alert('CEP inválido! Certifique-se de que tem 8 dígitos.');
            }
        }
    </script>

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
