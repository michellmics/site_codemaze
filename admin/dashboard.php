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
  $siteAdmin->getSiteInfo(); 
  $siteAdmin->getUserInfo();
  $siteAdmin->getAlertaInfo();

  //defin usuario
  if($_SESSION['user_sexo'] == "MASCULINO")
  {
    $imgProfile = "dist/img/avatar5.png";
  }
  else
      {
        $imgProfile = "dist/img/avatar3.png";
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
              <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- start message -->
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li><!-- end message -->
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user3-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="dist/img/user4-128x128.jpg" class="img-circle" alt="user image"/>
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li>


              <? $countAlertas = count($siteAdmin->ARRAY_ALERTA); ?>
              <!-- Notifications: style can be found in dropdown.less -->
              <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning"><?= $countAlertas ?></span>
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
                          $level = substr($item["ALE_DCLEVEL"],0,20);
                          $data = $item["ALE_DTALERTA"];
                          echo "<li><a href='#'><i class='fa fa-users text-aqua'></i>$msg</a></li>";
                        }
                      

                      ?>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">Ver Todos</a></li>
                </ul>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->





              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                      <li><!-- Task item -->
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li><!-- end task item -->
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li>
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
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> xxxxxx</a></li>
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
                <li><a href="#" onclick="loadInIframe('register.php')"><i class="fa fa-circle-o"></i> Cadastro de Usuários ADM</a></li>
                <li><a href="https://analytics.google.com/analytics/web/?authuser=1#/p463662711/reports/reportinghub?params=_u..nav%3Dmaui" target="_blank"><i class="fa fa-circle-o"></i> Google Analytics</a></li>
                <li><a href="https://ads.google.com/home/?subid=ww-ww-xs-ip-awhc-a-ogb_cons%21o2&authuser=1" target="_blank"><i class="fa fa-circle-o"></i> Google Ads</a></li>
              </ul> 
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Links</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="https://accounts.mlabs.io/accounts/sign_in" target="_blank"><i class="fa fa-circle-o"></i> mLabs Codemaze</a></li>
                <li><a href="https://www.codemaze.com.br/cpanel" target="_blank"><i class="fa fa-circle-o"></i> CPanel</a></li>
                <li><a href="https://conta.hostmidia.com.br/hospedagem/acessar-cpanel/55618/whm/" target="_blank"><i class="fa fa-circle-o"></i> WHM</a></li>
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
        <a href="https://codemaze.com.br" target="_blank">-&nbsp;&nbsp;&nbsp;&nbsp;CODEMAZE</a>&nbsp;&nbsp;Intranet versão 1.0 &nbsp;&nbsp;&nbsp;&nbsp;Login Realizado ás <? echo date('d/m/Y H:i:s'); ?> &nbsp;&nbsp;&nbsp;Nível de acesso: <font color="#39ed3f"><? echo $_SESSION['user_nivelacesso']; ?></font>
        
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
