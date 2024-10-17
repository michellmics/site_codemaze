<?php
include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

$swhmcpanel_info = new WHMCPANEL_STATUS();
$result = $swhmcpanel_info->getDiscUsage();

var_dump($result);




?>