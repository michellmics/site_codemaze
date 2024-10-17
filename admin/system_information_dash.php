<?php
include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

//$swhmcpanel_info = new WHMCPANEL_STATUS();
//$result = $swhmcpanel_info->getDiscUsage();

var_dump($result);

$token = "L12T1GH3J4AD272VVQMX3WTN6RAUBRAZ"; // Substituir pelo token gerado
$username = "inartcom"; // Usuário da conta cPanel

$url = "https://r210us.hmservers.net:2083/cpsess1234567890/execute/DomainInfo/get_ip_address";

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