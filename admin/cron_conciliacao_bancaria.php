<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getLiquidacaoFinanceiraConciliacaoBancaria();

$now = new DateTime(); 
$DATA = $now->format('Y-m-d');

$qtdeBoletosPagos = 0;

foreach($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA as $array)
{
    $response=$siteAdmin->checkPagamentoBoleto($array["LFI_PAGSEGURO_IDPEDIDO_BOLETO"]);
    $data = json_decode($response, true);

    if(isset($data['charges'][0]['status']) && $data['charges'][0]['status'] == "PAID")
    {
        $siteAdmin->InsertAlarme("Identificado o pagamento de um boleto.","Info");
        $siteAdmin->updateLiquidacaoFinanceiraById($array["LFI_IDLIQUIDACAOFINANCEIRA"],"LIQUIDADO",$DATA);
        $qtdeBoletosPagos++;
    }
}

echo "Fim do Script";


?>