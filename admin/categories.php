<?php
// Ici c'est le controleur "global" de categories.
require_once $_SERVER['DOCUMENT_ROOT'].'/EcommerceProject/core/init.php';
include 'vue/head.php';
include 'vue/navigation.php';
// Appel du controleur categories
include_once('controleur/categories/index.php');

include 'vue/footer.php'; ?>
