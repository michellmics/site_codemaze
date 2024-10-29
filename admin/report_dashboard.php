<?php
  include_once 'objetos.php'; 
  
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

setlocale(LC_TIME, 'pt_BR.UTF-8');
$mêsCorrente = strftime('%B');
$anoCorrente = date('Y');

$despesas = 125; //provisorio


  $dashboardValues = new SITE_ADMIN(); 
  $totalCLient = $dashboardValues->countClientes();
  $totalProdutos = $dashboardValues->countProdutos();
  $totalProdutos = $dashboardValues->countProdutos();
  $totalContratosInativos = $dashboardValues->countContratosInativos();
  $totalContratosAtivos = $dashboardValues->countContratosAtivos();
  $countReceitaMesCorrente = $dashboardValues->countReceitaMesCorrente();
  $countContratosVencer = $dashboardValues->countContratosVencer();
  $countContratosVencidos = $dashboardValues->countContratosVencidos();
  $countContratosLiquidados = $dashboardValues->countContratosLiquidados();
  $countProdutosHospedagem = $dashboardValues->countProdutosHospedagem();

 
  $liquidoMêsCorrente = $countReceitaMesCorrente["0"]["TOTAL"] - $despesas;









 // <? echo $countContratosLiquidados["0"]["TOTAL"]; 



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
  <body class="skin-blue">
    <div class="wrapper">
      



      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="margin-left: 0px; background-color: white;">


        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-6">
              <div class="row">

              <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>
                  <sup style="font-size: 20px">R$</sup><? echo $countReceitaMesCorrente["0"]["TOTAL"]; ?>
                  </h3>
                  <p>
                  Receitas Mês <? echo $mêsCorrente; ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">
                Ver Detalhe <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>
                  <sup style="font-size: 20px">R$</sup><? echo $despesas; ?>
                  </h3>
                  <p>
                  Despesas Mês <? echo $mêsCorrente; ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">
                Ver Detalhe <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>
                  <sup style="font-size: 20px">R$</sup><? echo $liquidoMêsCorrente; ?>
                  </h3>
                  <p>
                  Liquido Mês <? echo $mêsCorrente; ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">
                  Ver Detalhe <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-purple">
                <div class="inner">
                  <h3>
                  <sup style="font-size: 20px">R$</sup>0
                  </h3>
                  <p>
                  Liquido Acum. <? echo $anoCorrente; ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-briefcase-outline"></i>
                </div>
                <a href="#" class="small-box-footer">
                Ver Detalhe <i class="fa fa-arrow-circle-right"></i>
                </a>
              </div>
            </div><!-- ./col -->
     

                    
                </div><!-- /.row -->
            </div>

            <div class="col-md-4"> 
              <div class="progress-group">
                <span class="progress-text">Hosting Slots Dísponiveis</span>
                <span class="progress-number"><b><? $hostPerc = ($countProdutosHospedagem["0"]["TOTAL"]/10)*100; echo $countProdutosHospedagem["0"]["TOTAL"]; ?></b>/10</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: <? echo $hostPerc; ?>%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Plano de Consultoria </span>
                <span class="progress-number"><b>2</b>/10</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 20%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Desenvolvimento de Sites</span>
                <span class="progress-number"><b>2</b>/20</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 10%"></div>
                </div>
              </div><!-- /.progress-group -->
            </div><!-- /.col -->



          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-6">
              <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $totalCLient["0"]["TOTAL"]; ?>" data-max="100" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                      <div class="knob-label">Clientes</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $totalProdutos["0"]["TOTAL"]; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                      <div class="knob-label">Produtos Cadastrados</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $totalContratosAtivos["0"]["TOTAL"]; ?>" data-min="0" data-max="90" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                      <div class="knob-label">Contratos Ativos</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $totalContratosInativos["0"]["TOTAL"]; ?>" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <div class="knob-label">Contratos Inativos</div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
            </div>


            <div class="col-md-4">
              <div class="progress-group">
                <span class="progress-text">Tráfego Pago (R$)</span>
                <span class="progress-number"><b>0</b>/500</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 20%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Contratos Social Midia</span>
                <span class="progress-number"><b>0</b>/10</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 80%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Futuro</span>
                <span class="progress-number"><b>0</b>/0</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 0%"></div>
                </div>
              </div><!-- /.progress-group -->
            </div><!-- /.col -->


          </div><!-- /.row -->

          
          <div class="row">
            <div class="col-md-6">
            <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $countContratosVencer["0"]["TOTAL"]; ?>" data-max="100" data-width="90" data-height="90" data-fgColor="#3c8dbc"/>
                      <div class="knob-label">Contratos a Vencer<BR>Próximos 10 dias</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $countContratosVencidos["0"]["TOTAL"]; ?>" data-width="90" data-height="90" data-fgColor="#f56954"/>
                      <div class="knob-label">Contratos em Atraso<BR>Maior que 6 dias</div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="<? echo $countContratosLiquidados["0"]["TOTAL"]; ?>" data-min="0" data-max="90" data-width="90" data-height="90" data-fgColor="#00a65a"/>
                      <div class="knob-label">Contratos Liquidados<BR><? echo $mêsCorrente; ?></div>
                    </div><!-- ./col -->
                    <div class="col-md-3 col-sm-6 col-xs-6 text-center">
                      <input type="text" class="knob" value="0" data-width="90" data-height="90" data-fgColor="#00c0ef"/>
                      <div class="knob-label">Vago</div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
            </div>

            <div class="col-md-4">
              <div class="progress-group">
                <span class="progress-text">Futuro</span>
                <span class="progress-number"><b>0</b>/0</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 0%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Futuro</span>
                <span class="progress-number"><b>0</b>/0</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 0%"></div>
                </div>
              </div><!-- /.progress-group -->
              <div class="progress-group">
                <span class="progress-text">Futuro</span>
                <span class="progress-number"><b>0</b>/0</span>
                <div class="progress sm">
                  <div class="progress-bar progress-bar-primary progress-bar-striped" style="width: 0%"></div>
                </div>
              </div><!-- /.progress-group -->
            </div><!-- /.col -->


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

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
    <!-- jQuery Knob -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>

