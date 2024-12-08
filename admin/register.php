<?php
include_once 'objetos.php';

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}

if ($_SESSION['user_nivelacesso'] != "ADMINISTRADOR") 
{
  header("Location: noAuth.html");
  exit();
}

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

    <!-- ######################################################## --> 
    <!-- SWEETALERT 2 --> 
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <!-- ######################################################## --> 

</head>
<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="../images/logos/logocodemaze_preto.png" alt="Logo" />
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Cadastro de novo usuário(a)</p>
             <form id="form-empresa" role="form" method="POST" enctype="multipart/form-data">
                <div class="form-group has-feedback">
                    <input type="text" name="nome" class="form-control" placeholder="Nome Completo" maxlength="45" required/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" maxlength="45" required/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <select name="sexo" class="form-control" required>
                        <option value="" disabled selected>Selecione o sexo</option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMININO">FEMININO</option>
                    </select>
                </div>

                <div class="form-group has-feedback">
                    <select name="nivel" class="form-control" required>
                        <option value="" disabled selected>Nível de Acesso</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                        <option value="FINANCEIRO">FINANCEIRO</option>
                        <option value="OPERADOR">OPERADOR</option>
                        <option value="RECEPCAO">RECEPÇÃO</option>
                        <option value="SUPORTE TECNICO">SUPORTE TÉCNICO</option>
                    </select>
                </div>

                <div class="form-group has-feedback">
                    <select name="prospec" class="form-control" required>
                        <option value="" disabled selected>Prospecção de Clientes</option>
                        <option value="NÃO">NÃO</option>
                        <option value="SIM">SIM</option>
                    </select>
                </div>

                <div class="form-group has-feedback">
                    <label for="senha">Senha: 8 Caracteres 1 Especial e 1 Maiúscula</label>
                    <input type="password" name="senha" class="form-control" placeholder="Digite a senha" maxlength="20" required/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <label for="foto">Foto (tamanho máximo: 2MB)</label>
                    <input type="file" name="foto" id="foto" class="form-control" accept=".jpg,.jpeg,.png"/>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck"></div>                        
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <!-- <button type="button" onclick="validarFormulario()" class="btn btn-primary btn-block btn-flat">Registrar</button> -->
                        <button type="submit" id="salvar_empresa_1" name="salvar_empresa_1" class="btn btn-primary btn-block btn-flat">Registrar</button>
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
                        return false;
                    }

                    // Validação do e-mail
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expressão regular básica para e-mail
                    if (!emailRegex.test(email)) {
                        alert("Por favor, insira um endereço de e-mail válido.");
                        return false;
                    }

                    // Expressão regular para validar a senha
                    const senhaRegex = /^(?=.*[A-Z])(?=.*[\W_])(?=.{8,})/; // Pelo menos 8 caracteres, uma letra maiúscula, um caractere especial
                    if (!senhaRegex.test(senha)) {
                        alert("A senha deve ter pelo menos 8 caracteres, incluir pelo menos uma letra maiúscula e um caractere especial.");
                        return false;
                    }

                    // Envia o formulário manualmente após a validação
                    document.getElementById('formRegistro').submit();
                }
            </script>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->
<!-- ######################################################## --> 
    <!-- SWEETALERT 2 -->   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

                function validarFormulario() {
                    const nome = document.querySelector('input[name="nome"]').value.trim();
                    const email = document.querySelector('input[name="email"]').value.trim();
                    const sexo = document.querySelector('select[name="sexo"]').value;
                    const senha = document.querySelector('input[name="senha"]').value.trim();

                    if (!nome || !email || !sexo || !senha) {
                        alert("Todos os campos devem ser preenchidos.");
                        return false;
                    }

                    // Validação do e-mail
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expressão regular básica para e-mail
                    if (!emailRegex.test(email)) {
                        alert("Por favor, insira um endereço de e-mail válido.");
                        return false;
                    }

                    // Expressão regular para validar a senha
                    const senhaRegex = /^(?=.*[A-Z])(?=.*[\W_])(?=.{8,})/; // Pelo menos 8 caracteres, uma letra maiúscula, um caractere especial
                    if (!senhaRegex.test(senha)) {
                        alert("A senha deve ter pelo menos 8 caracteres, incluir pelo menos uma letra maiúscula e um caractere especial.");
                        return false;
                    }
                    return true;
                }


      function confirmAndSubmit(event) {
          // Chama a validação do formulário
        const isValid = validarFormulario();

        // Se a validação falhar, interrompe a execução
        if (!isValid) {
            return;
        }

        event.preventDefault(); // Impede o envio padrão do formulário
        Swal.fire({
          title: 'Formulário de usuários',
          text: "Têm certeza que deseja cadastrar o usuário?",
          showDenyButton: true,
          confirmButtonText: 'SIM',
          denyButtonText: `CANCELAR`,
          confirmButtonColor: "#4289a6",
          denyButtonColor: "#ff8a33",
          width: '600px', // Largura do alerta
          icon: 'warning',
          customClass: {
            title: 'swal-title', // Classe para o título
            content: 'swal-content', // Classe para o conteúdo (texto)
            confirmButton: 'swal-confirm-btn',
            denyButton: 'swal-deny-btn',
            htmlContainer: 'swal-text'
          }
        }).then((result) => {
          if (result.isConfirmed) {
            // Capturar os dados do formulário
            var formData = new FormData($("#form-empresa")[0]); // Usa o FormData para enviar arquivos
            // Fazer a requisição AJAX
            $.ajax({
              url: "register_proc.php", // URL para processamento
              type: "POST",
              data: formData,
              processData: false, // Impede o jQuery de processar os dados
              contentType: false, // Impede o jQuery de definir o tipo de conteúdo
              success: function (response) {
                Swal.fire({
              title: 'Salvo!',
              text: `${response}`,
              icon: 'success',
              width: '600px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              customClass: {
                title: 'swal-title', // Aplicando a mesma classe do título
                content: 'swal-content', // Aplicando a mesma classe do texto
                htmlContainer: 'swal-text',
                confirmButton: 'swal-confirm-btn'
              }
            }).then(() => {
                  // Redirecionar ou atualizar a página, se necessário
                  location.reload();
                });
              },
              error: function (xhr, status, error) {
                Swal.fire({
              title: 'Erro!',
              text: 'Erro ao atualizar o Cliente.',
              icon: 'error',
              width: '600px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              customClass: {
                title: 'swal-title', // Aplicando a mesma classe do título
                content: 'swal-content', // Aplicando a mesma classe do texto
                htmlContainer: 'swal-text',
                confirmButton: 'swal-confirm-btn'
              }
            });
              },
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelado', 'Nenhuma alteração foi salva.', 'info');
          }
        });
      }
      // Associar a função ao botão de submit
      $(document).ready(function () {
        $("#salvar_empresa_1").on("click", confirmAndSubmit);
      });
</script> 
<style>
  /* Estilos para aumentar o tamanho da fonte */
  .swal-title {
    font-size: 36px !important; /* Tamanho maior para o título */
  }

  .swal-text {
    font-size: 24px !important; /* Tamanho maior para o conteúdo */
  }

  /* Aumentar o tamanho dos textos dos botões */
  .swal-confirm-btn,
  .swal-deny-btn,
  .swal-cancel-btn {
    font-size: 20px !important; /* Tamanho maior para os textos dos botões */
    padding: 12px 12px !important; /* Aumenta o espaço ao redor do texto */
  }
</style>
<!-- ######################################################## --> 
<!-- SWEETALERT 2 -->   

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
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
