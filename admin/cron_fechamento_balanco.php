<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$dashboardValues = new SITE_ADMIN();
$countReceitaMesCorrente = $dashboardValues->countReceitaMesCorrente();
$despesas = 125; //provisorio
$liquidoMêsCorrente = $countReceitaMesCorrente["0"]["TOTAL"] - $despesas;


$dashboardValues->insertBalancoMes($countReceitaMesCorrente, $despesas, $liquidoMêsCorrente);

var_dump($countReceitaMesCorrente);

echo "Fim do Script";
?>