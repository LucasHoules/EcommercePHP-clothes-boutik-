<?php
  require_once '../core/init.php';
  include 'vue/head.php';
  include 'vue/navigation.php';
// On sélectionne les marques
  $requete = "SELECT * FROM marque ORDER BY marque";
  $results = $db->query($requete);
  $errors = array();

  // Editer une marque:

  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "SELECT * FROM marque WHERE id = '$edit_id'";
    $edit_result = $db->query($sql2);
    $setBrand = $edit_result->fetch();
  }

  //Supprimer une marque
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "DELETE FROM marque WHERE id = '$delete_id'";
    $db->query($sql);
    header('Location: brands.php');
  }
  //If le formulaire d'ajout est envoyé
if(isset($_POST['add_submit'])){
  $brand = sanitize( $_POST['brand']);
  // Si marque est vide
  if($_POST['brand'] == ''){
    $errors[] .= 'Vous devez entrer une marque !';
  }
  //Si la marque existe dans la base de données.
  $sql = "SELECT * FROM marque WHERE marque = '$brand' ";
  if(isset($_GET['edit'])){
    $sql ="SELECT * FROM marque WHERE marque = '$brand' AND id != '$edit_id'";
  }
  $result = $db->query($sql);
  $count = $result->rowCount(); // On conte le nombre de lignes
  if($count > 0){ // Si il ya au moins une marque c'est que la marque existe dans la base de donnée.
    $errors[] .= $brand. ' existe déjà, merci de choisir un autre nom';
  }

  //Afficher erreurs
  if(!empty($errors)){
    echo display_errors($errors);
  }else{
    // Ajouter la marque dans la base.
    $sql = "INSERT INTO marque (marque) VALUES('$brand')";
    if(isset($_GET[edit])){
      $sql = "UPDATE marque SET marque = '$brand' WHERE id = '$edit_id'";
    }
    $db->query($sql);
    header('Location: brands.php');
  }
}
 ?>
  <h2 class="text-center">Marques</h2><hr>
  <!-- Formulaire de marque -->
  <div class="text-center">
      <form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
        <div class="form-group">
          <?php $brand_value = "";
          if(isset($_GET['edit'])){
            $brand_value = ($setBrand['marque']);
          }else{
            if(isset($_POST['brand'])){
              $brand_value = sanitize($_POST['brand']);
            }
          }?>
          <label for="brand"><?= ((isset($_GET['edit']))?'Modifier': 'Ajouter'); ?> une marque</label>
          <input type="text" name="brand" id="brand" class="form-control" value="<?=$brand_value; ?>">
          <?php if(isset($_GET['edit'])): ?>
            <a href="brands.php" class="btn btn-default">Retour</a>
          <?php endif; ?>
          <input type="submit" name="add_submit" value="<?= ((isset($_GET['edit']))?'Modifier': 'Ajouter'); ?> une marque" class="btn btn-lg btn-success">
        </div>
      </form>
  </div><hr>
  <table class="table table-bordered table-striped table-auto table-condensed">
    <thead>
      <th></th>  <th>Marques:</th>  <th></th>
    </thead>
    <tbody>
      <?php while($brand = $results->fetch()): ?>
      <tr>
          <td><a href="brands.php?edit=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
          <td><?= $brand['marque']; ?></td>
          <td><a href="brands.php?delete=<?=$brand['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
      </tr>
    <?php endwhile; ?>
    <tbody>
  </table>
 <?php include 'vue/footer.php';  ?>
