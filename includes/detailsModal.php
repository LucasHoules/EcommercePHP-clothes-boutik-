<?php
require_once '/../core/init.php';
$id = $_POST['id']; // On récupére l'id du produit graçe à ajax.
$id = (int)$id;
$sql = "SELECT * FROM produits WHERE id = '$id'";
$result = $db->query($sql);
$product = $result->fetch();
$brand_id = $product['marque'];
$sql2 = "SELECT marque FROM marque WHERE id = '$brand_id'";
$brand_query = $db->query($sql2);
$brand = $brand_query->fetch();
$sizestring = $product['sized'];
$size_array = explode(',', $sizestring);
?>

<!--Details Modal -->
<?php ob_start();  ?>
<div class="modal fade details-1 details-modal" id="details-modal-<?php echo $id ?>" class="details-Modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
  <div class="modal- dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button class="close" type="button" onclick="closeModal()"  aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title text-center"></h4>


    </div>
    <div class="modal-body">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <div class="center-block">
              <img src="<?= $product['image']; ?>" alt="<?=  $product['titre']; ?>" class="details img-responsive" />
            </div>
          </div>
          <div class="col-sm-6">
            <h4>Details  </h4>
            <p><?= $product['description']; ?></p>
            <hr>
            <p>Prix <?= $product['list_prix']; ?>€</p>
            <p>Marque: <?= $brand['marque']; ?></p>
            <form action="add_cart.php" method="post">
              <div class="form-group">
                <div class="col-xs-3">
                  <label for="quantity">Quantité:</label>
                  <input type="text" class="form-control" id="quantity" name="quantity"/>

                </div>
              </div><br /><br />
              <div class="form-group">
                <label for="size">Taille: </label>
                <select name="size" id="size" class="form-control">
                  <option value=""></option>
                  <?php foreach($size_array as $string){
                    $string_array = explode(':', $string);
                    $size = $string_array[0];
                    $quantity = $string_array[1];
                    echo '<option value="'.$size.'">'.$size.' Reste: ('.$quantity.') </option>';
                  }?>

                </select>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn default" onclick="closeModal()" > Fermer</button>
      <button class="btn btn-warning" type="submit"><span class="glyphicon glyphicon-shopping-cart">Ajouter au panier</span></button>
    </div>
  </div>
</div>
</div>
<script>
  function closeModal(){
    $('.details-modal').modal('hide');
    setTimeout(function(){
      $('.details-modal').remove();
      $('.modal-backdrop').remove();
    },500);
  }
</script>
<?php echo ob_get_clean(); ?>
