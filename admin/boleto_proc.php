<?php

header('Content-Type: application/json');

    include_once 'objetos.php';

    $LFI_IDOP = $_GET['LFI_IDOP'];

    $siteAdmin = new SITE_ADMIN();

    $result = $siteAdmin->gerBoleto($LFI_IDOP);

    echo $result;


?>
