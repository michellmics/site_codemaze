<?php
include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

//$swhmcpanel_info = new WHMCPANEL_STATUS();
//$result = $swhmcpanel_info->getDiscUsage();

var_dump($result);

$token = "G3T065AP3A15QZ22FKYSF7NO30Y5ROT4"; // Substituir pelo token gerado
$username = "inartcom"; // Usuário da conta cPanel

$url = "http://localhost:2087/G3T065AP3A15QZ22FKYSF7NO30Y5ROT4/json-api/accountsummary?user=inartcom";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Evita problemas com SSL
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: cpanel $username:$token"
]);

$response = curl_exec($ch);
curl_close($ch);

var_dump($response);
die();


?>