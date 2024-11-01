<?php
//informa erros na tela
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//informa erros na tela

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getProxContratosAVencer();

//gerar os boletos
foreach($siteAdmin->ARRAY_PROXVENCIMENTOS as $item)
{ 
    if($item["LFI_PAGSEGURO_LINK_BOLETO"] == NULL && ($item["LFI_STPAGAMENTO"] == "ABERTO" || $item["LFI_STPAGAMENTO"] == NULL))
    {
        $result = $siteAdmin->gerBoleto($item["LFI_IDOP"]);
        echo $result;
    }        
}


$boletosPorCliente = [];

foreach ($siteAdmin->ARRAY_PROXVENCIMENTOS as $item) {
    $clienteId = $item['CLI_IDCLIENT'];

    // Inicializa um array para o cliente se ele não existir ainda
    if (!isset($boletosPorCliente[$clienteId])) {
        $boletosPorCliente[$clienteId] = [];
    }

    // Adiciona o boleto ao array do cliente
    $boletosPorCliente[$clienteId][] = $item;
}



/*

// Exemplo de uso: percorrendo cada cliente para enviar os boletos por e-mail
foreach ($boletosPorCliente as $clienteId => $boletos) {
    // Aqui você pode gerar a mensagem para o cliente e enviar o e-mail
    echo "Enviando e-mail para o cliente ID: $clienteId\n";
    
    foreach ($boletos as $boleto) {
        echo "Boleto para o cliente $clienteId - Link: " . $boleto['LFI_PAGSEGURO_LINK_BOLETO'] . "\n";
        // Aqui você pode implementar a lógica de envio do e-mail com o link do boleto
    }
}
*/
 

echo "<pre>";
var_dump($boletosPorCliente);
echo "</pre>";








//$resultMail = $siteAdmin->sendEmailPHPMailer("michell.oliveira@codemaze.com.br","teste de envio anexo", "testooouuu","https://boleto.pagseguro.com.br/44040181-84cd-4c6f-935f-b5f5be9c88c3.pdf"); 
//echo $resultMail;


die();

/*
echo "<pre>";
var_dump($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA);
echo "</pre>";
*/

$qtdeCobrancas = 0;

foreach($siteAdmin->ARRAY_LIQUIDACAOFINANCEIRA as $array)
{
    $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Liquidado");

    if($array["LFI_STPAGAMENTO"] != "LIQUIDADO")
    {
        $contrato = $array['GEC_IDGESTAO_CONTRATO'];
        $valor = $array['LFI_DCVALOR_PARCELA']; 
        $parcela = $array['LFI_DCNUMPARCELA'];
        $produto = strtoupper($array['PRS_NMNOME']);

        $contato = strtoupper($array['CLI_NMNAME']);
        $emalCobrança = $array['GEC_DCEMAILCOBRANCA'];  

        $now = new DateTime(); 
        $vencimento = new DateTime($array['LFI_DTVENCIMENTO']); 
        
        // Calcula a diferença em dias
        $diferenca = (int)$now->diff($vencimento)->format('%r%a');

        if ($diferenca < -5 && $array['LFI_STPAGAMENTO'] != "LIQUIDADO")
        {
            $qtdeCobrancas++;

            $subject = "Pendência de Pagamento";
            $msg = "
                    Olá <b>$contato</b>, bom dia! <br><br>
                    Identificamos uma pendência de pagamento em nosso sistema referente a parcela <b>nº $parcela</b> do contrato nº <b>$contrato</b> no valor de <b>R$$valor</b>. <br>
                    <b>Produto contratado:</b> $produto<br><br>
                    Pedimos que entre em contato conosco o quanto antes para regularizar a situação e evitar a suspensão de seus serviços.<br><br>

                    Estamos à disposição para ajudá-lo(a)!<br>
                    Atenciosamente,<br><br>

                    <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

                    Codemaze - Soluções de MKT e Software<br><br>
                    faleconosco@codemaze.com.br<br>
                    suporte@codemaze.com.br<br>
                    <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>
                    ";

            $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Vencido");
            $siteAdmin->notifyPendenciasEmail($subject, $msg, $emalCobrança); 
            
        }

    }
}
echo "Quantidade de cobranças enviadas: $qtdeCobrancas <br><br>";
echo "Fim do Script";

?>