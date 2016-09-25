<?php
try {
  $db = new PDO('mysql:host=localhost;dbname=zalanboutique;charset=utf8','root','');
}
catch (Exception $e)
{
  die('Erreur : ' . $e->getMessage());
}
require_once $_SERVER['DOCUMENT_ROOT'].'/EcommerceProject/config.php';
require_once BASEURL.'helpers/helpers.php';
?>
