<?php
// Appel du Modele
include_once('modele/product/product.php');

$listProduits = get_produits(0); // Produit ou deleted = 0.
//get_categories($parent_categorieProduct);
if(isset($childID)){

}

if(isset($_GET['featured'])){
  $id = (int) $_GET['id'];
  $featured = (int)$_GET['featured'];
  updateFeatured($featured, $id);
}

// On transmet à la vue
include_once('vue/product/index.php');
