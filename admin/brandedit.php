<?php
    include '../classes/Brand.php';
?>
<?php

    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        echo "<script>window.location = 'brandlist.php'; </script>";
    } else {
        $id = $_GET['brandid'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['brandid']);
    }

    $brand = new Brand();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];

        $updateBrand = $brand->brandUpdate($brandName, $id);
    }
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
               <?php
                if (isset($updateBrand)) {
                    echo $updateBrand;
                }
               ?>
               <?php
                    $getBrand = $brand->getBrandById($id);
                    if ($getBrand) {
                        while ($result = $getBrand->fetch_assoc()) {
                            
                        
               ?>
                 <form method="post" action="">
                    <table class="form">                    
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']?>" class="medium" />
                            </td>
                        </tr>
                        <tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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