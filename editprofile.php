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
	$cusid = Session::get("cusid");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

        $updateCustomer = $customer->updateCustomer($_POST, $cusid);
    }
?>
<style type="text/css" media="screen">
	.tblone{
		width: 550px;
		margin: 0 auto;
		border: 2px solid #ddd;
	}
	.tblone tr td{
		text-align: justify;
	}
	.tblone input[type="text"]{
		width: 400px;
		padding: 5px;
		font-size: 15px;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">

    	<?php
    		$id = Session::get("cusid");
    		$getData = $customer->getCustomerData($id);
    		if ($getData) {
    			while ($result = $getData->fetch_assoc()) {
    				
    			
    	?>
    	<form action="" method="post" >
				<table class="tblone">
					<tbody>
					<?php
						if (isset($updateCustomer)) {
							echo "<tr><td colspan='2'>".$updateCustomer."</td></tr>";
						}
					?>
						
						<tr>
							
							<td colspan="2"><h2>Update Profile Details</h2></td>
						</tr>
						<tr>
							<td width="20%">Name</td>

							<td>
								<input type="text" name="name" value="<?php echo $result['name']; ?>">
							</td>
						</tr>
						<tr>
							<td>Phone</td>

							<td>
								<input type="text" name="phone" value="<?php echo $result['phone']; ?>">
							</td>
						</tr>
						<tr>
							<td>Email</td>

							<td>
								<input type="text" name="email" value="<?php echo $result['email']; ?>">
							</td>
						</tr>
						<tr>
							<td>Address</td>

							<td>
								<input type="text" name="address" value="<?php echo $result['address']; ?>">
							</td>
						</tr>
						<tr>
							<td>City</td>

							<td>
								<input type="text" name="city" value="<?php echo $result['city']; ?>">
							</td>
						<tr>
							<td>Country</td>

							<td>
								<input type="text" name="country" value="<?php echo $result['country']; ?>">
							</td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td>
								<input type="text" name="zip" value="<?php echo $result['zip']; ?>">
							</td>
						</tr>
						<tr>
							<td></td>

							<td><input type="submit" name="submit" value="Save"></td>
						</tr>
					</tbody>
				</table>
				</form>
				<?php
					}
    		}
				?>
 		</div>
 	</div>
	</div>
      
  <?php
	include 'inc/footer.php';
?>