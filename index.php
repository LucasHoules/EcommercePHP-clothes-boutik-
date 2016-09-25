<?php require_once ('core/init.php'); ?>
<?php include_once('includes/head.php'); ?>
<?php include_once('includes/navigation.php'); ?>
<?php include_once('includes/headerfull.php'); ?>
<?php include_once('includes/leftSideBar.php'); ?>
	<!-- main container -->
	<?php $sql = "SELECT * FROM produits WHERE featured = 1";
	$featured = $db->query($sql); ?>
	<div class="col-md-8"> main container
		<div class="row">
			<h2 class="text-center">Promotions du moment</h2>
			<?php while($products = $featured->fetch()): ?>
			<div class="col-md-3 text-center">
				<h4> <?= $products['titre'] ;?> </h4>
				<img src=" <?= $products['image'] ?>" alt="Levis Jean" class="img-thumb" />
				<p class="list-price text-danger">Prix d'origine:<s><?= $products['prix']; ?>€</s> </p>
				<p class="price">Notre prix: <?= $products['list_prix'] ?>€ </p>
				<button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $products['id']; ?>)" >Details</button> <!-- data-toggle="modal" data-target="#details-1" -->
			</div>
			<?php endwhile; ?>

		</div>
	 </div>
	 <script src="js/headerScroll.js"></script>


	 <?php include_once('includes/rightSideBar.php'); ?>
	 <?php include_once('includes/footer.php'); ?>
	 <script src="js/detailsModal.js"></script>



</body>
</html>
