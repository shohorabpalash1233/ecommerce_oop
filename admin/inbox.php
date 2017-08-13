<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
include '../classes/Cart.php';
$fm = new Format();
$cart = new Cart();
?>
<?php
	if (isset($_GET['shipId'])) {
		$id = $_GET['shipId'];
		$date = $_GET['date'];
		$price = $_GET['price'];

		$shipped = $cart->productShipped($id, $date, $price);
	}

	if (isset($_GET['delId'])) {
		$id = $_GET['delId'];
		$date = $_GET['date'];
		$price = $_GET['price'];

		$delOrder = $cart->delProductShipped($id, $date, $price);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                	if (isset($shipped)) {
                		echo $shipped;
                	}
                	if (isset($delOrder)) {
                		echo $delOrder;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>ID</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						
						$getOrder = $cart->getAllOrderProduct();
						if ($getOrder) {
							while ($result = $getOrder->fetch_assoc()) {
								
							
					?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>$<?php echo $result['price']; ?></td>
							<td><?php echo $result['cusId']; ?></td>
							<td><a href="customer.php?custId=<?php echo $result['cusId']; ?>" title="">View Details</a></td>
							<?php
								if ($result['status'] == '0') {?>
								<td><a href="?shipId=<?php echo $result['cusId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date'];?>">Shipped</a></td>
									<?php
								} elseif($result['status'] == '1') {
									?>
									<td>Pending</td>
									<?php
								} else {
									?>
									<td><a href="?delId=<?php echo $result['cusId']; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date'];?>">Remove</a></td>
									<?php
								}
							?>
							
						</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
