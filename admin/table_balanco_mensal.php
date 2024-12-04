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
  $siteAdmin->getBalancoMensal();

// Configurações de Paginação
$registrosPorPagina = 12;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_BALANCOMENSAL);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_BALANCOMENSAL, $inicio, $registrosPorPagina);

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
                  <h3 class="box-title">Fechamento Mensal</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                    

                  

                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ANO</th>
                      <th>MÊS</th>
                      <th>DT FECHAMENTO</th>
                      <th>FATURAMENTO</th>
                      <th>DESPESA</th>
                      <th>L. LIQUIDO</th>                   
                    </tr>
                    <tr>
                    <?php foreach ($dadosPagina as $balanco): ?>
                    <tr>
                        <? 
                          $dataFormatada = date("d/m/Y", strtotime($balanco['BLM_DTFECHAMENTO'])); 
                          $timestamp = strtotime($balanco['BLM_DTFECHAMENTO']); 
                          $formatter = new IntlDateFormatter('pt_BR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, IntlDateFormatter::GREGORIAN, 'MMMM');
                          $mesPorExtenso = $formatter->format($timestamp);
                          $ano = date('Y', $timestamp);                        
                        ?>
                        <td style="text-transform: uppercase; font-size: 16px;"><?= $ano ?></td>
                        <td style="text-transform: uppercase; font-size: 16px;"><?= $mesPorExtenso ?></td>

                        <td style="text-transform: uppercase; font-size: 16px;"><?= $dataFormatada ?></td>
                        <td style="text-transform: uppercase; font-size: 16px; color: blue;">R$<?= htmlspecialchars($balanco['BLM_DCRECEITA']) ?></td>
                        <td style="text-transform: uppercase; font-size: 16px; color: red;">R$<?= htmlspecialchars($balanco['BLM_DCDESPESA']) ?></td>
                        <td style="text-transform: uppercase; font-size: 16px; color: green;">R$<?= htmlspecialchars($balanco['BLM_DCLIQUIDO']) ?></td>                 
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
