<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administração - Site <?php echo htmlspecialchars($siteAdmin->ARRAY_SITEINFO["SBI_DCDOMAINSITE"]); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
</head>
<body class="register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="../images/logos/logocodemaze_preto.png"></img>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Cadastro de novo usuário(a)</p>
            <form action="register_proc.php" method="post" id="formRegistro">
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
                    <input type="password" name="senha" class="form-control" placeholder="Digite a senha" maxlength="20" required/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck"></div>                        
                    </div>
                    <div class="col-xs-4">
                        <button type="button" onclick="validarFormulario()" class="btn btn-primary btn-block btn-flat">Registrar</button>
                    </div>
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

                    // Expressão regular para validar a senha
                    const senhaRegex = /^(?=.*[A-Z])(?=.*[\W_])(?=.{8,})/;

                    if (!senhaRegex.test(senha)) {
                        alert("A senha deve ter pelo menos 8 caracteres, incluir pelo menos uma letra maiúscula e um caractere especial.");
                        return false;
                    }

                    // Envia o formulário manualmente após a validação
                    document.getElementById('formRegistro').submit();
                }
            </script>
        </div>
    </div>

    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
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
