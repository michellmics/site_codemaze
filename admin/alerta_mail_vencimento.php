<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getLiquidacaoFinanceiraInfo();


var_dump($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA);

?>