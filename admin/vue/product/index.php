<h2 class="text-center">Produits</h2><hr>
<a href="product.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Ajouter un produit</a>
<hr>
<table class="table table-bordered table-condensed table-striped">
  <thead><th></th><th>Produits</th><th>Prix</th><th>Categorie</th><th>Featured</th><th>Sold</th></thead>
  <tbody>
    <?php foreach($listProduits as $unProduit): ?>
      <tr>
        <td>
          <a href="product.php?edit= <?= $unProduit['id']; ?>" class=" btn btn-ws btn-default"><span class="glyphicon glyphicon-pencil"></a>
          <a href="product.php?delete=<?= $unProduit['id']; ?>" class=" btn btn-ws btn-default"><span class="glyphicon glyphicon-remove"></a>
        </td>
        <td>
            <?= $unProduit['titre'];  ?>
        </td>
        <td>
          <?= $unProduit['list_prix']. '€'; ?>
        </td>
        <td>



        </td>
        <td>
          <a href="product.php?featured=<?=(($unProduit['featured'] == 0)?'1':'0'); ?>&id=<?=$unProduit['id']; ?>" class="btn btn-xs btn-default glyphicon glyphicon-<?=(($unProduit['featured'] == 1)?'minus':'plus'); ?>"></a>
          &nbsp <?=(($unProduit['featured'] == 1)?'Featured Produit':''); ?>)
        </td>
        <td></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
