<?php
	include 'inc/header.php';
?>

<?php
	$login = Session::get("cuslogin");
	if ($login == false) {
		header("Location: login.php");
	}
?>
<?php
	if (isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
		$cusid = Session::get("cusid");
		$insertOrder = $cart->orderProduct($cusid);
		$delData = $cart->delCustomerCart();
		header("Location: success.php");
	}
?>
<style type="text/css" media="screen">
	.division{
		width: 50%;
		float: left;
	}
	.tblone{
		width: 500px;
		margin: 0 auto;
		border: 2px solid #ddd;
	}
	.tblone tr td{
		text-align: justify;
	}
	.tbltwo{
		float: right;
		text-align: left;
		width: 70%;
		border: 2px solid #ddd;
		margin-right: 14px;
		margin-top: 12px;
	}
	.tbltwo tr td{
		text-align: justify;
		padding: 5px 10px;
	}
	.ordernow{
		padding-bottom: 30px;
	}
	.ordernow a{
		width: 200px;
		margin: 20px auto 0;
		text-align: center;
		padding: 5px;
		font-size: 30px;
		display: block;
		background: #ff0000;
		color: #fff;
		border-radius: 5px;
	}
</style>
		
 <div class="main">
    <div class="content">
    		<div class="section group">
    			<div class="division">
    				<table class="tblone">
							<tr>
								<th>SN</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Price</th>
							</tr>
							<?php
								$getPro = $cart->getCartProduct();
								if ($getPro) {
									$i = 0;
									$sum = 0;
									$qt = 0;
									while ($result = $getPro->fetch_assoc()) {
										$i++;
									
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>

								<td>Tk. <?php echo $result['price']; ?></td>
								<td><?php echo $result['quantity']; ?></td>
								
								<td>

									$<?php 
										$total = $result['price'] * $result['quantity'];
										echo $total; 
									?>
									
								</td>
								
							</tr>
							<?php
								$qt = $qt + $result['quantity'];
								$sum = $sum + $total;
							?>
							<?php
								}
							}
							?>
							
						</table>
						
						<table class="tbltwo">
							<tr>
								<td>Quantity</td>
								<td>:</td>
								<td><?php echo $qt; ?></td>
							</tr>
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<td>VAT(10%)</td>
								<td>:</td>
								<?php
									$vat = $sum * 0.1;
									$grandTotal = $sum + $vat;
									
								?>
								<td>$<?php echo $vat; ?></td>
							</tr>
							<tr>
								<td>Grand Total</td>
								<td>:</td>
								<td>$<?php echo $grandTotal; ?></td>
							</tr>
							
					   </table>
    			</div>
    			<div class="division">
    				<?php
    		$id = Session::get("cusid");
    		$getData = $customer->getCustomerData($id);
    		if ($getData) {
    			while ($result = $getData->fetch_assoc()) {
    				
    			
    	?>
				<table class="tblone">
					<tbody>
						<tr>
							
							<td colspan="3"><h2>Your Profile Details</h2></td>
						</tr>
						<tr>
							<td width="20%">Name</td>
							<td width="5%">:</td>
							<td><?php echo $result['name']; ?></td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td><?php echo $result['phone']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $result['email']; ?></td>
						</tr>
						<tr>
							<td>Address</td>
							<td>:</td>
							<td><?php echo $result['address']; ?></td>
						</tr>
						<tr>
							<td>City</td>
							<td>:</td>
							<td><?php echo $result['city']; ?></td>
						</tr>
						<tr>
							<td>Country</td>
							<td>:</td>
							<td><?php echo $result['country']; ?></td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td>:</td>
							<td><?php echo $result['zip']; ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td><a href="editprofile.php" title="">Update Details</a></td>
						</tr>
					</tbody>
				</table>
				<?php
					}
    		}
				?>
    			</div>
    		</div>
       <div class="clear"></div>
    </div>
 </div>
 <div class="ordernow">
 	<a href="?orderid=order" title="">Order</a>
 </div>
</div>
  
  <?php
	include 'inc/footer.php';
?>