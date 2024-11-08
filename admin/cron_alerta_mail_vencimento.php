<?php

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getLiquidacaoFinanceiraInfo();

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

        if ($diferenca < 0 && $array['LFI_STPAGAMENTO'] != "LIQUIDADO")
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
            $siteAdmin->InsertAlarme("Identificado fatura vencida do cliente $contato.","Info");
            $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Vencido");
            $siteAdmin->notifyPendenciasEmail($subject, $msg, $emalCobrança); 
            
        }

    }
}
echo "Quantidade de cobranças enviadas: $qtdeCobrancas <br><br>";
echo "Fim do Script";

?>
