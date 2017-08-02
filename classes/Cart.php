<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>
<?php
	/**
	* 
	*/
	class Cart
	{
		private $db;
		private $fm;

		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function addToCart($quantity, $id){
			$quantity = $this->fm->validation($quantity);

			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$productId = mysqli_real_escape_string($this->db->link, $id);

			$sessionId = session_id();

			$query = "SELECT * FROM tbl_product WHERE productId = '$productId' ";
			$result = $this->db->select($query)->fetch_assoc();

			$productName 	= $result['productName'];
			$price 			= $result['price'];
			$image 			= $result['image'];

		$checkQuery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sessionId = '$sessionId' ";

		$getPro = $this->db->select($checkQuery);

		if ($getPro) {
			$msg = "Product Already Added!";
			return $msg;
		} else {
			$insertQuery = "INSERT into tbl_cart(sessionId, productId, productName, price, quantity, image) 		  	VALUES 
		    				('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";

			$insertCart = $this->db->insert($insertQuery);

			if ($insertCart) {
				header("Location: cart.php");
			} else {
				header("Location: 404.php");
			}
		}

			
		}

		public function getCartProduct(){
			$sessionId = session_id();

			$query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
			$result = $this->db->select($query);
			return $result;
		}

		public function updateCart($cartId, $quantity){
			$cartId 	= $this->fm->validation($cartId);
			$quantity 	= $this->fm->validation($quantity);

			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);

			$query = "UPDATE tbl_cart 
					  SET quantity = '$quantity' 
					  WHERE cartId = '$cartId'";
			$cartUpdate = $this->db->update($query);
			if ($cartUpdate) {
				$msg = "<span class='success'>Quantity updated successfully</span>";
				return $msg;
			} else {
				$msg = "<span class='error'>Quantity not updated!</span>";
				return $msg;
			}

		}

		public function deleteProductByCart($delid){
			$delid = mysqli_real_escape_string($this->db->link, $delid);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$delid' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
					header("Location: cart.php");
				} else {
					$msg = "<span class='error'>Product not deleted!</span>";
					return $msg;
				}
		}

		public function checkCartTable(){
			$sessionId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>