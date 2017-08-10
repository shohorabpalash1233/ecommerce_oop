<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>
<?php
	/**
	* 
	*/
	class Customer
	{
		private $db;
		private $fm;

		
		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function customerRegistration($data){
			$name 		= $this->fm->validation($data['name']);
			$address 	= $this->fm->validation($data['address']);
			$city 		= $this->fm->validation($data['city']);
			$country 	= $this->fm->validation($data['country']);
			$zip 		= $this->fm->validation($data['zip']);
			$phone 		= $this->fm->validation($data['phone']);
			$email 		= $this->fm->validation($data['email']);
			$password 	= $this->fm->validation($data['password']);

			$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
			$address 	= mysqli_real_escape_string($this->db->link, $data['address']);
			$city 		= mysqli_real_escape_string($this->db->link, $data['city']);
			$country 	= mysqli_real_escape_string($this->db->link, $data['country']);
			$zip 		= mysqli_real_escape_string($this->db->link, $data['zip']);
			$phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
			$email 		= mysqli_real_escape_string($this->db->link, $data['email']);
			$password 	= mysqli_real_escape_string($this->db->link, md5($data['password']));

			if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $password == "") {

		    	$msg = "<span class='error'>Fields Must Not Be Empty</span>";
				return $msg;

		    	}

		    	$mailQuery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
		    	$mailCheck = $this->db->select($mailQuery);
		    	if ($mailCheck != false) {
		    		$msg = "<span class='error'>Email Already Exists!</span>";
					return $msg;
		    	}else{
		    		$query = "INSERT into tbl_customer(name, address, city, country, zip, phone, email, password) 		  
		    		VALUES 
			    	('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password')";

					$customerIns = $this->db->insert($query);

					if ($customerIns) {
						$msg = "<span class='success'>Customer Data inserted successfully</span>";
						return $msg;
					} else {
						$msg = "<span class='error'>Customer Data not inserted!</span>";
						return $msg;
					}
		    }
		}
		public function customerLogin($data){
			$email 		= $this->fm->validation($data['email']);
			$password 	= $this->fm->validation($data['password']);

			$email 		= mysqli_real_escape_string($this->db->link, $data['email']);
			$password 	= mysqli_real_escape_string($this->db->link, md5($data['password']));

			if (empty($email) || empty($password)) {
				$msg = "<span class='error'>Field must not be empty</span>";
				return $msg;
			}

			$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND password = '$password' ";
			$result = $this->db->select($query);

			if ($result != false) {
				$value = $result->fetch_assoc();
				Session::set("cuslogin", true);
				Session::set("cusid", $value['id']);
				Session::set("cusname", $value['name']);
				header("Location: cart.php");
			} else {
				$msg = "<span class='error'>Email and Password Not Matched</span>";
				return $msg;
			}
		}

		public function getCustomerData($id){
			$query = "SELECT * FROM tbl_customer WHERE id = '$id' ";
			$result = $this->db->select($query);
			return $result;	
		}
	}
?>