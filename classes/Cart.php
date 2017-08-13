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
				header("Location: cart.php");
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

		public function delCustomerCart(){
			$sessionId = session_id();
			$query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId' ";
			$this->db->delete($query);	
		}

		public function orderProduct($cusid){
			$sessionId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' ";
			$getPro = $this->db->select($query);
			if ($getPro) {
				while ($result = $getPro->fetch_assoc()) {
					$productId 		= $result['productId'];
					$productName 	= $result['productName'];
					$quantity 		= $result['quantity'];
					$price 			= $result['price'] * $quantity;
					$image 			= $result['image'];
					$insertQuery = "INSERT into tbl_order(cusid, productId, productName,  quantity, price, 				image) 		  	
									VALUES 
		    				('$cusid', '$productId', '$productName',  '$quantity', '$price', '$image')";

					$insertOrder = $this->db->insert($insertQuery);

					
				}
			}
		}

		public function payableAmount($cusid){
			$query = "SELECT price FROM tbl_order WHERE cusId = '$cusid' AND date = now()";
			$result = $this->db->select($query);
			return $result;
		}

		public function getOrderProduct($cusid){
			$query = "SELECT * FROM tbl_order WHERE cusId = '$cusid' ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function checkOrder($cusid){
			
			$query = "SELECT * FROM tbl_order WHERE cusId = '$cusid' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getAllOrderProduct(){
			$query = "SELECT * FROM tbl_order ORDER BY date DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function productShipped($id, $date, $price){
			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET status = '1' WHERE cusId = '$id' AND date = '$date' AND price = '$price' ";
				$catUpdate = $this->db->update($query);
				if ($catUpdate) {
					$msg = "<span class='success'>Updated successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Not updated!</span>";
					return $msg;
				}
		}
		public function delProductShipped($id, $date, $price){
			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);

			$query = "DELETE FROM tbl_order WHERE cusId = '$id' AND date = '$date' AND price = '$price' ";
			$deldata = $this->db->delete($query);
			if ($deldata) {
					$msg = "<span class='success'>Deleted successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Not deleted!</span>";
					return $msg;
				}
		}

		public function productShippedConfirm($id, $date, $price){
			$id 		= mysqli_real_escape_string($this->db->link, $id);
			$date 		= mysqli_real_escape_string($this->db->link, $date);
			$price 		= mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE tbl_order SET status = '2' WHERE cusId = '$id' AND date = '$date' AND price = '$price' ";
				$catUpdate = $this->db->update($query);
				if ($catUpdate) {
					$msg = "<span class='success'>Updated successfully</span>";
					return $msg;
				} else {
					$msg = "<span class='error'>Not updated!</span>";
					return $msg;
				}
		}

	}
?>