<?php
	include 'inc/header.php';
?>

<?php
	$login = Session::get("cuslogin");
	if ($login == false) {
		header("Location: login.php");
	}
?>
<style type="text/css" media="screen">
	.psuccess{
		width: 500px;
		min-height: 200px;
		text-align: center;
		border: 1px solid #ddd;
		margin: 0 auto;
		padding: 20px;
	}
	.psuccess h2 {
		border-bottom: 1px soli #ddd;
		margin-bottom: 20px;
		padding-bottom: 10px;
	}
	.psuccess p{
		line-height: 25px;
	}
</style>		
 <div class="main">
    <div class="content">
    		<div class="section group">
    			<div class="notfound">
    				<div class="psuccess">
    					<h2>Success!</h2>
    					<?php
    						$cusid = Session::get("cusid");
    						$amount = $cart->payableAmount($cusid);
    						if ($amount) {
    							$sum = 0;
    							while ($result = $amount->fetch_assoc()) {
    								$price = $result['price'];
    								$sum = $sum + $price;
    							}
    						}
    					?>
    					<hr>
    					<p class="success">Total Amount (Including VAT) : $
    					<?php 
    						$vat = $sum * 0.1;
    						$total = $sum + $vat;
    						echo $total;
    					?>
    						
    					</p>
    					<p class="success">Thanks for purchasing from our site. Your order has been placed successfully. We will contact you ASAP with the delivery details. Here is your order details... <a href="orderdetails.php" title="">Visit Here</a></p>
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