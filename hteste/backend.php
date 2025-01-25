<?php

include_once 'objects.php'; 

$testeObject = new haruTest();
$token = $testeObject->login();

var_dump($token);








?>