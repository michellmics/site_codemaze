<?php
  include_once 'objetos.php';

  $siteAdmin = new SITE_ADMIN();
  $result = $siteAdmin->getSiteInfo();

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Administração - Site <?php echo htmlspecialchars($siteAdmin->ARRAY_SITEINFO["SBI_DCDOMAINSITE"]); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="register-page">
    <div class="register-box">
      <div class="register-logo">
      <img src="../images/logos/logocodemaze_preto.png"></img>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Cadastro de novo usuário(a)</p>
        <form action="register_proc.php" method="post" onsubmit="return validarFormulario()">
          <div class="form-group has-feedback">
            <input type="text" name="nome" class="form-control" placeholder="Nome Completo" required/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="E-mail" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <select name="sexo" class="form-control" required>
              <option value="" disabled selected>Selecione o sexo</option>
              <option value="M">MASCULINO</option>
              <option value="F">FEMININO</option>
            </select>
          </div>

          <div class="form-group has-feedback">
            <input type="password" name="senha" class="form-control" placeholder="Digite a senha" required/>
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck"></div>                        
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
          </div>
        </form>

      <script>
        function validarFormulario() {
          const nome = document.querySelector('input[name="nome"]').value.trim();
          const email = document.querySelector('input[name="email"]').value.trim();
          const sexo = document.querySelector('select[name="sexo"]').value;
          const senha = document.querySelector('input[name="senha"]').value.trim();
        
          if (!nome || !email || !sexo || !senha) {
            alert("Todos os campos devem ser preenchidos.");
            return false; // Impede o envio do formulário
          }
          return true; // Permite o envio do formulário
        }
      </script>      

       

        
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>