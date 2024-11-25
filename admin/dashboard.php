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

  $siteAdmin = new SITE_ADMIN();
  $siteAdmin->getSiteInfo(); 
  $siteAdmin->getUserInfo();
  $siteAdmin->getAlertaInfo();

  var_dump($siteAdmin->ARRAY_USERINFO);
  die();

  //defin usuario

if($siteAdmin->ARRAY_USERINFO[0]["USA_DCFOTO"] == "NULL")
{
  if($_SESSION['user_sexo'] == "MASCULINO")
  {
    $imgProfile = "dist/img/avatar5.png";
  }
  else
      {
        $imgProfile = "dist/img/avatar3.png";
      }
}
else
    {
      $imgProfile = $siteAdmin->ARRAY_USERINFO["USA_DCFOTO"];
    }

if (isset($_GET['alerta'])) //reconheciento de alerta
{
  $ALE_IDALERTA = $_GET['alerta'];
  $siteAdmin->alarmeRecon($ALE_IDALERTA);
}

?>


<!DOCTYPE html>
<html>
  <head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4VK4QL1B8G"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
        
      gtag('config', 'G-4VK4QL1B8G');
    </script>
    <meta charset="UTF-8">
    <title>Intranet Codemaze</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
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

    <style>
    html, body {
      overflow: hidden;
      height: 100%;
      margin: 0;
      padding: 0;
    }
  
    .footer {
      position: fixed;
      left: 0;
      bottom: 0;
      width: 100%;
      background-color: #222d32;
      color: white;
      text-align: left;
      padding: 10px 0;
      font-size: 12px;
    }

    header.main-header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9999; /* Garante que o header esteja acima de outros elementos */
  background-color: #fff; /* Pode ser ajustado para a cor de fundo desejada */
}

.content-wrapper {
  margin-top: 60px; /* Ajuste conforme a altura do seu cabeçalho */
}

.content-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000; /* Garante que o conteúdo da header fique acima de outros elementos */
  background-color: #f4f4f4; /* Se necessário, defina a cor de fundo */
  padding: 10px 15px; /* Ajuste o espaçamento conforme necessário */
  box-shadow: 0 2px 5px rgba(0,0,0,0.1); /* Sombras para destacar a seção */
}

