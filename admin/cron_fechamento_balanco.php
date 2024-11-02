<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$dashboardValues = new SITE_ADMIN();
$countReceitaMesCorrente = $dashboardValues->countReceitaMesCorrente();
$despesas = 125; //provisorio
$liquidoMêsCorrente = $countReceitaMesCorrente["0"]["TOTAL"] - $despesas;


$dashboardValues->insertBalancoMes($countReceitaMesCorrente["0"]["TOTAL"], $despesas, $liquidoMêsCorrente);


$emalCobrança = "suporte@codemaze.com.br"; 

$subject = "FECHAMENTO FINANCEIRO MENSAL";
$msg = "
        Olá <b>Admins</b>, bom dia! <br><br>
        O sistema Intranet Codemaze acaba de fazer o fechamento financeiro mensal. <br><br>
        
        Atenciosamente,<br><br>

        Sistema Intranet Codemaze <br><br>
        <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

        Codemaze - Soluções de MKT e Software<br><br>
        faleconosco@codemaze.com.br<br>
        suporte@codemaze.com.br<br>
        <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>
        ";


$dashboardValues->notifyPendenciasEmail($subject, $msg, $emalCobrança); 
$dashboardValues->InsertAlarme("Ocorreu o fechamento do balanço do mês.","Info");


echo "Fim do Script";
?>