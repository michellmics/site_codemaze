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

        // Verificar se já passaram 10 minutos desde a última interação
        $userLastInteractionTime = getUserLastInteractionTime($from);
        if ($userLastInteractionTime !== null && (time() - $userLastInteractionTime) > 30) {  // 30 segundos 
            responderMensagem($from, "Parece que você demorou para responder. Estarei aguardando quando você tiver tempo.");
        }


        //Mensagens de resposta------------------------

        $respostaGatilho = "Olá, bem-vindo(a) à Codemaze - Soluções de MKT e Software.\n
        Escolha uma das opções a seguir e envie o número
        correspondente a esta escolha:\n\n
        1 - Mídias Sociais\n
        2 - Desenvolvimento de Software\n
        3 - Observabilidade\n
        4 - Consultoria\n
        5 - Suporte Técnico\n
        6 - Financeiro";




        //----------------------------------------------








        // Respostas automáticas baseadas no texto
        if ($text === 'olá' || $text === 'oi') {
            responderMensagem($from, $respostaGatilho);
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

function responderMensagem($to, $message) {
    
    $config = parse_ini_file('../../config.cfg', true);

    if (!$config) {
        die("Erro ao carregar o arquivo de configuração.");
    }
    $token = $config['TOKEN_WHATSAPP']['Token'];
    $phoneNumberId = $config['TOKEN_WHATSAPP']['TelId'];
    
    $url = "https://graph.facebook.com/v17.0/$phoneNumberId/messages";

    $payload = [
        'messaging_product' => 'whatsapp',
        'to' => $to,
        'type' => 'text',
        'text' => ['body' => $message],
    ];

    $headers = [
        "Authorization: Bearer $token",
        "Content-Type: application/json",
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    // Log da resposta
 //   file_put_contents('response_log.txt', $response, FILE_APPEND);
}

// Função para obter o tempo da última interação do usuário
function getUserLastInteractionTime($userId) {
    $filename = '../../chatbot_whatsapp/chatbot_last_interaction_time.dat';

    // Verificar se o arquivo de interação existe
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        $lines = explode("\n", $data);
        
        foreach ($lines as $line) {
            list($user, $time) = explode(":", $line);
            if ($user == $userId) {
                return (int)$time;
            }
        }
    }

    return null; // Nenhuma interação anterior encontrada
}

// Função para registrar o tempo da última interação
function setUserLastInteractionTime($userId, $time) {
    $filename = '../../chatbot_whatsapp/chatbot_last_interaction_time.dat';
    
    // Adicionar ou atualizar o tempo de interação do usuário
    $data = file_get_contents($filename);
    $lines = explode("\n", $data);
    $found = false;
    
    foreach ($lines as &$line) {
        list($user, $oldTime) = explode(":", $line);
        if ($user == $userId) {
            $line = $userId . ":" . $time;
            $found = true;
        }
    }
    
    if (!$found) {
        $lines[] = $userId . ":" . $time;
    }

    file_put_contents($filename, implode("\n", $lines) . "\n");
}
?>
