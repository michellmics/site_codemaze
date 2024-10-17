<?php

header("Content-Type: application/json");

include_once 'objetos_status_server.php'; // Carrega a classe de conexão e objetos

$swhmcpanel_info = new WHMCPANEL_STATUS();
$hostNameServer = $swhmcpanel_info->getInfoWebServer("gethostname");
$loadAvgServer = $swhmcpanel_info->getInfoWebServer("loadavg");
$discUsageServer = $swhmcpanel_info->getInfoWebServer("get_disk_usage");
$bandWithServer = $swhmcpanel_info->getInfoWebServer("showbw");


echo $hostNameServer;
echo $loadAvgServer;
echo $discUsageServer;
echo $bandWithServer;








?>