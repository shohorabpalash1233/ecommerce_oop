<?php
    include '../classes/Customer.php';
?>
<?php

    if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
        echo "<script>window.location = 'inbox.php'; </script>";
    } else {
        $id = $_GET['custId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['custId']);
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php'; </script>";
    }
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock"> 
               <?php
                if (isset($updateCat)) {
                    echo $updateCat;
                }
               ?>
               <?php
                    $customer = new Customer();
                    $getCustomer = $customer->getCustomerData($id);
                    if ($getCustomer) {
                        while ($result = $getCustomer->fetch_assoc()) {
                            
                        
               ?>
                 <form method="post" action="">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['address']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['city']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['zip']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email']?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    <?php
                        }
                    }
                    ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>