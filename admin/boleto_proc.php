<?php
    include_once 'objetos.php';

    $siteAdmin = new SITE_ADMIN();

    $result = $siteAdmin->gerBoleto();

    echo $result;


?>
