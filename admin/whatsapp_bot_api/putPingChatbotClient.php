<?php
include_once '../objetos.php'; 
$botAdmin = new SITE_ADMIN();

// Validação dos parâmetros
$BOTID = filter_input(INPUT_GET, 'botid', FILTER_SANITIZE_STRING);
$EMPRESA = strtoupper(filter_input(INPUT_GET, 'empresa', FILTER_SANITIZE_STRING));

if (!$BOTID || !$EMPRESA) {
    echo "Parâmetros 'botid' e 'empresa' são obrigatórios.";
    die();
}

// Instanciação da classe e chamada do método
$botAdmin = new SITE_ADMIN();
$botAdmin->getWhatsappBotInfo($BOTID, $EMPRESA);

// Verificação dos resultados
if (!is_array($botAdmin->ARRAY_WHATSAPPBOTINFO) || count($botAdmin->ARRAY_WHATSAPPBOTINFO) == 0) {
    echo "Empresa e Bot ID não encontrados.";
    die();
}

// Verificação do status do bot
if (isset($botAdmin->ARRAY_WHATSAPPBOTINFO["BOT_STSTATUS"]) &&
    $botAdmin->ARRAY_WHATSAPPBOTINFO["BOT_STSTATUS"] != "ATIVADO") {
    $botAdmin->updateWhatsappBotInfo($BOTID);
    echo "Este Whatsapp Bot está desativado.";
    die();
}

// Resposta de sucesso
$botAdmin->updateWhatsappBotInfo($BOTID);
echo "OK";

?>
