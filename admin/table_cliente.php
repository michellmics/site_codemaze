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

if(isset($_GET['table_search'])) //trazer os dados de acordo com o q foi colocado na busca
{
  $search = $_GET['table_search'];
  $siteAdmin->getClientInfoBySearch($search);
}

$activesList = $_GET['statusBusca'];

if($activesList == "Inativos")
{
  $siteAdmin->getClientInactiveInfo();
}
else
  {
    $siteAdmin->getClientInfo(); 
  }


// Configurações de Paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_CLIENTINFO);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_CLIENTINFO, $inicio, $registrosPorPagina);

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
            <div class="col-md-12">
              <!-- general form elements -->

              <!-- INI BLOCO 1 -->






              <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista de Clientes</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                  
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">
                  <button  id="status" name="status" value="Ativos" class="btn btn-primary btn-sm" onclick="redirectToLink(this)" style="background-color: #00d40a; border-color: #00d40a;">Ativos </button>
                  <button  id="statusInativo" name="statusInativo" value="Inativos" class="btn btn-warning btn-sm" onclick="redirectToLink(this)" style="background-color: #ff0202; border-color: #ff0202;"> Inativos </button>
                   <!-- Botão "Adicionar Produto" -->
                   <button class="btn btn-block btn-info btn-sm" onclick="window.location.href='form_cliente.php';">ADICIONAR CLIENTE</button>
                    <form method="GET" action="" style="display: flex;">
                        <input 
                            type="text" 
                            name="table_search" 
                            class="form-control input-sm pull-right" 
                            style="width: 150px;" 
                            placeholder="Buscar" 
                            value="<?php echo isset($_GET['table_search']) ? htmlspecialchars($_GET['table_search']) : ''; ?>" 
                        />
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                  </div>
                  

                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>STATUS</th>
                      <th>NOME</th>
                      <th>E-MAIL</th>
                      <th>CPF/CNPJ</th>
                      <th>RAZÃO SOCIAL</th>
                      <th>CIDADE</th>
                      <th>ESTADO</th> 
                      <th>STATUS</th>                      
                    </tr>
                    <tr>
                    <?php foreach ($dadosPagina as $client): ?>
                   <tr>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_IDCLIENT']) ?></td>
                        <td style="text-transform: uppercase; font-size: 15px;">
                            <a href="https://www.codemaze.com.br/site/admin/table_liquidacaoFinanceira.php?table_search=<? echo $client['CLI_NMNAME']; ?>" target="_self"><span class="label <?= $client['CLI_STSTATUSPENDING'] == 'Vencido' ? 'label-danger' : 'label-success' ?>">
                                <?= htmlspecialchars($client['CLI_STSTATUSPENDING']) ?> </a>
                            </span>
                        </td> 
                        <? $styleStatus = ($client['CLI_STSTATUS'] == "ATIVO") ? "text-transform: uppercase; font-size: 12px; color: #00d40a;" : "text-transform: uppercase; font-size: 12px; color: #ff0202;"; ?>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_NMNAME']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_DCEMAIL']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_DCCPFCNPJ']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_DCRSOCIAL']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_DCCITY']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($client['CLI_DCSTATE']) ?></td>
                        <td style="<? echo $styleStatus; ?>" ><?= htmlspecialchars($client['CLI_STSTATUS']) ?></td>                        
                        <td style="text-transform: uppercase; font-size: 15px;"><a href="https://www.codemaze.com.br/site/admin/form_cliente_edit.php?id=<? echo $client['CLI_IDCLIENT']; ?>" target="_self"><span class="label label-warning">EDITAR</span></a></td>        
                      </tr>
                    <?php endforeach; ?>   
                    </tr>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

<!-- Paginação -->
<nav aria-label="Page navigation" class="text-center">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="<?= ($i == $paginaAtual) ? 'active' : '' ?>">
                        <a href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>




              <!-- FIM BLOCO 1 -->

              </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!--/.col (right) -->
      </div>   <!-- /.row -->
    </section><!-- /.content -->

<script>
  // Função para redirecionar ao link quando o checkbox for selecionado
  function redirectToLink(button) {
    const value = button.value;
    window.location.href = `https://www.codemaze.com.br/site/admin/table_cliente.php?statusBusca=${value}`;
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

  </body>
</html>
