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
  .tblone tr td{
    text-align: justify;
  }
</style>
<?php
  if (isset($_GET['customerId'])) {
    $id = $_GET['customerId'];
    $date = $_GET['date'];
    $price = $_GET['price'];

    $confirm = $cart->productShippedConfirm($id, $date, $price);
  }
?>
 <div class="main">
    <div class="content">
    		<div class="section group">
    			<div class="notfound">
    				<h2>Your Order Details</h2>
            <table class="tblone">
              <tr>
                <th>No</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <?php
                $cusid = Session::get("cusid");
                $getOrder = $cart->getOrderProduct($cusid);
                if ($getOrder) {
                  $i = 0;
                  while ($result = $getOrder->fetch_assoc()) {
                    $i++;
                  
              ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $result['productName']; ?></td>
                <td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                <td><?php echo $result['quantity']; ?></td>
                
                <td>$<?php echo $result['price'];?></td>
                <td><?php echo $fm->formatdate($result['date']); ?></td>
                <td>

                  <?php 
                    if ($result['status'] == '0') {
                      echo "Pending";
                    }elseif($result['status'] == '1'){
                      echo "Shipped";
                   }else{
                      echo "Ok";
                    }
                  ?>
                  
                </td>
                <?php
                  if ($result['status'] == '1') {
                    ?>
                    <td><a href="?customerId=<?php echo $cusid; ?>&price=<?php echo $result['price']; ?>&date=<?php echo $result['date'];?>">Confirm</a></td>
                    <?php
                  } elseif($result['status'] == '2') { ?>
                    <td>Ok</td>
                    <?php
                  }elseif($result['status'] == '0'){
                    ?>
                    <td>N/A</td>
                    <?php
                  }
                ?>
                
              </tr>
              <?php
                }
              }
              ?>
              
            </table>
    			</div>
    		</div>
       <div class="clear"></div>
    </div>
 </div>
</div>
  
  <?php
	include 'inc/footer.php';
?>