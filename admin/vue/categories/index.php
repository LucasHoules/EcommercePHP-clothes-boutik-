<h2 class="text-center">Categories</h2><hr>
<div class="row">
  <div class="col-md-6"><!-- Ici formulaire de gestion des categories -->
    <form class="form" action="categories.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
      <legend><?=((isset($_GET['edit']))?'Editer':'Ajouter');?> une catégorie</legend>
      <div id="errors"></div>
      <div class="form-group">
        <label for="parent">parent</label>
        <select class="form-control" name="parent" id="parent">
          <option value="0">Parent</option>
          <?php  foreach($categories as $categorieParents): ?>
            <option value="<?= $categorieParents['id']; ?>"<?=(($parent_value == $categorieParents['id'])?' selected="selected"':'');?><?= $parent_value; ?>"><?= $categorieParents['category']; ?> </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="category">Categorie</label>
        <input type="text" class="form-control" id="category" name="category" value="<?= $category_value ?>">
      </div>
      <div class="form-group">
        <input type="submit" value="<?=((isset($_GET['edit']))?'Editer':'Ajouter');?> une catégorie" class="btn btn-success">
        <?php if(isset($_GET['edit'])):?> <a class="btn btn-default" href="categories.php"> Retour en arrière </a><?php endif ?>
      </div>
    </form>
  </div>
  <div class="col-md-6"><!-- Ici il ya le tableau représentant les différentes catégories du back office. -->
    <table class="table table-bordered">
      <thead>
        <th>Categories</th><th>Parent</th><th></th><th></th>
      <thead>
        <tbody>
        <?php  foreach($categories as $categorieParents): // affichage des lignes Categorie parent du tableau ?>

          <tr class="bg-primary">
            <td><?= $categorieParents['category']; ?></td>
            <td>Parent</td>
            <td>
              <a href="categories.php?edit=<?=$categorieParents['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></a>
              <a href="categories.php?delete=<?=$categorieParents['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></a>
            </td>
          </tr>
          <?php  foreach($categoriesChild[$categorieParents['id']] as $categorieChild):   // affichage des lignes Categories enfants du tableau ?>
          <tr class="bg-info">
            <td><?= $categorieParents['category']; ?></td>
            <td><?= $categorieChild['category']; ?></td>
            <td>
              <a href="categories.php?edit=<?=$categorieChild['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></a>
              <a href="categories.php?delete=<?=$categorieChild['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></a>
            </td>
          </tr>
        <?php  endforeach; ?>
        <?php endforeach; ?>

        </tbody>
    </table>
  </div>
</div>
