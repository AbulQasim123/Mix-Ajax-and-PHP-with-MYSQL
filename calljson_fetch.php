<?php
	if (isset($_POST['id'])) {
		include 'connect.php';
		$query = "SELECT * FROM insert_modal where Id = '".$_POST['id']."' ";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_array($result)) {
			$data['name'] = $row['Name'];
			$data['address'] = $row['Address'];
			$data['gender'] = $row['Gender'];
			$data['designation'] = $row['Designation'];
			$data['age'] = $row['Age'];
			
		}
		echo json_encode($data);
	}
?>