<?php
	include 'inc/header.php';
?>
<?php
	if (isset($_GET['delwlistid'])) {
		$productId = $_GET['delwlistid'];

		$delData = $product->delWlistData($productId, $cusid);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wishlist</h2>
			    	<?php
			    		if (isset($updateCart)) {
			    			echo $updateCart;
			    		}
			    		if (isset($delProduct)) {
			    			echo $delProduct;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th>SN</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>
							<?php
								$getPd = $product->checkWlist($cusid);
								if ($getPd) {
									$i = 0;
									while ($result = $getPd->fetch_assoc()) {
										$i++;
									
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td>$<?php echo $result['price']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
								<td>
								<a href="preview.php?proid=<?php echo $result['productId']; ?>">Buy Now</a>
								||
								<a href="?delwlistid=<?php echo $result['productId']; ?>">Remove</a>
								</td>
							</tr>
							<?php
								}
							}
							?>
							
						</table>
					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%; text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
  
  <?php
	include 'inc/footer.php';
?>