.content {
  margin-top: 40px; /* Ajuste o valor conforme necessário, dependendo da altura da header fixa */
}

  </style>
  
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="https://www.codemaze.com.br/site/admin/dashboard.php" class="logo"><b>  <?php echo htmlspecialchars($siteAdmin->ARRAY_SITEINFO["SBI_DCSITE"]); ?></b></a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              

              <? $countAlertas = count($siteAdmin->ARRAY_ALERTA); ?>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <?
                    if($countAlertas != 0)
                    {
                      echo "<span class='label label-warning'>$countAlertas</span>";
                    }
                    
                  ?>                  
                </a>
                <ul class="dropdown-menu">
                  <li class="header">Você têm <?= $countAlertas ?> notificações</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">

                      <?
                        foreach($siteAdmin->ARRAY_ALERTA as $item)
                        {
                          $msg = $item["ALE_DCMSG"];
                          $level = $item["ALE_DCLEVEL"];
                          $data = $item["ALE_DTALERTA"];
                          $icon = "fa fa-users text-aqua";
                          $idAlerta = $item["ALE_IDALERTA"];

                          if($level == "Warning"){$icon = "fa fa-warning text-yellow";}
                          if($level == "High"){$icon = "fa fa-users text-red";}
                          if($level == "Info"){$icon = "fa fa-users text-aqua";}

                          echo "<li style='display: flex; align-items: center; justify-content: space-between; padding: 5px 0;'>
                                  <a href='#' onclick='showModal(\"$msg\", \"$idAlerta\")'><i class='".$icon."'></i>$msg</a>
                                   <button onclick='reconAlarme($idAlerta)' style='padding: 3px 6px; border: none; background-color: #007bff; color: white; border-radius: 4px; cursor: pointer; margin-right: 5px;'>OK</button>  
                                </li>";
                        }
                      

                      ?>
                    </ul>
                  </li>
                  <!-- <li class="footer"><a href="#">Ver Todos</a></li> -->
                </ul>
              </li>
              



              <script>
                function reconAlarme(alertaId) {
                  fetch('dashboard.php?alerta=' + alertaId)
                  .then(response => response.text())
                  .then(data => {
                    window.location.reload();
                  })
                  .catch(error => console.error('Erro:', error));
                }

                function showModal(message,id) {
                  // Define o conteúdo do corpo do modal
                  document.getElementById('modalBodyContent').innerText = message;
                  document.getElementById('idAlerta').innerText = id; // ID do alerta

                  // Abre o modal
                  $('#alertModal').modal('show');
                }

              </script>          


                <!-- Notifications: style can be found in dropdown.less -->

              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src=<? echo $imgProfile ?> class="user-image" alt="User Image"/>                    
                  <span class="hidden-xs"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src=<? echo $imgProfile ?> class="img-circle" alt="User Image" />
                    <p>
                    <?php echo htmlspecialchars($_SESSION['user_name']); ?> - ADM
                      <small><?php echo htmlspecialchars($_SESSION['user_email']); ?></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                       <!--<a href="#">Followers</a>-->
                    </div>
                    <div class="col-xs-4 text-center">
                       <!--<a href="#">Sales</a>-->
                    </div>
                    <div class="col-xs-4 text-center">
                       <!--<a href="#">Friends</a>-->
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <!-- <a href="#" class="btn btn-default btn-flat">Profile</a>-->
                    </div>
                    <div class="pull-right">
                      <a href="logoff.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            
          </div>
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"><?php echo htmlspecialchars($siteAdmin->ARRAY_SITEINFO["SBI_DCDOMAINSITE"]); ?></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Financeiro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">               
                <li><a href="#" onclick="loadInIframe('table_cliente.php')"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="#" onclick="loadInIframe('table_produto.php')"><i class="fa fa-circle-o"></i> Produtos</a></li>
                <li><a href="#" onclick="loadInIframe('table_contrato.php')"><i class="fa fa-circle-o"></i> Gestão de Contratos</a></li>
                <li><a href="#" onclick="loadInIframe('table_liquidacaoFinanceira.php')"><i class="fa fa-circle-o"></i> Contas a Receber</a></li>
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> Contas a Pagar</a></li>
                <li><a href="#" onclick="loadInIframe('table_balanco_mensal.php')"><i class="fa fa-circle-o"></i> Fechamento Mensal</a></li> 
              </ul> 
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Relatórios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" onclick="loadInIframe('report_dashboard.php')"><i class="fa fa-circle-o"></i> Desempenho Geral</a></li>
              </ul> 
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Parâmetros</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> Configurações</a></li>
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> Dados da Codemaze</a></li>
              </ul> 
            </li>        

            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Papelaria</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="https://www.codemaze.com.br/site/admin/papelaria/CARTAO_MICHELL_FRONT.pdf" target="_blank"><i class="fa fa-circle-o"></i> Cartão Michell</a></li>
                <li><a href="https://www.codemaze.com.br/site/admin/papelaria/CARTAO_VANESSA_FRONT.pdf" target="_blank"><i class="fa fa-circle-o"></i> Cartão Vanessa</a></li>
                <li><a href="https://www.codemaze.com.br/site/admin/papelaria/CARTAO_BACK.pdf" target="_blank"><i class="fa fa-circle-o"></i> Cartão Back</a></li>
                <li><a href="https://www.codemaze.com.br/site/admin/papelaria/proposta_modelo.pptx" target="_blank"><i class="fa fa-circle-o"></i> Proposta Comercial</a></li>
                <li><a href="https://www.codemaze.com.br/site/admin/papelaria/CONTRATO_PROJETO_SITE.docx" target="_blank"><i class="fa fa-circle-o"></i> Contrato Desen. Site</a></li>
              </ul> 
            </li>            
            
            
            
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            SGCS - Sistema de Gestão de Clientes e Serviços
            <small>Versão 1.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="https://www.codemaze.com.br/site/admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
          </ol>
        </section>
      
      <!--##############################################################-->
      <!-- Main content FRAME INI-->
      <!--##############################################################-->
        

      <!-- Script JavaScript -->
      <script>
        function loadInIframe(url) {
          document.getElementById('contentFrame').src = url;
        }

        // Carrega a URL inicial no iframe quando a página é carregada
        window.onload = function() {
          loadInIframe('report_dashboard.php'); 
        };
      </script>


      <section class="content">
        <div class="embed-responsive embed-responsive-16by9">
          <iframe 
            id="contentFrame" 
            class="embed-responsive-item" 
            style="border:0; width:100%; height:80%;" 
            allowfullscreen>
          </iframe>
        </div>
      </section>

      

      <footer class="footer">
        <div class="container text-left">
        <a href="https://codemaze.com.br" target="_blank">-&nbsp;&nbsp;&nbsp;&nbsp;CODEMAZE</a>&nbsp;&nbsp;Sistema de Gestão de Clientes e Serviços &nbsp;&nbsp;&nbsp;&nbsp;Login Realizado ás <? echo date('d/m/Y H:i:s'); ?> &nbsp;&nbsp;&nbsp;Nível de acesso: <font color="#39ed3f"><? echo $_SESSION['user_nivelacesso']; ?></font>
        
        </div>
      </footer>



      <!--##############################################################-->
      <!-- Main content FRAME END-->
      <!--##############################################################-->


      </div><!-- /.content-wrapper -->

      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
  </body>
</html>
