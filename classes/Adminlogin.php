<?php
	include '../lib/Session.php';
	Session::checkSession();
	include '../lib/Database.php';
	include '../helpers/Format.php';
?>
<?php

	class Adminlogin
	{
		private $db;
		private $fm;

		
		public function __construct(argument)
		{
			$this->$db = new Database();
			$this->$fm = new Format();
		}

		public function adminLogin($adminUser, $adminPass){
			$adminUser = $this->$fm->validation($adminUser);
			$adminPass = $this->$fm->validation($adminPass);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminUser) || empty($adminPass)) {
				$loginmsg = "Username or Password must not be empty";
				return $loginmsg;
			} else {
				$query = "";
			}
		}
	}
?>