<?php
	include_once '../lib/Database.php';
	include_once '../helper/Format.php';
?>
<?php
	/**
	* 
	*/
	class Product
	{
		private $db;
		private $fm;

		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function productInsert($data, $file){
			$productName 	= $this->fm->validation($data['productName']);
			$catId 			= $this->fm->validation($data['catId']);
			$brandId 		= $this->fm->validation($data['brandId']);
			$body 			= $this->fm->validation($data['body']);
			$price 			= $this->fm->validation($data['price']);
			$type 			= $this->fm->validation($data['type']);

			$productName 	= mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId 			= mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId 		= mysqli_real_escape_string($this->db->link, $data['brandId']);
			$body 			= mysqli_real_escape_string($this->db->link, $data['body']);
			$price 			= mysqli_real_escape_string($this->db->link, $data['price']);
			$type 			= mysqli_real_escape_string($this->db->link, $data['type']);

			$permited  		= array('jpg', 'jpeg', 'png', 'gif');
		    $file_name 		= $file['image']['name'];
		    $file_size 		= $file['image']['size'];
		    $file_temp 		= $file['image']['tmp_name'];

		    $div 			= explode('.', $file_name);
		    $file_ext 		= strtolower(end($div));
		    $unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

			if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "" || $file_name == "") {

		    	$msg = "<span class='success'>Fields Must Not Be Empty</span>";
				return $msg;

		    	} elseif ($file_size >1048567) {

			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";

			    } elseif (in_array($file_ext, $permited) === false) {

			     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    			} else {

		    	move_uploaded_file($file_temp, $uploaded_image);

		    	$query = "INSERT into tbl_product(productName, catId, brandId, body, price, image, type) 		  VALUES 
		    	('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";

				$productIns = $this->db->insert($query);

				if ($productIns) {
					$msg = "<span class='success'>Product inserted successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not inserted!</span>";
					return $msg;
				}
		    }
		}
		public function getAllProduct(){

			$query =   "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
						FROM tbl_product 
						INNER JOIN tbl_category
						ON tbl_product.catId = tbl_category.catId
						INNER JOIN tbl_brand
						ON tbl_product.brandId = tbl_brand.brandId
						ORDER BY tbl_product.productId DESC";

			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function productUpdate($data, $file, $id){

			$productName 	= $this->fm->validation($data['productName']);
			$catId 			= $this->fm->validation($data['catId']);
			$brandId 		= $this->fm->validation($data['brandId']);
			$body 			= $this->fm->validation($data['body']);
			$price 			= $this->fm->validation($data['price']);
			$type 			= $this->fm->validation($data['type']);

			$productName 	= mysqli_real_escape_string($this->db->link, $data['productName']);
			$catId 			= mysqli_real_escape_string($this->db->link, $data['catId']);
			$brandId 		= mysqli_real_escape_string($this->db->link, $data['brandId']);
			$body 			= mysqli_real_escape_string($this->db->link, $data['body']);
			$price 			= mysqli_real_escape_string($this->db->link, $data['price']);
			$type 			= mysqli_real_escape_string($this->db->link, $data['type']);

			$permited  		= array('jpg', 'jpeg', 'png', 'gif');
		    $file_name 		= $file['image']['name'];
		    $file_size 		= $file['image']['size'];
		    $file_temp 		= $file['image']['tmp_name'];

		    $div 			= explode('.', $file_name);
		    $file_ext 		= strtolower(end($div));
		    $unique_image 	= substr(md5(time()), 0, 10).'.'.$file_ext;
		    $uploaded_image = "upload/".$unique_image;

			if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {

		    	$msg = "<span class='success'>Fields Must Not Be Empty</span>";
				return $msg;

		    	} else {
		    	if (!empty($file_name)) {

		    	if ($file_size >1048567) {

			     echo "<span class='error'>Image Size should be less then 1MB!
			     </span>";

			    } elseif (in_array($file_ext, $permited) === false) {

			     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    			} else {

		    	move_uploaded_file($file_temp, $uploaded_image);

		    	$query = "UPDATE tbl_product
		    			  SET 
			    			  productName 	= '$productName',
			    			  catId 		= '$catId',
			    			  brandId 		= '$brandId',
			    			  body 			= '$body',
			    			  price 		= '$price',
			    			  image 		= '$uploaded_image',
			    			  type 			= '$type' 
		    			  WHERE productId 	= '$id' ";

				$productUpdate = $this->db->update($query);

				if ($productUpdate) {
					$msg = "<span class='success'>Product updated successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not updated!</span>";
					return $msg;
					}
		    	}

				} else {
					$query = "UPDATE tbl_product
		    			  SET 
		    			  productName 	= '$productName',
		    			  catId 		= '$catId',
		    			  brandId 		= '$brandId',
		    			  body 			= '$body',
		    			  price 		= '$price',
		    			  type 			= '$type' 
		    			  WHERE productId = '$id' ";

				$productUpdate = $this->db->update($query);

				if ($productUpdate) {
					$msg = "<span class='success'>Product updated successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not updated!</span>";
					return $msg;
					}
			}
		}

	}

	public function delProductById($id){
			$select_query = "SELECT * FROM tbl_product WHERE productId = '$id' ";
			$getData = $this->db->select($select_query);
			if ($getData) {
				while ($delImg = $getData->fetch_assoc()) {
					$dellink = $delImg['image'];
					unlink($dellink);
				}
			}

			$query = "DELETE FROM tbl_product WHERE productId = '$id' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
					$msg = "<span class='success'>Product deleted successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Product not deleted!</span>";
					return $msg;
				}
	}
		

		
	}
?>