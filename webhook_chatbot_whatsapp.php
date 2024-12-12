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

        //Mensagens de perguntas------------------------
        $perguntaGatilho[0] = "Olá, bem-vindo(a) à *Codemaze Soluções de MKT e Software.*😁";
        $perguntaGatilho[1] = "ID0";

        $perguntaMenuPrincipal[0] = "Escolha uma das opções a seguir e envie o número correspondente a esta escolha:\n\n*1* - Mídias Sociais\n*2* - Desenvolvimento de Software\n*3* - Observabilidade\n*4* - Consultoria\n*5* - Suporte Técnico\n6 - Financeiro";
        $perguntaMenuPrincipal[1] = "ID1";

        $perguntaAjudarMaisAlgumaCoisa[0] = "Podemos ajudar em algo mais?\n\n*1* - Sim\n*2* - Não";
        $perguntaAjudarMaisAlgumaCoisa[1] = "ID2";

        $perguntaSuporteTecnico[0] = "Indique a opção abaixo:\n\n*1* - Equipamento de Informatica\n*2* - Sistemas\n*3* - Site / e-mail / Hosting\n*4* - Consultoria\n*5* - Checar o status dos servidores WEB\n*6* - Voltar ao menu principal";
        $perguntaSuporteTecnico[1] = "ID3";

        $perguntaFinanceiro[0] = "Indique a opção abaixo:\n\n*1* - Solicitar Boleto\n*2* - Checar valores pendentes\n*3* - Falar com um atendente\n*4* - Voltar ao menu principal";
        $perguntaFinanceiro[1] = "ID4";
        //Mensagens de perguntas------------------------
        
        //Mensagens Afirmativas-------------------------
        $respostaObrigadoPorContatar = "Obrigado por nos contatar.\nA Codemaze agradece.\nTenha um ótimo dia.";
        $respostaVamosRedirecionarAtendente = "Aguarde um momento.\nEstamos encaminhando sua solicitação para um atendente.";
        $respostaRedirMenuPrincipal = "*Certo!\nEstamos te redirecionando ao menu principal.";

            //suporte
            $respostaSistemas = "*Certo!*\nVamos redirecionar seu atendimento a nossa equipe de suporte sistêmico.";
            $respostaEquipamento = "*Certo!*\nVamos redirecionar seu atendimento a nossa equipe de suporte em hardware.";
            $respostaHosting = "*Certo!*\nVamos redirecionar seu atendimento a nossa equipe de suporte WEB.";
            $respostaConsultoria = "*Certo!*\nVamos redirecionar seu atendimento ao nosso consultor.";

            //financeiro
            $respostaBoleto = "*Certo!*\nVou gerar o próximo boleto a vencer.";
            $respostaValoresPend = "*Certo!*\nVou consultar os valores pendentes. Aguarde...";
            

        //Mensagens Afirmativas-------------------------

        //----------------------------------------------


        // Verificar se já passaram 10 minutos desde a última interação
        $userLastInteractionTime = getUserLastInteractionTime($from);
        if ($userLastInteractionTime !== null && (time() - $userLastInteractionTime) > 30) {  // 30 segundos 
            responderMensagem($from, "Entendi que você pode estar ocupado(a) agora. Sem problemas!\nEstamos à disposição, é só nos chamar quando puder. 😊");
            deleteUserInteraction($from);
            setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
        }



        $lastUserLastAwnser = getUserLastAwnser($from); 

        // GATILHO - MENU PRINCIPAL
        if ($text !== '' && $lastUserLastAwnser == "ID0") {
            responderMensagem($from, $perguntaGatilho[0]);
            responderMensagem($from, $perguntaMenuPrincipal[0]);
            setUserLastAwnser($from, $perguntaMenuPrincipal[1]); //proximo menu
        }

         //MENU PRINCIPAL
        if($lastUserLastAwnser == "ID1")
        {
            switch ($text) {
                case "1":
                    responderMensagem($from, $respostaVamosRedirecionarAtendente);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "2":
                    responderMensagem($from, $respostaVamosRedirecionarAtendente);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "3":
                    responderMensagem($from, $respostaVamosRedirecionarAtendente);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "4":
                    responderMensagem($from, $respostaVamosRedirecionarAtendente);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;  
                case "5":
                    responderMensagem($from, $perguntaSuporteTecnico[0]);
                    setUserLastAwnser($from, $perguntaSuporteTecnico[1]); //direciona para o Menu de suporte
                    break; 
                case "6":
                    responderMensagem($from, $perguntaFinanceiro[0]); 
                    setUserLastAwnser($from, $perguntaFinanceiro[1]); 
                    $to = "5511982734350";
                    $message = "Olá, esta é uma mensagem de teste!";
                    responderMensagemWhats($to, $message);
                    break;   
                default: 
                    responderMensagem($from, "Ops! Acho que não entendi muito bem. 🤔\nPor favor, escolha uma das opções abaixo e me diga o número correspondente. 😊");            
            }
        }

        //MENU SUPORTE TÉCNICO
        if($lastUserLastAwnser == "ID3")
        {
            switch ($text) {
                case "1":
                    responderMensagem($from, $respostaEquipamento);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "2":
                    responderMensagem($from, $respostaSistemas);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "3":
                    responderMensagem($from, $$respostaHosting);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "4":
                    responderMensagem($from, $respostaConsultoria);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;  
                case "5":
                    responderMensagem($from, "Status dos Servidores OK");
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "6":
                    responderMensagem($from, $$respostaRedirMenuPrincipal);
                    responderMensagem($from, $perguntaMenuPrincipal[0]);
                    setUserLastAwnser($from, $perguntaMenuPrincipal[1]); //direciona para o Menu principal
                    break;  
                default: 
                    responderMensagem($from, "Ops! Acho que não entendi muito bem. 🤔\nPor favor, escolha uma das opções abaixo e me diga o número correspondente. 😊"); 
                    responderMensagem($from, $perguntaSuporteTecnico[0]);           
            }
        }

        //MENU SUPORTE TÉCNICO
        if($lastUserLastAwnser == "ID4")
        {
            switch ($text) {
                case "1":
                    responderMensagem($from, $$respostaBoleto);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "2":
                    responderMensagem($from, $respostaValoresPend);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "3":
                    responderMensagem($from, $$respostaVamosRedirecionarAtendente);
                    setUserLastAwnser($from, $perguntaGatilho[1]); //direciona para o gatilho
                    break;
                case "4":
                    responderMensagem($from, $$respostaRedirMenuPrincipal);
                    responderMensagem($from, $perguntaMenuPrincipal[0]);
                    setUserLastAwnser($from, $perguntaMenuPrincipal[1]); //direciona para o Menu principal
                    break;  
                default: 
                    responderMensagem($from, "Ops! Acho que não entendi muito bem. 🤔\nPor favor, escolha uma das opções abaixo e me diga o número correspondente. 😊"); 
                    responderMensagem($from, $perguntaFinanceiro[0]);           
            }
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

// Função para registrar a ultima pergunta que o usuario interagiu
function setUserLastAwnser($userId, $lastAwnser) {
    $filename = '../../chatbot_whatsapp/chatbot_user_last_awnser.dat';
    
    // Adicionar ou atualizar ultima pergunta que o usuario interagiu
    $data = file_get_contents($filename);
    $lines = explode("\n", $data);
    $found = false;
    
    foreach ($lines as &$line) {
        list($user, $oldTime) = explode(":", $line);
        if ($user == $userId) {
            $line = $userId . ":" . $lastAwnser;
            $found = true;
        }
    }
    
    if (!$found) {
        $lines[] = $userId . ":" . $lastAwnser;
    }

    file_put_contents($filename, implode("\n", $lines) . "\n");
}

// Função para obter o ultimo menu que o usuario iterou
function getUserLastAwnser($userId) {
    $filename = '../../chatbot_whatsapp/chatbot_user_last_awnser.dat';
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        $lines = explode("\n", $data);
        
        foreach ($lines as $line) {
            list($user, $menu) = explode(":", $line);
            if ($user == $userId) {
                return (string)$menu;
            }
        }
    }
    return "ID0"; // Nenhuma interação anterior encontrada
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

// Função para excluir a interação do usuário (quando terminar o atendimento ou voltar ao início)
function deleteUserInteraction($userId) {
    $filename = '../../chatbot_whatsapp/chatbot_user_interaction.dat';

    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        $lines = explode("\n", $data);

        // Remove o ID do usuário
        $lines = array_filter($lines, function($line) use ($userId) {
            return $line !== $userId;
        });

        // Grava de volta o arquivo sem a interação
        file_put_contents($filename, implode("\n", $lines) . "\n");
    }
}

