<?php
  include_once 'objetos.php'; 

  session_start(); 
  define('SESSION_TIMEOUT', 18000); 
 
  if (!isset($_SESSION['user_id'])) 
  {
    header("Location: index.php");
    exit();
  }

$userId = $_SESSION['user_id'];

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getUserInfo($userId);



if($_SESSION['user_nivelacesso'] != "ADMINISTRADOR")
{
  $siteAdmin->getProspecInfoByUserId($userId);
}
else
{
  $siteAdmin->getProspecInfo();
}

if(count($siteAdmin->ARRAY_PROSPEC_CLIENTESINFO) > 0)
{
  // Configurações de Paginação
  $registrosPorPagina = 30;
  $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
  $totalRegistros = count($siteAdmin->ARRAY_PROSPEC_CLIENTESINFO);
  $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

  // Determina o índice de início para a página atual
  $inicio = ($paginaAtual - 1) * $registrosPorPagina;

  // Divide o array para exibir apenas os registros da página atual
  $dadosPagina = array_slice($siteAdmin->ARRAY_PROSPEC_CLIENTESINFO, $inicio, $registrosPorPagina);
}
else
  {
    $dadosPagina = "Não há clientes a serem prospectados para este usuário.";
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
    <link rel="icon" href="https://www.codemaze.com.br/site/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="https://www.codemaze.com.br/site/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="https://www.codemaze.com.br/site/logo_small_site.png">
    <meta name="apple-mobile-web-app-title" content="Codemaze">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">

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
  <body class="skin-blue">
          <!-- Logo centralizado -->
  <div style="text-align: center; margin-top: 20px;">
    <a href="#">
      <img src="https://codemaze.com.br/site/images/logos/logocodemaze_preto.png" alt="Codemaze Logo" style="max-width: 150px;">
    </a>
  </div>
    <div class="wrapper">
      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper" style="margin-left: 0px; background-color: white;">
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
                  <h3 class="box-title"><b>Lista de Prospecção</b> :  <? echo $siteAdmin->ARRAY_USERINFO["USA_DCNOME"]; ?></h3>
                  
                  


                  </div>
                </div><!-- /.box-header -->
                <div class="box-tools" style="margin-bottom: 20px;">
                  
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">
                   <!-- Botão "Adicionar Produto" -->
                   <button class="btn btn-block btn-info btn-sm" onclick="window.location.href='form_prospec.php';">ADICIONAR PROSPECÇÃO</button>

                  </div>
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th></th> 
                      <th>NOME</th>
                      <th>ENDEREÇO</th>                  
                    </tr>
                    <tr>
                    <? 
                      if(count($siteAdmin->ARRAY_PROSPEC_CLIENTESINFO) == 0)
                      {
                        echo "<br><br><center>$dadosPagina</center><br><br>";
                        exit(); 
                      }               
                    ?>
                    <?php foreach ($dadosPagina as $client): ?>
                      <?php 
                        if($client['PRC_STSTATUS'] == 'Não recebeu visita.')
                        {
                          $classLabel = 'class="label label-danger"';
                          $statusVisita = "N";
                        }
                        else
                            {
                              $classLabel = 'class="label label-success"';
                              $statusVisita = "S";
                            }    
                            
                        if($client['PRC_DCMAPS_END'] != '')
                        {
                          $classLabelMaps = 'class="label label-success"';
                          $statusVisitaMaps = "MAPS";
                          $linkMaps = $client['PRC_DCMAPS_END'];
                        }
                        else
                            {
                              $classLabelMaps = 'class="label label-danger"';
                              $statusVisitaMaps = "";
                              $linkMaps = "#";
                            } 
                  
                      ?>
                      <tr style="cursor: pointer;" onclick="window.location.href='https://www.codemaze.com.br/site/admin/form_prospec_edit.php?id=<?= $client['PRC_IDPROSPEC_CLIENTES'] ?>';">
                        <td style="text-transform: uppercase; font-size: 15px;">
                            <span  <? echo $classLabel; ?>>
                            <? echo $statusVisita; ?>
                            </span>
                        </td> 
                        <td style="text-transform: uppercase; font-size: 10px; vertical-align: middle;"> <?= htmlspecialchars(strlen($client['PRC_NMNOME']) > 20 ? substr($client['PRC_NMNOME'], 0, 20) . '...' : $client['PRC_NMNOME']) ?></td>
                        
                        <td style="text-transform: uppercase; font-size: 10px; vertical-align: middle;"><?= htmlspecialchars(strlen($client['PRC_DCENDERECO']) > 25 ? substr($client['PRC_DCENDERECO'], 0, 25) . '...' : $client['PRC_DCENDERECO']) ?></td>  
                        <td style="text-transform: uppercase; font-size: 15px; vertical-align: middle;"><a href="<?php echo $linkMaps; ?>" target="_blank"><span <? echo $classLabel; ?>><i class="fa fa-location-arrow"></i></span></a></td>                  
                        <td style="text-transform: uppercase; font-size: 15px; vertical-align: middle;"><a href="javascript:void(0);" onclick="confirmDelete(<?= $client['PRC_IDPROSPEC_CLIENTES']; ?>)"><span class="label label-danger"><i class="fa fa-trash"></i></span></a></td>         
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

<script>
  // Função para redirecionar ao link quando o checkbox for selecionado
  function redirectToLink(button) {
    const value = button.value;
    window.location.href = `https://www.codemaze.com.br/site/admin/table_prospec.php?statusBusca=${value}`;
  }
</script>

<!-- ######################################################## --> 
    <!-- SWEETALERT 2 -->   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
      function confirmDelete(userId){
        event.preventDefault(); // Impede o envio padrão do formulário
        Swal.fire({
          title: 'Formulário de Clientes',
          text: "Têm certeza que deseja excluir a prospecção?",
          showDenyButton: true,
          confirmButtonText: 'SIM',
          denyButtonText: `CANCELAR`,
          confirmButtonColor: "#4289a6",
          denyButtonColor: "#ff8a33",
          width: '600px', // Largura do alerta
          icon: 'warning',
          position: 'top', // Define a posição na parte superior da tela
          customClass: {
            title: 'swal-title', // Classe para o título
            content: 'swal-content', // Classe para o conteúdo (texto)
            confirmButton: 'swal-confirm-btn',
            denyButton: 'swal-deny-btn',
            htmlContainer: 'swal-text',
            popup: 'swal-custom-popup', // Classe para customizar o popup
          }
        }).then((result) => {
          if (result.isConfirmed) {
            // Capturar os dados do formulário
            var formData = $("#form-empresa").serialize();
            // Fazer a requisição AJAX
            $.ajax({
              url: "prospec_delete.php", // URL para processamento
              type: "POST",
              data: { id: userId }, // Dados enviados
              success: function (response) {
                Swal.fire({
              title: 'Salvo!',
              text: `${response}`,
              icon: 'success',
              width: '200px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              position: 'top', // Define a posição na parte superior da tela
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
              width: '200px', // Largura do alerta
              confirmButtonColor: "#4289a6",
              position: 'top', // Define a posição na parte superior da tela
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
    font-size: 22px !important; /* Tamanho maior para o título */
  }

  .swal-text {
    font-size: 16px !important; /* Tamanho maior para o conteúdo */
  }

  @media screen and (max-width: 768px) {
  .swal-custom-popup {
    top: 10% !important; /* Ajuste de posição vertical */
    transform: translateY(0) !important; /* Centraliza no topo */
  }
}

  /* Aumentar o tamanho dos textos dos botões */
  .swal-confirm-btn,
  .swal-deny-btn,
  .swal-cancel-btn {
    font-size: 14px !important; /* Tamanho maior para os textos dos botões */
    padding: 9px 9px !important; /* Aumenta o espaço ao redor do texto */
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
