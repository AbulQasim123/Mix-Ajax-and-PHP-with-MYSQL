<?php
	if(isset($_POST["id"]))
	{
		include 'connect.php';
		$query = "SELECT * FROM accordian_tbl WHERE post_id = '".$_POST["id"]."'";
		$result = mysqli_query($conn, $query);
		$output = '';
		while($row = mysqli_fetch_array($result))
		{
		  	$output .= '<h2>'.$row["post_title"].'</h2>
		  	<p class="font-italic border p-4" style="box-shadow: rgb(15,5,10)10px 8px 6px; background: #eee; border-radius: 10px; color:black; text-shadow: 1px 1px 4px red; font-size:17px; ">'.$row["post_desc"].'</p>';
		}
		echo $output;
	}
?>
