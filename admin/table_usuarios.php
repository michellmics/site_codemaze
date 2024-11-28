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

if(isset($_GET['table_search'])) //trazer os dados de acordo com o q foi colocado na busca
{
  $search = $_GET['table_search'];
  $siteAdmin->getProductInfoBySearch($search);
}
else
    {
      $siteAdmin->getUserInfoList();
    }


// Configurações de Paginação
$registrosPorPagina = 20;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_USERINFOLIST);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_USERINFOLIST, $inicio, $registrosPorPagina);

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

    <!-- ######################################################## --> 
    <!-- SWEETALERT 2 --> 
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <!-- ######################################################## --> 

  </head>
  
  
<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->  
  <body class="register-page" style="margin-center: 0px; ">
    <div class="wrapper" style="margin-center: 0px; ">
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="col-md-10" style="margin-center: 0px; ">
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
                  <h3 class="box-title">Lista de usuários</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">                  
                       <!-- Botão "Adicionar Produto" -->
                      <button class="btn btn-block btn-info btn-sm" onclick="window.location.href='register.php';">
                        CADASTRAR USUÁRIO
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
                      <th></th>
                      <th>ID</th>
                      <th>NOME</th>
                      <th>E-MAIL</th>
                      <th>SEXO</th>
                      <th>NÍVEL DE ACESSO</th>                  
                    </tr>
                    <tr>
                      <?php foreach ($dadosPagina as $admusers): ?>
                        <tr> 
                        <?php if($admusers['USA_DCNIVELDEACESSO'] == "ADMINISTRADOR"){ $spam='class="badge bg-black"';} ?>
                        <?php if($admusers['USA_DCNIVELDEACESSO'] == "FINANCEIRO"){ $spam='class="badge bg-blue"';} ?>
                        <?php if($admusers['USA_DCNIVELDEACESSO'] == "OPERADOR"){ $spam='class="badge bg-blue"';} ?>
                        <?php if($admusers['USA_DCNIVELDEACESSO'] == "RECEPCAO"){ $spam='class="badge bg-blue"';} ?>
                        <?php if($admusers['USA_DCNIVELDEACESSO'] == "SUPORTE TECNICO"){ $spam='class="badge bg-blue"';} ?>
                        <td style="text-transform: uppercase; font-size: 12px;"><img src=<?php echo $admusers['USA_DCFOTO'] ?> class="user-image" alt="User Image"/></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($admusers['USA_IDUSERADMIN']) ?></td> 
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($admusers['USA_DCNOME']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($admusers['USA_DCEMAIL']) ?></td>                       
                        <td style="text-transform: uppercase; font-size: 12px;"><?= htmlspecialchars($admusers['USA_DCSEXO']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px;"><span <? echo $spam; ?>><?= htmlspecialchars($admusers['USA_DCNIVELDEACESSO']) ?></span></td>                     
                        <td style="text-transform: uppercase; font-size: 15px;"><a href="https://www.codemaze.com.br/site/admin/register_edit.php?id=<? echo $admusers['USA_IDUSERADMIN']; ?>" target="_self"><span class="label label-warning">EDITAR</span></a></td>  
                        <td style="text-transform: uppercase; font-size: 15px;"><a href="javascript:void(0);" onclick="confirmDelete(<?= $admusers['USA_IDUSERADMIN']; ?>)"><span class="label label-danger">DELETAR</span></a></td>                   
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

<!-- ######################################################## --> 
    <!-- SWEETALERT 2 -->   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      function confirmDelete(userId){
        event.preventDefault(); // Impede o envio padrão do formulário
        Swal.fire({
          title: 'Formulário de usuários',
          text: "Têm certeza que deseja excluir o usuário?",
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
            var formData = $("#form-empresa").serialize();
            // Fazer a requisição AJAX
            $.ajax({
              url: "register_delete.php", // URL para processamento
              type: "POST",
              data: { id: userId }, // Dados enviados
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
