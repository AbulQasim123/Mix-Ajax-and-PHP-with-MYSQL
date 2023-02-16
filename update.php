<?php
            // Edit Modal
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        include('connect.php');
        if (!empty($_POST)) {
            $output = "";
            $edit_id = mysqli_real_escape_string($conn,$_POST['edit_id']);

            $modal_name = mysqli_real_escape_string($conn,$_POST['edit_modal_name']);
            $modal_address = mysqli_real_escape_string($conn,$_POST['edit_modal_address']);
            $modal_gender = mysqli_real_escape_string($conn,$_POST['edit_modal_gender']);
            $modal_designation = mysqli_real_escape_string($conn,$_POST['edit_modal_designation']);
            $modal_age = mysqli_real_escape_string($conn,$_POST['edit_modal_age']);
            $insert_query = "update insert_modal set `Name` = '$modal_name',`Address` = '$modal_address',
            `Gender` = '$modal_gender',`Designation` = '$modal_designation',
            `Age` = '$modal_age' where `Id` = '$edit_id' ";
             
            if (mysqli_query($conn,$insert_query)) {
                $output.= '<div class="alert alert-success"><b>Data Updated</b><button class="close" data-dismiss="alert">&times;</button></div>';

                $select_query = "select * from insert_modal order by Id asc";
                $result = mysqli_query($conn,$select_query);
                $output.= '<div class="table-responsive"><table class="table table-bordered table-hover table-sm">
                    <tr class="thead-dark text-center">
                        <th>Employee Name</th>
                        <th>view</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>';
                while ($row = mysqli_fetch_array($result)) {
                    $output.= '<tr class="text-center">
                        <td>'.$row['Name'].'</td>
                        <td><button type="button" class="btn btn-info btn-sm view_modal" id="'.$row['Id'].'">View</button></td>
                        <td><button type="button" class="btn btn-warning btn-sm edit_modal icon-edit" name="view" id="'.$row['Id'].'"></button></td>
                        <td><button type="button" class="btn btn-danger btn-sm delete_modal icon-remove" name="view" id="'.$row['Id'].'"></button></td>
                    </tr>';
                }
                $output.= '</table></div>';
            }
            echo $output;
        }
    }
?>