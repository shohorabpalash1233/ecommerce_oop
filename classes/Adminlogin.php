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
	}
?>