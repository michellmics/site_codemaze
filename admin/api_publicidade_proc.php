<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

header('Content-Type: application/json');

$url = "https://www.prqdashortensias.com.br/sistema/api_publicidade.php";

// Dados a serem enviados
$postData = [
    'dataInicio' => '2024-01-01',
    'dataFim' => '2024-01-31',
    'clienteOrigin' => 'Cliente Teste',
    'status' => 'Ativo',
    'mktId' => '12345',
];

// Arquivo opcional (se necessário)
$filePath = 'caminho/para/sua/imagem.jpg'; // Substitua pelo caminho real do arquivo
if (file_exists($filePath)) {
    $postData['file'] = new CURLFile($filePath);
}

$ch = curl_init();

// Configurações do cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retorna a resposta como string

// Executa a requisição
$response = curl_exec($ch);

// Verifica erros
if ($response === false) {
    echo "Erro: " . curl_error($ch);
} else {
    // Decodifica e exibe a resposta
    $responseDecoded = json_decode($response, true);
    print_r($responseDecoded);
}

// Fecha a conexão cURL
curl_close($ch);




?>