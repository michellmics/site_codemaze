<?php
    header('Content-Type: application/json');
    include_once 'objetos.php';

    $siteAdmin = new SITE_ADMIN();

    $LFI_IDOP = '40222010';

    $result = $siteAdmin->gerBoleto($LFI_IDOP);

    echo $result;


?>
