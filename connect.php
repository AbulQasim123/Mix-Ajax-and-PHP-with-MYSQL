<?php
    $server_name = "localhost";
    $user_name = "root";
    $pass_word = "";
    $db_name = "php_project";

        // Create connection
    $conn = mysqli_connect($server_name, $user_name, $pass_word, $db_name);

        // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>