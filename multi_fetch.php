<?php
	include 'connect.php';
	$output = "";
	$query = "SELECT * FROM item_table order by item_id desc";
	$result = mysqli_query($conn, $query);
	$output.= '<h3 align="center">Item data</h3>
				<table class="table table-bordered table-hover table-sm">
					<tr class="thead-dark">
						<th>Item name</th>
						<th>Item description</th>
						<th>Item price</th>
					</tr>';
				while ($row = mysqli_fetch_array($result)) {
						$output.= '<tr>
							<td>'.$row["item_name"].'</td>
							<td>'.$row["item_description"].'</td>
							<td>'.$row["item_price"].'</td>
						</tr>';
				}
	$output.= '</table>';
	echo $output;
?>