<?php
	session_start();
	include 'connect.php';

	if (isset($_POST['modal_username']) && $_POST['modal_password']) {
		$login_query = "select * from admin_login where Admin_name = '".$_POST['modal_username']."' AND Admin_password = '".$_POST['modal_password']."' ";
		$login_result = mysqli_query($conn,$login_query);
		if (mysqli_num_rows($login_result) > 0){
			$_SESSION['user_name'] = $_POST['modal_username'];
			echo "Yes";
		}else{
			echo "No";
		}
	}

	if (isset($_POST['action'])) {
		unset($_SESSION['user_name']);
	}
?>