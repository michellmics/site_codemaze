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
    $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Liquidado");

    if($array["LFI_STPAGAMENTO"] != "LIQUIDADO")
    {
        $now = new DateTime(); 
        $vencimento = new DateTime($array['LFI_DTVENCIMENTO']); 
        
        // Calcula a diferença em dias
        $diferenca = (int)$now->diff($vencimento)->format('%r%a');

        if ($diferenca < -5 && $array['LFI_STPAGAMENTO'] != "LIQUIDADO")
        {
            $contato = $array['CLI_NMNAME'];
            $emalCobrança = $array['GEC_DCEMAILCOBRANCA']; 

            $subject = "Pendência de Pagamento";
            $msg = "
                    Olá <b>$contato</b>, bom dia! <br><br>
                    Identificamos pendência(s) de pagamento em nosso sistema relacionadas à sua conta. <br>
                    Pedimos que entre em contato conosco o quanto antes para regularizar a situação e evitar a suspensão de seus serviços.<br><br>

                    Estamos à disposição para ajudá-lo(a)!<br>
                    Atenciosamente,<br><br>

                    <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

                    Codemaze - Soluções de MKT e Software<br><br>
                    vanessa.kuasne@codemaze.com.br<br>
                    faleconosco@codemaze.com.br<br>
                    suporte@codemaze.com.br<br>
                    <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>
                    ";

            $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Vencido");
            $siteAdmin->notifyPendenciasEmail($subject, $msg, $emalCobrança); 
            
            break;
        }

        if ($diferenca <= 10 && $diferenca >= 0 && $array['LFI_STPAGAMENTO'] != "LIQUIDADO")
        {
            $contato = $array['CLI_NMNAME'];
            $emalCobrança = $array['GEC_DCEMAILCOBRANCA']; 

            if($diferenca == 0)
            {
                $msgTxt = "Identificamos que sua fatura vence hoje.";
            }
            else
                {
                    $msgTxt = "Identificamos que faltam $diferenca dias para o vencimento de sua fatura.";
                }
            

            $subject = "Aviso de vencimento - Codemaze";
            $msg = "
                    Olá <b>$contato</b>, bom dia! <br><br>
                    $msgTxt<br>
                    Caso já tenha realizado o pagamento, desconsidere este e-mail.<br><br>

                    Estamos à disposição para ajudá-lo(a)!<br>
                    Atenciosamente,<br><br>

                    <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

                    Codemaze - Soluções de MKT e Software<br><br>
                    vanessa.kuasne@codemaze.com.br<br>
                    faleconosco@codemaze.com.br<br>
                    suporte@codemaze.com.br<br>
                    <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>
                    ";

            $siteAdmin->updateClientFinStatus($array['CLI_IDCLIENT'],"Vencido");
            $siteAdmin->notifyPendenciasEmail($subject, $msg, $emalCobrança); 
            
            break;
        }
    }
}

echo "Fim do Script";

?>