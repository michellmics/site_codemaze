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
        $siteAdmin->updateLiquidacaoFinanceiraById($array["LFI_IDLIQUIDACAOFINANCEIRA"],"LIQUIDADO",$DATA);
        $qtdeBoletosPagos++;
    }
}

if($qtdeBoletosPagos > 0)
{
    $contato = "Codemaze";
    $email= "suporte@codemaze.com.br";  
    $subject = "Pagamento com boleto detectado.";
    $msg = "
            Olá <b>$contato</b>, bom dia! <br><br>
            Foram identificamos $qtdeBoletosPagos pagamentos utilizando boletos. <br><br>
    
            Atenciosamente,<br><b
            <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <b
            Codemaze - Soluções de MKT e Software<br><br>
            faleconosco@codemaze.com.br<br>
            suporte@codemaze.com.br<br>
            <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>";
            
    
    $siteAdmin->notifyPendenciasEmail($subject, $msg, $email); 
    
    echo "Foi detectado que $qtdeBoletosPagos boletos foram pagos neste momento.<br>";
}
echo "Fim do Script";


?>