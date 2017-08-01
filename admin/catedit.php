<?php
    include '../classes/Category.php';
?>
<?php

    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
    } else {
        $id = $_GET['catId'];
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
    }

    $cat = new Category();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];

        $updateCat = $cat->catUpdate($catName, $id);
    }
?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
               <?php
                if (isset($updateCat)) {
                    echo $updateCat;
                }
               ?>
               <?php
                    $getCat = $cat->getCatById($id);
                    if ($getCat) {
                        while ($result = $getCat->fetch_assoc()) {
                            
                        
               ?>
                 <form method="post" action="">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']?>" class="medium" />
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