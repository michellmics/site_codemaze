<?php

header("Content-Type: application/json");

include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

//$swhmcpanel_info = new WHMCPANEL_STATUS();
//$result = $swhmcpanel_info->getDiscUsage();




$user = "inartcom";
    $token = "G3T065AP3A15QZ22FKYSF7NO30Y5ROT4";

    $query = "https://127.0.0.1:2087/json-api/listaccts?api.version=1&searchtype=domain";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);

    $header[0] = "Authorization: whm $user:$token";
    curl_setopt($curl,CURLOPT_HTTPHEADER,$header);
    curl_setopt($curl, CURLOPT_URL, $query);

    $result = json_encode(curl_exec($curl));

    
    curl_close($curl);

   echo $result;


?>