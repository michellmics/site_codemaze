<?php

session_start(); 
define('SESSION_TIMEOUT', 1800); // 30 minutos

if (!isset($_SESSION['user_id'])) 
{
  header("Location: index.php");
  exit();
}

    include_once 'objetos.php';

    $LFI_IDOP = $_GET['LFI_IDOP'];

    $siteAdmin = new SITE_ADMIN();

    $result = $siteAdmin->gerBoleto($LFI_IDOP);

    echo $result;


?>
