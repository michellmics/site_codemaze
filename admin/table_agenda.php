<?php
  include_once 'objetos.php'; 
  $siteAdmin = new SITE_ADMIN();
  
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}
if ($_SESSION['user_nivelacesso'] == "ADMINISTRADOR") 
{
  if(isset($_GET['table_search'])) //trazer os dados de acordo com o q foi colocado na busca
  {
    $search = $_GET['table_search'];
    $result = $siteAdmin->getAgendaAtividadeInfoBySearch($search);
  }
  else
    {
      $siteAdmin->getAgendaAtividadesInfo();
    }
}

if ($_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
{
  if(isset($_GET['table_search'])) //trazer os dados de acordo com o q foi colocado na busca
  {
    $search = $_GET['table_search'];
    $idUser = $_SESSION['user_id'];
    $result = $siteAdmin->getAgendaAtividadeInfoByIdBySearch($search, $idUser);
  }
  else
    {
      $idUser = $_SESSION['user_id'];
      $siteAdmin->getAgendaAtividadesByIdInfo($idUser);
    }
}







// Configurações de Paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_AGENDAATIVIDADES);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_AGENDAATIVIDADES, $inicio, $registrosPorPagina);

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
                  <h3 class="box-title">Lista de Atividades</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                    
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">
                  <button  id="status" name="status" value="Ativos" class="btn btn-primary btn-sm" onclick="redirectToLink(this)" style="background-color: #00d40a; border-color: #00d40a;">futuro </button>
                  <button  id="statusInativo" name="statusInativo" value="Inativos" class="btn btn-warning btn-sm" onclick="redirectToLink(this)" style="background-color: #ff0202; border-color: #ff0202;"> futuro </button>
                   <!-- Botão "Adicionar Produto" -->
                   <button class="btn btn-block btn-info btn-sm" onclick="window.location.href='form_agenda.php';">
                        ADICIONAR ATIVIDADE
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
                      <th>STATUS</th>
                      <th></th>
                      <th>NOME</th>
                      <th>DATA INI</th>
                      <th>DATA FIM</th>
                      <th>TITULO</th>                 
                    </tr>
                    <tr>
                    <?php foreach ($dadosPagina as $atividade): ?>
                    <tr>
                        <? 
                          $result = $atividade['AGE_STSTATUS'];
                          if($result == "ATRASADO"){$icon = "label label-danger";}
                          if($result == "CONCLUÍDO"){$icon = "label label-success";}
                          if($result == "PENDENTE"){$icon = "label label-warning";}
                          if($result == "EM ANDAMENTO"){$icon = "label label-default";}
                         
                        ?>
                        <td style="text-transform: uppercase; font-size: 15px;"><span class="<? echo $icon; ?>"><? echo $result; ?></span></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><img src=<?php echo $atividade['USA_DCFOTO'] ?> class="user-image" alt="User Image" style="width: 25px; height: 25px;" alt="User Image"/></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($atividade['USA_DCNOME']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($atividade['AGE_DTINI']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($atividade['AGE_DTFIM']) ?></td>                  
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($atividade['AGE_DCTITULO']) ?></td>     
                        <td style="text-transform: uppercase; font-size: 15px;"><a href="https://www.codemaze.com.br/site/admin/form_agenda_edit.php?id=<? echo $atividade['AGE_IDAGENDA']; ?>" target="_self"><span class="label label-primary">VISUALIZAR</span></a></td>
                                           
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
    //window.location.href = `https://www.codemaze.com.br/site/admin/table_contrato.php?statusBusca=${value}`;
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
