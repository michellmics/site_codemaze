<?php

// Verificação do webhook
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    $config = parse_ini_file('../../config.cfg', true);

    if (!$config) {
        die("Erro ao carregar o arquivo de configuração.");
    }
    $token = $config['TOKEN_WHATSAPP']['Token'];
    $phoneNumberId = $config['TOKEN_WHATSAPP']['TelId'];
    $verifyToken = $config['TOKEN_WHATSAPP']['VerifyToken'];
    

    $hubVerifyToken = $_GET['hub_verify_token'];
    $hubChallenge = $_GET['hub_challenge'];

    if ($hubVerifyToken === $verifyToken) {
        echo $hubChallenge;
        http_response_code(200);
    } else {
        http_response_code(403);
    }
    exit;
}

// Recebendo mensagens do webhook
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
        $message = $data['entry'][0]['changes'][0]['value']['messages'][0];
        $from = $message['from']; // Número do remetente
        $text = strtolower(trim($message['text']['body'] ?? '')); // Texto recebido
        
        file_put_contents('webhook_log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
        file_put_contents('text_log.txt', $text . PHP_EOL, FILE_APPEND);

        // Verificar se já passou um tempo suficiente desde a última interação (exemplo: 30 segundos)
        $userLastInteractionTime = getUserLastInteractionTime($from);
        if ($userLastInteractionTime !== null && (time() - $userLastInteractionTime) > 30) {  // 30 segundos 
            responderMensagem($from, "Parece que você demorou para responder. Estarei aguardando quando você tiver tempo.");
        }

        // Verificar se o usuário já interagiu com o menu
        $userHasInteracted = hasUserInteracted($from);
        
        // Mensagens de resposta baseadas no texto
        if (!$userHasInteracted && ($text === 'olá' || $text === 'oi')) {
            // Enviar o menu pela primeira vez
            $respostaGatilho = "Olá, bem-vindo(a) à *Codemaze - Soluções de MKT e Software.*😁\n\nEscolha uma das opções a seguir e envie o número correspondente a esta escolha:\n\n*1* - Mídias Sociais\n*2* - Desenvolvimento de Software\n*3* - Observabilidade\n*4* - Consultoria\n*5* - Suporte Técnico\n6 - Financeiro";
            responderMensagem($from, $respostaGatilho);
            // Registrar a interação do usuário
            setUserHasInteracted($from);
        } elseif ($text === 'ajuda') {
            responderMensagem($from, "Aqui estão algumas opções:\n1. Consultar saldo\n2. Suporte técnico\n3. Falar com um humano");
        } elseif ($text === '1') {
            responderMensagem($from, "Seu saldo atual é R$ 100,00.");
        } elseif ($text === '2') {
            responderMensagem($from, "Para suporte técnico, envie um e-mail para suporte@empresa.com.");
        } elseif ($text !== '3') {
            responderMensagem($from, "Aguarde enquanto conectamos você a um humano...");
        } else {
            responderMensagem($from, "Desculpe, não entendi sua mensagem. Envie 'ajuda' para ver as opções.");
        }

        // Registrar o momento da interação
        setUserLastInteractionTime($from, time());
    }

    http_response_code(200);
    exit;
}

// Função para verificar se o usuário já interagiu com o menu
function hasUserInteracted($userId) {
    $filename = '../../chatbot_whatsapp/chatbot_user_interaction.dat';

    // Verificar se o arquivo de interação existe
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        $lines = explode("\n", $data);

        foreach ($lines as $line) {
            if ($line === $userId) {
                return true; // O usuário já interagiu
            }
        }
    }

    return false; // O usuário ainda não interagiu
}

// Função para registrar que o usuário interagiu com o menu
function setUserHasInteracted($userId) {
    $filename = '../../chatbot_whatsapp/chatbot_user_interaction.dat';

    // Adicionar o ID do usuário que interagiu
    file_put_contents($filename, $userId . "\n", FILE_APPEND);
}

// Função para responder as mensagens
