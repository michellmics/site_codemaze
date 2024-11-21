<?php
//informa erros na tela
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//informa erros na tela

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$siteAdmin = new SITE_ADMIN();
$siteAdmin->getProxContratosAVencerTransferenciaBancaria(); 

if(count($siteAdmin->ARRAY_PROXVENCIMENTOS) == 0)
{
    echo "Não há boletos a serem enviados com vencimento próximo.";
    die();
}

// Reestruturação dos dados agrupando por cliente
$resultado = array();

foreach ($siteAdmin->ARRAY_PROXVENCIMENTOS as $cobranca) {
    // Obter o ID do cliente para organizar os boletos
    $cliente_id = $cobranca['CLI_IDCLIENT'];
    
    // Verificar se o cliente já foi adicionado no array de resultado
    if (!isset($resultado[$cliente_id])) {
        $resultado[$cliente_id] = array(
            'CLI_IDCLIENT' => $cliente_id,
            'CLI_NMNAME' => $cobranca['CLI_NMNAME'],
            'boletos' => array()
        );
    }

    // Adicionar o boleto ao cliente correspondente
    $resultado[$cliente_id]['boletos'][] = $cobranca;
}


$LISTA_EMAIL_COBRANÇA = $resultado;

foreach($LISTA_EMAIL_COBRANÇA as $itens)
{
    $listaDebitos = array();
    $mensagemListaDebitos = "";
    $aux=0;

    /*
    foreach($itens["boletos"] as $boletos)
    {
        $listaDebitos[$aux] = $boletos["LFI_DCVALOR_PARCELA"]; 
        $updateResult = $siteAdmin->updateMailCobranca($boletos["LFI_IDOP"]);
        echo "<pre>" . print_r($updateResult, true) . "</pre><br>";
        sleep(1);
        $aux++;
    }
    */

    foreach($itens["boletos"] as $boletos) 
    {
        $listaDebitos[$aux] = array(
            "valor" => $boletos["LFI_DCVALOR_PARCELA"], 
            "contrato" => $boletos["GEC_IDGESTAO_CONTRATO"], 
            "servico" => $boletos["PRS_NMNOME"],
            "vencimento" => $boletos["LFI_DTVENCIMENTO"]
        );
        //$updateResult = $siteAdmin->updateMailCobranca($boletos["LFI_IDOP"]);
        //echo "<pre>" . print_r($updateResult, true) . "</pre><br>";
        sleep(1);
        $aux++;
    }

    $totalValores = array_sum(array_column($listaDebitos, 'valor'));

    foreach($listaDebitos as $itens)
    {
        $mensagemListaDebitos = $mensagemListaDebitos.$itens["contrato"]." - ".$itens["vencimento"]." - ".ucfirst(strtolower($itens["servico"])).": Valor: R$".$itens["valor"]."<br>";
    }


    $nome = $boletos["CLI_NMNAME"];
    $assunto = "Codemaze - Fatura a vencer";
    //$email = $boletos["GEC_DCEMAILCOBRANCA"];
    $email = "michell.oliveira@codemaze.com.br";
    $body = " Olá <b>$nome</b>, bom dia! <br><br>
                    Gostaríamos de lembrar que sua(s) fatura(s) vencerá(ão) nos próximos dias.<br>
                    Por favor, confira abaixo os débitos referentes ao próximo vencimento.<br><br>
                    
                    $mensagemListaDebitos

                    <b>Total da Fatura: R$$totalValores</b>
                    <br>
                    <br>
                    <b>Informações para pagamento </b><br>
                    <b>Nome do Beneficiario:</b> Michell Duarte de Oliveira<br>
                    <b>Banco:</b> Itaú<br>
                    <b>PIX CPF:</b> 049.967.919-93<br>
                    <b>Agência:</b> 3704<br>
                    <b>Conta Corrente:</b> 16720-8<br>
                    <br>
                    <br>
                    Estamos à disposição para ajudá-lo(a)!<br>
                    Atenciosamente,<br><br>

                    <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

                    Codemaze - Soluções de MKT e Software<br><br>
                    financeiro@codemaze.com.br<br>
                    suporte@codemaze.com.br<br>
                    <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>";

    $resultMail = $siteAdmin->sendEmailPHPMailer($email,$assunto,$body,"na"); 
    $siteAdmin->InsertAlarme("Enviado o boleto para o cliente $nome.","Info");
    sleep(1);

    echo "$resultMail <br>";
}


?>