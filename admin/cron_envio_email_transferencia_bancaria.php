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

foreach ($siteAdmin->ARRAY_PROXVENCIMENTOS as $boleto) {
    // Obter o ID do cliente para organizar os boletos
    $cliente_id = $boleto['CLI_IDCLIENT'];
    
    // Verificar se o cliente já foi adicionado no array de resultado
    if (!isset($resultado[$cliente_id])) {
        $resultado[$cliente_id] = array(
            'CLI_IDCLIENT' => $cliente_id,
            'CLI_NMNAME' => $boleto['CLI_NMNAME'],
            'boletos' => array()
        );
    }

    // Adicionar o boleto ao cliente correspondente
    $resultado[$cliente_id]['boletos'][] = $boleto;
}
echo "<pre>";
print_r($resultado);
echo "</pre>";
die();

$LISTA_EMAIL_BOLETOS = $resultado;

foreach($LISTA_EMAIL_BOLETOS as $itens)
{
    $listaBoletos = array();
    $aux=0;

    foreach($itens["boletos"] as $boletos)
    {
        $listaBoletos[$aux] = $boletos["LFI_PAGSEGURO_LINK_BOLETO"]; 
        $updateResult = $siteAdmin->updateMailCobranca($boletos["LFI_IDOP"]);
        echo "<pre>" . print_r($updateResult, true) . "</pre><br>";
        sleep(1);
        $aux++;
    }

    $nome = $boletos["CLI_NMNAME"];
    $assunto = "Codemaze - Fatura a vencer";
    $email = $boletos["GEC_DCEMAILCOBRANCA"];
    $body = " Olá <b>$nome</b>, bom dia! <br><br>
                    Gostaríamos de lembrar que sua(s) fatura(s) vencerá(ão) nos próximos dias.<br>
                    Por favor, confira os boletos anexados referentes ao próximo vencimento.<br><br>
                    
                    Estamos à disposição para ajudá-lo(a)!<br>
                    Atenciosamente,<br><br>

                    <img src='https://www.codemaze.com.br/site/images/logos/logo.jpg' alt='Codemaze Logo' style='max-width:200px;'> <br>

                    Codemaze - Soluções de MKT e Software<br><br>
                    financeiro@codemaze.com.br<br>
                    suporte@codemaze.com.br<br>
                    <a href='https://www.codemaze.com.br'>codemaze.com.br</a><br>";

    $resultMail = $siteAdmin->sendEmailPHPMailer($email,$assunto,$body,$listaBoletos); 
    $siteAdmin->InsertAlarme("Enviado o boleto para o cliente $nome.","Info");
    sleep(1);

    echo "$resultMail <br>";
}


?>