
<!-- Top Nav bar -->
<?php
$sql = "SELECT * FROM categories WHERE parent = 0"; // Sélection des catégories (hommes, femmes, garçons, filles).
$pquery = $db->query($sql);
?>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <a href="admin" class=navbar-brand>Aller sur le back office</a>
    <a href="index.php" class="navbar-brand">Zalan Boutique</a>
    <ul class="nav navbar-nav">
      <?php while($parent =$pquery->fetch()) :  // On parcours chacune des catégories donc 4 tour de boucle. ?>
      <?php $parent_id = $parent['id'];
      $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
      $cquery = $db->query($sql2); ?>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $parent['category']; ?><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu" >
          <?php while($child = $cquery->fetch()) : ?>
          <li><a href="#"><?php echo $child['category'] ?></a></li>
        <?php endwhile ; ?>

        </ul>
       </li>
     <?php endwhile; ?>
    </ul>
  </div>
</nav>
