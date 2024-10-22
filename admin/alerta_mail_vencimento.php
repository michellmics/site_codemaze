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
    if($array["LFI_STPAGAMENTO"] != "LIQUIDADO")
    {
        $now = new DateTime(); 
        $vencimento = new DateTime($contrato['LFI_DTVENCIMENTO']); 
        
        // Calcula a diferença em dias
        $diferenca = (int)$now->diff($vencimento)->format('%r%a');

        if ($diferenca < -5 && $contrato['LFI_STPAGAMENTO'] != "LIQUIDADO")
        {
            $contato = $contrato['CLI_NMNAME'];

            $subject = "Pendência de Pagamento";
            $msg = "Olá $contato, bom dia! <br><br>
            Identificamos pendência(s) de pagamento em nosso sistema relacionadas à sua conta. <br>
            Pedimos que entre em contato conosco o quanto antes para regularizar a situação e evitar a suspensão de seus serviços.<br><br><br>

            Estamos à disposição para ajudá-lo(a)!<br>
            Atenciosamente,<br><br>

            Vanessa Kuasne - Departamento Financeiro <br>
            Codemaze - Soluções de MKT e Software<br><br>
            vanessa.kuasne@codemaze.com.br<br>
            faleconosco@codemaze.com.br<br>
            suporte@codemaze.com.br<br>
            codemaze.com.br<br>";

            $siteAdmin->notifyEmail($subject, $msg);
        
        }
    }
}

echo "Fim do Script";

?>