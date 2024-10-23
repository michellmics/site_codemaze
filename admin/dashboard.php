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
                <i class="fa fa-edit"></i> <span>Formularios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">               
                <li><a href="#" onclick="loadInIframe('table_cliente.php')"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="#" onclick="loadInIframe('table_produto.php')"><i class="fa fa-circle-o"></i> Produtos</a></li>
                <li><a href="#" onclick="loadInIframe('table_contrato.php')"><i class="fa fa-circle-o"></i> Gestão de contratos</a></li>
                <li><a href="#" onclick="loadInIframe('table_liquidacaoFinanceira.php')"><i class="fa fa-circle-o"></i> Liq. FInanceira</a></li>
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> Fluxo de Caixa</a></li>
                <li><a href="#" onclick="loadInIframe('form_produto.php')"><i class="fa fa-circle-o"></i> Conciliação Fiscal</a></li>
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
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
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
