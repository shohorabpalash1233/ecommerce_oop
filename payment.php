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
	.payment{
		width: 500px;
		min-height: 200px;
		text-align: center;
		border: 1px solid #ddd;
		margin: 0 auto;
		padding: 50px;
	}
	.payment h2 {
		border-bottom: 1px soli #ddd;
		margin-bottom: 80px;
		padding-bottom: 10px;
	}
	.payment a {
		background-color: #ff0000;
		color: #fff;
		font-size: 25px;
		padding: 5px 30px;
		border-radius: 5px;
	}
	.payment a:hover {
		background-color: #333;
		transition: 0.5s ease;
	}
	.back a {
		width: 150px;
		margin: 0 auto;
		background-color: #333;
		color: #fff;
		padding: 10px 0px;
		display: block;
		text-align: center;
		border-radius: 5px;
		font-size: 20px;
		margin-top: 5px;
	}
</style>		
 <div class="main">
    <div class="content">
    		<div class="section group">
    			<div class="notfound">
    				<div class="payment">
    					<h2>Choose Payment Option</h2>
    					<a href="paymentoffline.php" title="">Offline Payment</a>
    					<a href="paymentonline.php" title="">Online Payment</a>
    				</div>
    				<div class="back">
    					<a href="cart.php" title="">Previous</a>
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