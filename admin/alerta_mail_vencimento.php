<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getLiquidacaoFinanceiraInfo();

/*
echo "<pre>";
var_dump($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA);
echo "</pre>";
*/

foreach($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA as $array)
{
    echo $arra["LFI_STPAGAMENTO"];
}

?>