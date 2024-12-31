<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
  //$result = $siteAdmin->getPublicidadeInfoBySearch($search);
}
else 
    {
      $siteAdmin->getPublicidadeInfo();
    }




// Configurações de Paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_PUBLICIDADEINFO);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_PUBLICIDADEINFO, $inicio, $registrosPorPagina);

//-----------------

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
                  <h3 class="box-title">Lista de Contratos</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                    
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">
                   <!-- Botão "Adicionar Produto" -->
                   <button class="btn btn-block btn-info btn-sm" onclick="window.location.href='form_publicidade.php';">
                        ADICIONAR PUBLICIDADE
                      </button>
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
                      <th></th>
                      <th>CLIENTE ORIGEM</th>
                      <th>CLIENTE DESTINO</th>
                      <th>NOME CAMPANHA</th>
                      <th>TIPO CAMPANHA</th>
                      <th>DATA INI</th> 
                      <th>DATA FINAL</th>
                      <th>SITE</th>
                      <th>STATUS</th>   
                      <th></th>                    
                    </tr>
                    <tr>
                    <?php foreach ($dadosPagina as $publicidade): ?>
                    <tr>
                        <? 
                          $styleStatus = ($publicidade['CLI_STSTATUS'] == "ATIVO") ? "text-transform: uppercase; font-size: 12px; color: #00d40a;" : "text-transform: uppercase; font-size: 12px; color: #ff0202;"; 
                          if($publicidade['CLI_STSTATUS']== ""){$icon = "label label-danger";}
                          if($publicidade['CLI_STSTATUS'] != ""){$icon = "label label-success";}
                        ?>

                        <td style="text-transform: uppercase; font-size: 14px;"><b><?= htmlspecialchars($publicidade['MKT_IDMKTPUBLICIDADE']) ?></b></td>
                        <td style="text-transform: uppercase; font-size: 15px;"><span class="<? echo $icon; ?>"><? echo "teste"; ?></span></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['CLIENTE ORIGEM']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['CLIENTE DESTINO']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['MKT_NMCAMPANHA']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['MKT_DCTIPO']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['MKT_DTINI']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['MKT_DTFIM']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($publicidade['CLI_DCSITE']) ?></td>   
                        <td style="<? echo $styleStatus; ?>"><?= htmlspecialchars($publicidade['CLI_STSTATUS']) ?></td>                        
                        <td style="text-transform: uppercase; font-size: 15px;"><a href="https://www.codemaze.com.br/site/admin/form_contrato_edit.php?id=<? echo $publicidade['GEC_IDGESTAO_CONTRATO']; ?>" target="_self"><span class="label label-warning">EDITAR</span></a></td>
                                           
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
    window.location.href = `https://www.codemaze.com.br/site/admin/table_contrato.php?statusBusca=${value}`;
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