function responderMensagemWhats($to, $message) {

    $config = parse_ini_file('../../config.cfg', true);

    if (!$config) {
        die("Erro ao carregar o arquivo de configuração.");
    }
    $token = $config['TOKEN_WHATSAPP']['Token'];
    $phoneNumberId = $config['TOKEN_WHATSAPP']['TelId'];
    $verifyToken = $config['TOKEN_WHATSAPP']['VerifyToken'];

    // URL da API do WhatsApp (substitua pelo endpoint correto do seu provedor)
    $url = "https://graph.facebook.com/v17.0/$phoneNumberId/messages";

     // Parâmetros da mensagem
    $data = [
        'to' => $to,
        'type' => 'text', // Define o tipo de mensagem
        'text' => ['body' => $message] // Corpo da mensagem
    ];

    // Inicializa cURL
    $ch = curl_init();

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        "Authorization: Bearer $token" // Adiciona o token de autenticação
    ]);

    // Executa a requisição e captura a resposta
    $response = curl_exec($ch);

    // Verifica se houve erro
    if (curl_errno($ch)) {
        echo "Erro ao enviar mensagem: " . curl_error($ch) . "\n";
    } else {
        // Exibe a resposta da API para fins de debug
        echo "Resposta da API: $response\n";
        file_put_contents('response_log.txt', $response, FILE_APPEND);
    }

    // Fecha a conexão cURL
    curl_close($ch);
}



?>
