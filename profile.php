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
	.tblone{
		width: 550px;
		margin: 0 auto;
		border: 2px solid #ddd;
	}
	.tblone tr td{
		text-align: justify;
	}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">

    	<?php
    		$id = Session::get("cusid");
    	?>
				<table class="tblone">
					<tbody>
						<tr>
							<td width="20%">Name</td>
							<td width="5%">:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>Phone</td>
							<td>:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>Address</td>
							<td>:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>City</td>
							<td>:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>Country</td>
							<td>:</td>
							<td>user name</td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td>:</td>
							<td>user name</td>
						</tr>
					</tbody>
				</table>
 		</div>
 	</div>
	</div>
      
  <?php
	include 'inc/footer.php';
?>