<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Fetch for edit
        include('connect.php');
        if (isset($_POST['employee_id'])) {
            $id = $_POST['employee_id'];
            $query = "select * from insert_modal where Id = '$id' ";
            $result = mysqli_query($conn,$query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                echo json_encode($row);
            }
        }
    }
?>