<script type="text/javascript">
      $(function () {
        /* jQueryKnob */

        $(".knob").knob({
          /*change : function (value) {
           //console.log("change : " + value);
           },
           release : function (value) {
           console.log("release : " + value);
           },
           cancel : function () {
           console.log("cancel : " + this.value);
           },*/
          draw: function () {

            // "tron" case
            if (this.$.data('skin') == 'tron') {

              var a = this.angle(this.cv)  // Angle
                      , sa = this.startAngle          // Previous start angle
                      , sat = this.startAngle         // Start angle
                      , ea                            // Previous end angle
                      , eat = sat + a                 // End angle
                      , r = true;

              this.g.lineWidth = this.lineWidth;

              this.o.cursor
                      && (sat = eat - 0.3)
                      && (eat = eat + 0.3);

              if (this.o.displayPrevious) {
                ea = this.startAngle + this.angle(this.value);
                this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                this.g.beginPath();
                this.g.strokeStyle = this.previousColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                this.g.stroke();
              }

              this.g.beginPath();
              this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
              this.g.stroke();

              this.g.lineWidth = 2;
              this.g.beginPath();
              this.g.strokeStyle = this.o.fgColor;
              this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
              this.g.stroke();

              return false;
            }
          }
        });
        /* END JQUERY KNOB */

        //INITIALIZE SPARKLINE CHARTS
        $(".sparkline").each(function () {
          var $this = $(this);
          $this.sparkline('html', $this.data());
        });

        /* SPARKLINE DOCUMENTAION EXAMPLES http://omnipotent.net/jquery.sparkline/#s-about */
        drawDocSparklines();
        drawMouseSpeedDemo();

      });
      function drawDocSparklines() {

        // Bar + line composite charts
        $('#compositebar').sparkline('html', {type: 'bar', barColor: '#aaf'});
        $('#compositebar').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                {composite: true, fillColor: false, lineColor: 'red'});


        // Line charts taking their values from the tag
        $('.sparkline-1').sparkline();

        // Larger line charts for the docs
        $('.largeline').sparkline('html',
                {type: 'line', height: '2.5em', width: '4em'});

        // Customized line chart
        $('#linecustom').sparkline('html',
                {height: '1.5em', width: '8em', lineColor: '#f00', fillColor: '#ffa',
                  minSpotColor: false, maxSpotColor: false, spotColor: '#77f', spotRadius: 3});

        // Bar charts using inline values
        $('.sparkbar').sparkline('html', {type: 'bar'});

        $('.barformat').sparkline([1, 3, 5, 3, 8], {
          type: 'bar',
          tooltipFormat: '{{value:levels}} - {{value}}',
          tooltipValueLookups: {
            levels: $.range_map({':2': 'Low', '3:6': 'Medium', '7:': 'High'})
          }
        });

        // Tri-state charts using inline values
        $('.sparktristate').sparkline('html', {type: 'tristate'});
        $('.sparktristatecols').sparkline('html',
                {type: 'tristate', colorMap: {'-2': '#fa7', '2': '#44f'}});

        // Composite line charts, the second using values supplied via javascript
        $('#compositeline').sparkline('html', {fillColor: false, changeRangeMin: 0, chartRangeMax: 10});
        $('#compositeline').sparkline([4, 1, 5, 7, 9, 9, 8, 7, 6, 6, 4, 7, 8, 4, 3, 2, 2, 5, 6, 7],
                {composite: true, fillColor: false, lineColor: 'red', changeRangeMin: 0, chartRangeMax: 10});

        // Line charts with normal range marker
        $('#normalline').sparkline('html',
                {fillColor: false, normalRangeMin: -1, normalRangeMax: 8});
        $('#normalExample').sparkline('html',
                {fillColor: false, normalRangeMin: 80, normalRangeMax: 95, normalRangeColor: '#4f4'});

        // Discrete charts
        $('.discrete1').sparkline('html',
                {type: 'discrete', lineColor: 'blue', xwidth: 18});
        $('#discrete2').sparkline('html',
                {type: 'discrete', lineColor: 'blue', thresholdColor: 'red', thresholdValue: 4});

        // Bullet charts
        $('.sparkbullet').sparkline('html', {type: 'bullet'});

        // Pie charts
        $('.sparkpie').sparkline('html', {type: 'pie', height: '1.0em'});

        // Box plots
        $('.sparkboxplot').sparkline('html', {type: 'box'});
        $('.sparkboxplotraw').sparkline([1, 3, 5, 8, 10, 15, 18],
                {type: 'box', raw: true, showOutliers: true, target: 6});

        // Box plot with specific field order
        $('.boxfieldorder').sparkline('html', {
          type: 'box',
          tooltipFormatFieldlist: ['med', 'lq', 'uq'],
          tooltipFormatFieldlistKey: 'field'
        });

        // click event demo sparkline
        $('.clickdemo').sparkline();
        $('.clickdemo').bind('sparklineClick', function (ev) {
          var sparkline = ev.sparklines[0],
                  region = sparkline.getCurrentRegionFields();
          value = region.y;
          alert("Clicked on x=" + region.x + " y=" + region.y);
        });

        // mouseover event demo sparkline
        $('.mouseoverdemo').sparkline();
        $('.mouseoverdemo').bind('sparklineRegionChange', function (ev) {
          var sparkline = ev.sparklines[0],
                  region = sparkline.getCurrentRegionFields();
          value = region.y;
          $('.mouseoverregion').text("x=" + region.x + " y=" + region.y);
        }).bind('mouseleave', function () {
          $('.mouseoverregion').text('');
        });
      }

      /**
       ** Draw the little mouse speed animated graph
       ** This just attaches a handler to the mousemove event to see
       ** (roughly) how far the mouse has moved
       ** and then updates the display a couple of times a second via
       ** setTimeout()
       **/
      function drawMouseSpeedDemo() {
        var mrefreshinterval = 500; // update display every 500ms
        var lastmousex = -1;
        var lastmousey = -1;
        var lastmousetime;
        var mousetravel = 0;
        var mpoints = [];
        var mpoints_max = 30;
        $('html').mousemove(function (e) {
          var mousex = e.pageX;
          var mousey = e.pageY;
          if (lastmousex > -1) {
            mousetravel += Math.max(Math.abs(mousex - lastmousex), Math.abs(mousey - lastmousey));
          }
          lastmousex = mousex;
          lastmousey = mousey;
        });
        var mdraw = function () {
          var md = new Date();
          var timenow = md.getTime();
          if (lastmousetime && lastmousetime != timenow) {
            var pps = Math.round(mousetravel / (timenow - lastmousetime) * 1000);
            mpoints.push(pps);
            if (mpoints.length > mpoints_max)
              mpoints.splice(0, 1);
            mousetravel = 0;
            $('#mousespeed').sparkline(mpoints, {width: mpoints.length * 2, tooltipSuffix: ' pixels per second'});
          }
          lastmousetime = timenow;
          setTimeout(mdraw, mrefreshinterval);
        };
        // We could use setInterval instead, but I prefer to do it this way
        setTimeout(mdraw, mrefreshinterval);
      }


    </script>

   
  </body>
</html>
