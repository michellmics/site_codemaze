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

if(isset($_GET['update']))
{
  if($_GET['dataPagamento'] == "")
  {
    $_GET['dataPagamento'] = "00/00/0000";
  }

  $dataPagamento = DateTime::createFromFormat('d/m/Y', $_GET['dataPagamento']);
  $dataFormatada = $dataPagamento->format('Y-m-d');
  $result = $siteAdmin->updateLiquidacaoFinanceiraById($_GET['update'],$_GET['acao'],$dataFormatada); 

}

if(isset($_GET['table_search'])) //trazer os dados de acordo com o q foi colocado na busca
{
  $search = $_GET['table_search'];
  $result = $siteAdmin->getLiquidacaoFinanceiraInfoBySearch($search);
  
}
else
  {
    $siteAdmin->getLiquidacaoFinanceiraInfo();
  }


// Configurações de Paginação
$registrosPorPagina = 50;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);

// Determina o índice de início para a página atual
$inicio = ($paginaAtual - 1) * $registrosPorPagina;

// Divide o array para exibir apenas os registros da página atual
$dadosPagina = array_slice($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA, $inicio, $registrosPorPagina);

//-----------------

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
  
  
<!-- ######################################################## --> 
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->  
  <body class="skin-blue">
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
                  <h3 class="box-title">Contas a Receber</h3>
                  <div class="box-tools" style="margin-bottom: 20px;">
                    
                  <div class="input-group" style="display: flex; align-items: center; gap: 10px;">


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
                      <th>CONTRATO</th>
                      <th><center>IOP</center></th>
                      <th></th>
                      <th><center>CLIENTE</center></th>
                      <th><center>PRODUTO</center></th>
                      <th><center>PARCELA</center></th>
                      <th><center>VALOR</center></th>
                      <th><center>JUROS</center></th>
                      <th><center>VENCIMENTO</center></th>
                      <th><center>BOLETO</center></th>
                      <th><center>PAGAMENTO</center></th>
                      <th></th>                    
                    </tr>
                    <tr>
                    <?php foreach ($dadosPagina as $liquidFin): ?>
                    <tr>
                        <? 
                          $now = new DateTime(); 
                          $vencimento = new DateTime($liquidFin['LFI_DTVENCIMENTO']); 
                          
                          // Calcula a diferença em dias
                          $diferenca = (int)$now->diff($vencimento)->format('%r%a');

                          if ($diferenca < -5 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO"){$msg = "VENCIDO";$classIcon = "label label-danger";}  
                          if ($diferenca > 0 && $diferenca <= 10 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO"){$msg = "A VENCER";$classIcon = "label label-warning";}  
                          if ($diferenca > 10 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO"){$msg = "EM ABERTO";$classIcon = "label label-primary";}  
                          if ($liquidFin['LFI_STPAGAMENTO'] == "LIQUIDADO"){$msg = "LIQUIDADO";$classIcon = "label label-success";}   

                          $dataFormatada = date("d/m/Y", strtotime($liquidFin['LFI_DTVENCIMENTO']));                     

                          $liquidFin['LFI_DCVALOR_PARCELA_JUROS'] = $liquidFin['LFI_DCVALOR_PARCELA_JUROS'] == NULL ? '0.00' : $liquidFin['LFI_DCVALOR_PARCELA_JUROS'];
                          
                          $inputLiquidarStatus = $liquidFin['LFI_DTPAGAMENTO'] != NULL && $liquidFin['LFI_DTPAGAMENTO'] != '0000-00-00' ? 'display: none;' : '';
                          $inputDeixarAbertoStatus = $liquidFin['LFI_DTPAGAMENTO'] == NULL || $liquidFin['LFI_DTPAGAMENTO'] == '0000-00-00' ? 'display: none;' : '';
                          
                          $idOrdemPagamento = htmlspecialchars($liquidFin['LFI_IDOP']);
                          $linkBoleto = $liquidFin['LFI_PAGSEGURO_LINK_BOLETO'];
                          $boleto = $liquidFin['LFI_PAGSEGURO_LINK_BOLETO'] == NULL ? "<a href='https://www.codemaze.com.br/site/admin/boleto_proc.php?LFI_IDOP=$idOrdemPagamento' target='_self'>Gerar Boleto</a>" : "<a href='$linkBoleto' target='_blank'><i class='fas fa-file-pdf'></i></a>";

                          if($liquidFin['LFI_DTPAGAMENTO'] != "" && $liquidFin['LFI_DTPAGAMENTO'] != "0000-00-00")
                          {
                            $liquidFin['LFI_DTPAGAMENTO'] = date("d/m/Y", strtotime($liquidFin['LFI_DTPAGAMENTO']));
                          }


                        ?> 
                        <td style="text-transform: uppercase; font-size: 14px; color: red !important; vertical-align: middle;"><b><a href="https://www.codemaze.com.br/site/admin/form_contrato_edit.php?id=<? echo $liquidFin['GEC_IDGESTAO_CONTRATO']; ?>" target="_self"><?= htmlspecialchars($liquidFin['GEC_IDGESTAO_CONTRATO']) ?></a></b></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><?= htmlspecialchars($liquidFin['LFI_IDOP']) ?></td>
                        <td style="text-transform: uppercase; font-size: 15px; vertical-align: middle;"><a href="#"><span class="<? echo $classIcon; ?>"><? echo $msg; ?></span></a></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><?= htmlspecialchars($liquidFin['CLI_NMNAME']) ?></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center><?= htmlspecialchars($liquidFin['PRS_NMNOME']) ?></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center><?= htmlspecialchars($liquidFin['LFI_DCNUMPARCELA']) ?></center></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center>R$<?= htmlspecialchars($liquidFin['LFI_DCVALOR_PARCELA']) ?></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center>R$<?= htmlspecialchars($liquidFin['LFI_DCVALOR_PARCELA_JUROS']) ?></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center><?= $dataFormatada ?></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center><? echo $boleto; ?></center></td>
                        <td style="text-transform: uppercase; font-size: 12px; vertical-align: middle;"><center><?= $liquidFin['LFI_DTPAGAMENTO'] ?></center></td> 
                        <td>
			                  <input  type="text" style="width: 52%; text-transform: uppercase; vertical-align: middle; font-size: 12px;" minlength="15" maxlength="15" class="form-control" placeholder="DD/MM/AAAA" id="pagamento_<?php echo $liquidFin['LFI_IDLIQUIDACAOFINANCEIRA']; ?>" name="pagamento" />
                        </td>                   
                        <td style="text-transform: uppercase; font-size: 15px; <? echo  $inputLiquidarStatus ?>">
                            <a href="#" 
                               id="liquidarLink_<?php echo $liquidFin['LFI_IDLIQUIDACAOFINANCEIRA']; ?>" 
                               onclick="return confirmarLiquidacao(<?php echo $liquidFin['LFI_IDLIQUIDACAOFINANCEIRA']; ?>);">
                               <span class="label label-info">LIQUIDAR</span>
                            </a>
                        </td>
                        <td style="text-transform: uppercase; font-size: 15px; vertical-align: middle; <? echo  $inputDeixarAbertoStatus ?>"><a href="https://www.codemaze.com.br/site/admin/table_liquidacaoFinanceira.php?update=<? echo $liquidFin['LFI_IDLIQUIDACAOFINANCEIRA']; ?>&acao=ABERTO" target="_self" onclick="return confirmacao();"><span class="label label-default">DEIXAR ABERTO</span></a></td>           
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
<!-- Main MENU content  INI --> 
<!-- ######################################################## -->

    <!-- jQuery 2.1.3 -->
    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>

    <script>
      function confirmacao() 
      {
        return confirm("Tem certeza que deseja mudar o status do pagamento");
      }

      function confirmarLiquidacao(id) {
      const datapagamentoInput = document.getElementById(`pagamento_${id}`);
      const datapagamento = datapagamentoInput ? datapagamentoInput.value.trim() : '';

      if (!datapagamento) {
          alert("Por favor, insira a data de pagamento.");
          return false;
      }

      if (confirm("Tem certeza que deseja liquidar o pagamento?")) {
          const url = `https://www.codemaze.com.br/site/admin/table_liquidacaoFinanceira.php?update=${id}&acao=LIQUIDADO&dataPagamento=${encodeURIComponent(datapagamento)}`;

          // Redireciona para a URL gerada
          window.location.href = url;

          return true; // Pode ser omitido aqui, já que estamos redirecionando
      }

      return false; // Retorna false se o usuário cancelar
    }


    </script>              
    


  </body>
</html>
