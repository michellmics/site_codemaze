<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once 'objetos.php'; // Carrega a classe de conexão e objetos

$dataInicio = $_GET['dataInicio'] ?? null;
$dataFim = $_GET['dataFim'] ?? null;
$clienteOrigin = $_GET['clienteOrigin'] ?? null;
$publiDesc = $_GET['publiDesc'] ?? null;
$tipo = $_GET['tipo'] ?? null;
$status = $_GET['status'] ?? null;
$mktId = $_GET['mktId'] ?? null;
$filePath = $_GET['filePath'] ?? null;
$url = $_GET['url'] ?? null;
$endpoint = $url."/sistema/api_publicidade.php";

// Dados a serem enviados
$postData = [
    'dataInicio' => $dataInicio,
    'dataFim' => $dataFim,
    'clienteOrigin' => $clienteOrigin,
    'publiDesc' => $publiDesc,
    'status' => $status,
    'mktId' => $mktId,
    'tipo' => $tipo,
];

if (file_exists($filePath)) {
    $postData['file'] = new CURLFile($filePath);
}

$ch = curl_init();

// Configurações do cURL
curl_setopt($ch, CURLOPT_URL, $endpoint);
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

    $url = strtolower($url);
    echo "Atualização enviada ao site $url <br><br>";
    echo "<br><br><a href='javascript:window.history.back()' class='btn btn-warning'>VOLTAR</a>";

    $siteAdmin = new SITE_ADMIN();
    $siteAdmin->updaPublishResponse($mktId,$response);
    
}

// Fecha a conexão cURL
curl_close($ch);


?>