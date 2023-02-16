<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connect.php');
        if (isset($_POST['employee_id'])) {
            $id = $_POST['employee_id'];
            $query = "Delete from insert_modal where Id = '$id' ";
            if (mysqli_query($conn,$query)) {
                $output= '<div class="alert alert-danger"><b>Data Deleted</b><button class="close" data- 
                dismiss="alert">&times;</button></div>';
            }
        }
        echo $output;
    }
?>