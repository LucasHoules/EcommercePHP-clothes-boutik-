<?php
// Appel du Modele
include_once('modele/categories/categories.php');


// Gestion des calculs liés à l'affichage //

$categories = get_categories(0); // on enregistre dans notre objet $categories les categories de parent = 0.
$categoriesChild = Array(); // Déclaration du tableau Tableau des catégories enfants
$i = 0;
foreach($categories as  $categorieParents):
$i++;
$parent_id = $categorieParents['id']; // On récupére tour à tour les id de chacune des categorie de parent = 0.
$categoriesChild[$i] = get_categories($parent_id); // On enregistre dans chacune des valeurs de notre tableau un autre tableau contenant la catégorie enfant.
endforeach;



// Gestion des calculs/erreurs/sécurité liés à  l'ajout d'une catégorie//
$category = "";
if(isset($_POST) && !empty($_POST)){
  $errors = array();
  $parent = sanitize($_POST['parent']);
  $category = sanitize($_POST['category']);

  if ($category == ""){
    $errors[] .= 'Une categorie ne peut être vide';

  }
  if(category_exist($parent, $category)){
      $errors[] .= "Cette catégorie existe déjà";
  }
  if(!empty($errors)){ // Si il ya des erreurs, on les affiche
    $display = display_errors($errors); ?>
    <script>
      $('document').ready(function(){
        $('#errors').html('<?=$display; ?>')
      });
    </script>
    <?php
  }
  else{
    if(isset($_GET['edit'])){
      $edit_id = (int)$_GET['edit'];
      $edit_id = sanitize($edit_id);
      edit_categorie($edit_id, $category, $parent);
    }
    else{
      add_categories($parent, $category);
      }

  }
}




  // Gestion des calculs/erreurs/sécurité liés à  la suppresion d'une catégorie//
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  if ($category['parent'] == 0){
    delete_categories_parent($delete_id);
  }
  delete_categories($delete_id);
}

  // Gestion des calculs/erreurs/sécurité liés à  l'édition d'une catégorie//
  $category_value = "";
  $parent_value = 0;
  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $category = getCategorieById($edit_id);
    $category_value = $category['category'];
    $parent_value = $category['parent'];
  }










// On transmet à la vue
include_once('vue/categories/index.php');
