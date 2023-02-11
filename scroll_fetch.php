<?php
	if (isset($_POST['limit'], $_POST['start'])) {
		include 'connect.php';
		$query = "SELECT * FROM item_table order by item_id desc limit ".$_POST['start'].", ".$_POST['limit']." ";
		$result = mysqli_query($conn, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			echo '<h5><b>Item name = </b>'.$row['item_name'].'</h5>
			<p><b>Item description  =</b> '.$row['item_description'].'</p>
			<p class="text-muted" align="right"><b>Item price = </b> Rs '.$row['item_price'].'</p><hr>';

		}
	}
	
?>