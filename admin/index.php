<?php
  include_once 'objetos.php'; 

  $siteAdmin = new SITE_ADMIN();
  $result = $siteAdmin->getSiteInfo();

  var_dump($result);
  die();

  session_start(); 

?>

