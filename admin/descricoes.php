<?php
  include_once 'objetos.php';
  /*
  session_start(); 
  define('SESSION_TIMEOUT', 1800); // 30 minutos
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }
*/
  $siteAdmin = new SITE_ADMIN();
  $descEmpresa_1 = $siteAdmin->getDescInfo("EMPRESA",1);
  $descEmpresa_2 = $siteAdmin->getDescInfo("EMPRESA",2);

  $descServicos_1 = $siteAdmin->getDescInfo("SERVICOS",1);
  $descServicos_2 = $siteAdmin->getDescInfo("SERVICOS",2);
  $descServicos_3 = $siteAdmin->getDescInfo("SERVICOS",3);
  $descServicos_4 = $siteAdmin->getDescInfo("SERVICOS",4);
  $descServicos_5 = $siteAdmin->getDescInfo("SERVICOS",5);
  $descServicos_6 = $siteAdmin->getDescInfo("SERVICOS",6);
  $descServicos_7 = $siteAdmin->getDescInfo("SERVICOS",7);

    //salvar formularios
    if ($_SERVER['REQUEST_METHOD'] === 'POST') //botao salvar empresa_1
    {
      $titulo = $_POST['titulo'];      
      $descricao = $_POST['descricao']; 
      $id = $_POST['id'];
      $page = $_POST['page'];

      $result = $siteAdmin->updateDesc($titulo, $descricao, $id, $page);

      if (isset($result['error'])) 
      {
        echo "<div class='alert alert-danger'>" . $result['error'] . "</div>";      
      } 
      else 
        {
          echo "<div class='alert alert-success'>" . $result['success'] . "</div> ";      
        }
    }

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
        <!-- Content Header (Page header) -->
      

        <!-- Main content  INI -->
        

       






        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-6">
              <!-- general form elements -->

              <!-- INI BLOCO 1 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->
                  
                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_1["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descEmpresa_1["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_empresa_1" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 1 -->

              <!-- INI BLOCO 2 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Empresa</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="EMPRESA"/>
                  <input type="hidden" name="id" value="2"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descEmpresa_2["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descEmpresa_2["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_empresa_2" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 2 -->

              <!-- Form Element sizes -->
              <div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Different Height</h3>
                </div>
                <div class="box-body">
                  <input class="form-control input-lg" type="text" placeholder=".input-lg">
                  <br/>
                  <input class="form-control" type="text" placeholder="Default input">
                  <br/>
                  <input class="form-control input-sm" type="text" placeholder=".input-sm">
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Different Width</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-3">
                      <input type="text" class="form-control" placeholder=".col-xs-3">
                    </div>
                    <div class="col-xs-4">
                      <input type="text" class="form-control" placeholder=".col-xs-4">
                    </div>
                    <div class="col-xs-5">
                      <input type="text" class="form-control" placeholder=".col-xs-5">
                    </div>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- Input addon -->
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">Input Addon</h3>
                </div>
                <div class="box-body">
                  <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control" placeholder="Username">
                  </div>
                  <br/>
                  <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-addon">.00</span>
                  </div>
                  <br/>
                  <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input type="text" class="form-control">
                    <span class="input-group-addon">.00</span>
                  </div>

                  <h4>With icons</h4>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="text" class="form-control" placeholder="Email">
                  </div>
                  <br/>
                  <div class="input-group">
                    <input type="text" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                  </div>
                  <br/>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                    <input type="text" class="form-control">
                    <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                  </div>

                  <h4>With checkbox and radio inputs</h4>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox">
                        </span>
                        <input type="text" class="form-control">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    <div class="col-lg-6">
                      <div class="input-group">
                        <span class="input-group-addon">
                          <input type="radio">
                        </span>
                        <input type="text" class="form-control">
                      </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                  </div><!-- /.row -->

                  <h4>With buttons</h4>
                  <p class="margin">Large: <code>.input-group.input-group-lg</code></p>
                  <div class="input-group input-group-lg">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action <span class="fa fa-caret-down"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control">
                  </div><!-- /input-group -->
                  <p class="margin">Normal</p>
                  <div class="input-group">
                    <div class="input-group-btn">
                      <button type="button" class="btn btn-danger">Action</button>
                    </div><!-- /btn-group -->
                    <input type="text" class="form-control">
                  </div><!-- /input-group -->
                  <p class="margin">Small <code>.input-group.input-group-sm</code></p>
                  <div class="input-group input-group-sm">
                    <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button class="btn btn-info btn-flat" type="button">Go!</button>
                    </span>
                  </div><!-- /input-group -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div><!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
              
              <!-- INI BLOCO 3 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="1"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_1["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_1["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_1" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 3 -->

              <!-- INI BLOCO 4 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="2"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_2["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_2["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_2" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 4 -->

              <!-- INI BLOCO 5 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="3"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_3["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_3["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_3" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 5 -->

              <!-- INI BLOCO 6 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="4"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_4["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_4["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_4" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 6 -->

              <!-- INI BLOCO 7 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="5"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_5["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_5["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_5" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 7 -->

              <!-- INI BLOCO 8 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="6"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_6["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_6["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_6" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 8 -->

              <!-- INI BLOCO 9 -->
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Página - Serviços</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" action="descricoes.php">

                  <!-- CAMPOS COMO VARIAVEIS -->
                  <input type="hidden" name="page" value="SERVICOS"/>
                  <input type="hidden" name="id" value="7"/>
                  <!-- CAMPOS COMO VARIAVEIS -->

                  <!-- textarea -->
                  <div class="form-group">
                    <label>Título</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="titulo" value="<?php echo htmlspecialchars($descServicos_7["PAD_DCTITLE"]); ?>"/>
                  </div>
                  <!-- textarea -->
                  <div class="form-group">
                      <label>Descrição</label>
                      <textarea class="form-control" rows="10" placeholder="Enter ..." name="descricao"><?php echo $descServicos_7["PAD_DCTEXT"]; ?></textarea>
                  </div>
                  <div class="box-footer">
                    <button type="submit" name="salvar_servicos_7" class="btn btn-primary">Salvar</button>
                  </div>
                </form>
              </div>
              <!-- FIM BLOCO 9 -->
                    

                    <!-- input states -->
                    <div class="form-group has-success">
                      <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                      <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..."/>
                    </div>
                    <div class="form-group has-warning">
                      <label class="control-label" for="inputWarning"><i class="fa fa-bell-o"></i> Input with warning</label>
                      <input type="text" class="form-control" id="inputWarning" placeholder="Enter ..."/>
                    </div>
                    <div class="form-group has-error">
                      <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with error</label>
                      <input type="text" class="form-control" id="inputError" placeholder="Enter ..."/>
                    </div>

                    <!-- checkbox -->
                    <div class="form-group">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"/>
                          Checkbox 1
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox"/>
                          Checkbox 2
                        </label>
                      </div>

                      <div class="checkbox">
                        <label>
                          <input type="checkbox" disabled/>
                          Checkbox disabled
                        </label>
                      </div>
                    </div>

                    <!-- radio -->
                    <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                          Option one is this and that&mdash;be sure to include why it's great
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                          Option two can be something else and selecting it will deselect option one
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3" disabled/>
                          Option three is disabled
                        </label>
                      </div>
                    </div>

                    <!-- select -->
                    <div class="form-group">
                      <label>Select</label>
                      <select class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Disabled</label>
                      <select class="form-control" disabled>
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>

                    <!-- Select multiple-->
                    <div class="form-group">
                      <label>Select Multiple</label>
                      <select multiple class="form-control">
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Select Multiple Disabled</label>
                      <select multiple class="form-control" disabled>
                        <option>option 1</option>
                        <option>option 2</option>
                        <option>option 3</option>
                        <option>option 4</option>
                        <option>option 5</option>
                      </select>
                    </div>

                  </form>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!--/.col (right) -->
          </div>   <!-- /.row -->
        </section><!-- /.content -->





























































      <!-- Main content FIM -->

      

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
