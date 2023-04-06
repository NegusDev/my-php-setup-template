<?php 
	session_start();

	function isLoggedIn() {
		if (isset($_SESSION['user_id'])) {
			return true;
		}else {
			header("location:/");
			exit();
		}

		if (isset($_SESSION['username'])) {
			return true;
		}else {
			header("location:/");
			return false;
		}
		
	}