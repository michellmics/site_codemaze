<?php
include_once 'objetos.php'; 

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$siteAdmin = new SITE_ADMIN();

if (isset($_GET['update'])) {
    $siteAdmin->updateLiquidacaoFinanceiraById(
        $_GET['update'], $_GET['acao'], $_GET['dataPagamento']
    );
}

if (isset($_GET['table_search'])) {
    $search = $_GET['table_search'];
    $result = $siteAdmin->getLiquidacaoFinanceiraInfoBySearch($search);
    var_dump($result);
} else {
    $siteAdmin->getLiquidacaoFinanceiraInfo();
}

// Configurações de Paginação
$registrosPorPagina = 10;
$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$totalRegistros = count($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
$inicio = ($paginaAtual - 1) * $registrosPorPagina;
$dadosPagina = array_slice($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA, $inicio, $registrosPorPagina);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Liquidação Financeira</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" />
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" />
</head>

<body class="skin-blue">
    <div class="content-wrapper" style="margin-left: 0; background-color: white;">
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Liquidação Financeira</h3>
                        </div>
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tr>
                                    <th>CONTRATO</th>
                                    <th>STATUS</th>
                                    <th>CLIENTE</th>
                                    <th>PRODUTO</th>
                                    <th>PARCELA</th>
                                    <th>VALOR</th>
                                    <th>VENCIMENTO</th>
                                    <th>PAGAMENTO</th>
                                    <th>NOVA DATA</th>
                                    <th>AÇÕES</th>
                                </tr>
                                <?php foreach ($dadosPagina as $liquidFin): ?>
                                <tr>
                                    <td><?= htmlspecialchars($liquidFin['GEC_IDGESTAO_CONTRATO']) ?></td>
                                    <td>
                                        <?php
                                            $now = new DateTime();
                                            $vencimento = new DateTime($liquidFin['LFI_DTVENCIMENTO']);
                                            $diferenca = (int)$now->diff($vencimento)->format('%r%a');

                                            if ($diferenca < -5 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO") {
                                                $msg = "VENCIDO";
                                                $classIcon = "label label-danger";
                                            } elseif ($diferenca > 0 && $diferenca < 5 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO") {
                                                $msg = "A VENCER";
                                                $classIcon = "label label-warning";
                                            } elseif ($diferenca > 10 && $liquidFin['LFI_STPAGAMENTO'] != "LIQUIDADO") {
                                                $msg = "EM ABERTO";
                                                $classIcon = "label label-primary";
                                            } else {
                                                $msg = "LIQUIDADO";
                                                $classIcon = "label label-success";
                                            }
                                        ?>
                                        <span class="<?= $classIcon ?>"><?= $msg ?></span>
                                    </td>
                                    <td><?= htmlspecialchars($liquidFin['CLI_NMNAME']) ?></td>
                                    <td><?= htmlspecialchars($liquidFin['PRS_NMNOME']) ?></td>
                                    <td><?= htmlspecialchars($liquidFin['LFI_DCNUMPARCELA']) ?></td>
                                    <td><?= htmlspecialchars($liquidFin['LFI_DCVALOR_PARCELA']) ?></td>
                                    <td><?= htmlspecialchars($liquidFin['LFI_DTVENCIMENTO']) ?></td>
                                    <td><?= htmlspecialchars($liquidFin['LFI_DTPAGAMENTO']) ?></td>
                                    <td>
                                        <input type="text" id="datapagamento" class="form-control" placeholder="DD/MM/YYYY" />
                                    </td>
                                    <td>
                                        <a href="#" onclick="return confirmarLiquidacao(<?= $liquidFin['LFI_IDLIQUIDACAOFINANCEIRA'] ?>);">
                                            <span class="label label-info">LIQUIDAR</span>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation" class="text-center">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                    <li class="<?= ($i == $paginaAtual) ? 'active' : '' ?>">
                        <a href="?pagina=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </section>
    </div>

    <script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        function confirmarLiquidacao(id) {
            const dataPagamento = document.getElementById('datapagamento').value;
            if (!dataPagamento) {
                alert("Por favor, insira a data de pagamento.");
                return false;
            }

            if (confirm("Tem certeza que deseja liquidar o pagamento?")) {
                const url = `https://www.codemaze.com.br/site/admin/table_liquidacaoFinanceira.php?update=${id}&acao=LIQUIDADO&dataPagamento=${encodeURIComponent(dataPagamento)}`;
                window.location.href = url;
                return true;
            }
            return false;
        }
    </script>
</body>
</html>
