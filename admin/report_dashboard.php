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


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-blue">
    <div class="wrapper">
      



      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="margin-left: 0px; background-color: white;">


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-6">
            <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="30" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                      <div class="knob-label">New Visitors</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="70" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <div class="knob-label">Bounce Rate</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="-80" data-min="-150" data-max="150" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <div class="knob-label">Server Load</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="40" data-width="90" data-height="90" data-fgColor="#00c0ef"/>
                      <div class="knob-label">Disk Space</div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
            </div>
          </div><!-- /.row -->
        </section><!-- /.content -->



    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- FLOT CHARTS -->
    <script src="plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
    <!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
    <script src="plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
    <!-- FLOT PIE PLUGIN - also used to draw donut charts -->
    <script src="plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
    <!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
    <script src="plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>

    <style>
    /* Ocultar barras de rolagem */
    body, html {
      overflow: hidden; 
      height: 100%; 
      margin: 0; 
    }

    .content-wrapper {
      overflow: hidden; 
      height: 100%; 
    }
    </style>

   
  </body>
</html>
