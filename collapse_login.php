<?php
	session_start();
	include('connect.php');
	if ($_POST['collapse_username'] && $_POST['collapse_password']) {
		$collapse_query = "select * from admin_login where Admin_name = '".$_POST['collapse_username']."' AND Admin_password = '".$_POST['collapse_password']."' ";
		$collapse_result = mysqli_query($conn,$collapse_query);
		if (mysqli_num_rows($collapse_result)) {
			$_SESSION['collase_username'] = $_POST['collapse_username'];
			echo "Yes";
		}else{
			echo "No";
		}
	}

	if (isset($_POST['action'])) {
		unset($_SESSION['collase_username']);
	}
?>