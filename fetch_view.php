<?php
	if (isset($_POST['employee_id'])) {
		include 'connect.php';
		$output = "";
		$fetch_query = "select * from insert_modal where Id = '".$_POST['employee_id']."' ";
		$fetch_result = mysqli_query($conn,$fetch_query);
		$output.= '<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm">';
				while ($fetch_row = mysqli_fetch_array($fetch_result)) {
					$output.= '<tr>
						<th><label>Name</label></th>
						<td>'.$fetch_row["Name"].'</td>
					</tr>
					<tr>
						<th><label>Address</label></th>
						<td>'.$fetch_row["Address"].'</td>
					</tr>
					</tr>
						<th><label>Gender</lable></th>
						<td>'.$fetch_row["Gender"].'</td>
					</tr>
					</tr>
						<th><label>Age</lable></th>
						<td>'.$fetch_row["Age"].'</td>
					</tr>
					<tr>
						<th><label>Designation</lable></th>
						<td>'.$fetch_row["Designation"].'</td>
					</tr>';
				}
			$output.= '</table></div>';
			echo $output;
	}
?>