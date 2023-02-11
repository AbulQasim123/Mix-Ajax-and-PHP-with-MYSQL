<?php
    session_start();    
    include('connect.php');
    include('script.php');
    // echo phpversion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="jquery\jquery.js"></script>
    <script type="text/javascript" src="bootstrap-4.0.0-dist\js\bootstrap.js"></script>
    <link rel="stylesheet" href="bootstrap-4.0.0-dist\css\bootstrap.css">
    <link rel="stylesheet" type="text/css" href="font-awesome\css\font-awesome.css">
    <title>Weblesson Practical</title>
    <style>
        .error_field{
            color: red;
        }
        .cv-boxes-version{
            float:left;
            width:180px;
            height:180px;
            margin:30px;
            background: transparent;
            display: table;
            border:1px solid black;
            border-radius: 180px;/*5px 0 0 5px;*/
            /*position:absolute;
            top: 50%;*/
            transform: translateY(-15px);
        }

        .version-name{
            vertical-align:middle;
            display:table-cell;
            padding: 20px;
            font-size: 16px;
            text-align: center;
            color:var(--primary-color);
        }
        span.version-no{
            font-size:24px;
            font-weight:600;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- PHP Ajax insert data in mysql by using Bootstrap Modal -->
        <h5><q>PHP Ajax insert data in mysql by using Bootstrap Modal</q></h5>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <div align="right">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add_data_modal">Add</button>
                    </div>
                    <?php
                        $modal_sql = "select * from insert_modal order by Id asc";
                        $modal_result = mysqli_query($conn,$modal_sql);
                    ?>
                    <div id="employee_data" class="my-1">
                        <table class="table table-bordered table-hover table-sm">
                            <tr class="thead-dark text-center">
                                <th>Employee Name</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php
                                if (mysqli_num_rows($modal_result) > 0) {
                                    while ($modal_row = mysqli_fetch_array($modal_result)) {
                            ?>
                            <tr class="text-center">
                                <td><?php echo $modal_row['Name'] ?></td>
                                <td><button type="button" class="btn btn-info btn-sm view_modal" name="view" id="<?php echo $modal_row["Id"] ?>">View</button></td>
                                <td><button type="button" class="btn btn-warning btn-sm edit_modal icon-edit" name="view" id="<?php echo $modal_row["Id"] ?>"></button></td>
                                <td><button type="button" class="btn btn-danger btn-sm delete_modal icon-remove" name="view" id="<?php echo $modal_row["Id"] ?>"></button></td>
                            </tr>
                            <?php }}else{?>
                                <tr><td style="font-size: 20px;">Data not found.</td></tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div id="add_data_modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Insert data through modal</h5>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="insert_form">
                                    <div class="form-group">
                                        <label for="modal_name" style="font-size:17px;">Enter employee name <span style="color:red;">*</span> </label>
                                        <div id="modal_name_err" class="error_field"></div>
                                        <input type="text" name="modal_name" id="modal_name" class="form-control" placeholder="Employee name">
                                    </div>
                                    <div class="form-group">
                                        <label for="modal_address" style="font-size:17px;">Enter employee address <span style="color:red;">*</span> </label>
                                        <div id="modal_address_err" class="error_field"></div>
                                        <input type="text" name="modal_address" id="modal_address" class="form-control" placeholder="Employee address">
                                    </div>
                                    <div class="form-group">
                                        <label for="modal_gender" style="font-size:17px;">Select employee gender <span style="color:red;">*</span> </label>
                                        <div id="modal_gender_err" class="error_field"></div>
                                        <select name="modal_gender" id="modal_gender" class="form-control">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="modal_designation" style="font-size:17px;">Enter employee designation <span style="color:red;">*</span> </label>
                                        <div id="modal_designation_err" class="error_field"></div>
                                        <input type="text" name="modal_designation" id="modal_designation" class="form-control" placeholder="Enter designation">
                                    </div>
                                    <div class="form-group">
                                        <label for="modal_age" style="font-size:17px;">Enter employee age <span style="color:red;">*</span> </label>
                                        <div id="modal_age_err" class="error_field"></div>
                                        <input type="text" name="modal_age" id="modal_age" class="form-control" placeholder="Enter age">
                                    </div>
                                    <div align="center" class="form-group my-2">
                                        <input type="submit" value="Save" name="insert" id="insert" class="btn btn-primary btn-sm">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data_modal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Employee Detail</h5>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="employee_details"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Make login form by using bootstrap modal with php ajax jquery -->
            <h5><q>Make login form by using bootstrap modal with php ajax jquery</q></h5>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if(isset($_SESSION['user_name'])) {
                ?>
                <div class="bg-secondary p-2" align="center">
                    <h2>Welcome - <?php echo $_SESSION['user_name']; ?></h2>
                    <a href="" class="btn btn-danger btn-sm" id="modal_logout">Logout</a>
                </div>
                <?php }else{ ?>
                <div align="right">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#login_modal">Login</button>
                </div>
                <?php } ?>
                <div id="login_modal" class="modal fade" role="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Login</h5>
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="modal_username">Username</label>
                                    <input type="text" name="modal_username" id="modal_username" class="form-control" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <label for="modal_username">Password</label>
                                    <input type="text" name="modal_password" id="modal_password" class="form-control" placeholder="Password">
                                </div>
                                <div>
                                    <button type="button" id="login_btn" name="login_btn" class="btn btn-info btn-sm">Login</button>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Make login form by using Bootstrap collapse with php ajax and jquery -->
        <h5><q>Make login form by using Bootstrap collapse with php ajax and jquery.</q></h5>
        <div class="row">
            <div class="col-lg-12" align="center">
                <?php
                    if (isset($_SESSION['collase_username'])) {
                ?>
                <div class="bg-info p-2" align="center">
                    <h2>Welcome - <?php echo $_SESSION['collase_username']; ?></h2>
                    <a href="" class="btn btn-danger btn-sm" id="collapse">Logout</a>
                </div>
                <?php }else{  ?>
                <div id="main_collapse">
                    <div class="" align="center">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="collapse" data-target="#login_collapse">Login</button>
                    </div>
                    <div id="login_collapse" class="collapse" style="width: 700px; border: 1px solid #ccc; background: #e1e1e1; margin-top: 16px;">
                        <h2>Login</h2>
                        <div class="form-group">
                            <label for="collapse_username">Username</label>
                            <input type="text" name="collapse_username" id="collapse_username" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="collapse_password">Password</label>
                            <input type="text" name="collapse_password" id="collapse_password" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info btn-sm" id="collapse_login" name="collapse_login">Login</button>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
            <!-- PHP make accordian by using bootstrap collapse and with php script -->
        <h5><q>Php make accordian by using bootstrap collapse and with php script.</q></h5>
        <?php
            $accord_query = "select * from accordian_tbl order by post_title desc";
            $accord_result = mysqli_query($conn,$accord_query);
        ?>
        <div class="row">
            <div class="col-lg-12" align="center">
                <?php while ($accord_rows = mysqli_fetch_assoc($accord_result)) { ?>
                <div id="accord_posts" style="width: 800px;">
                    <div class="card">
                        <div class="card-header">
                            <a class="card-link text-secondary font-weight-bold" data-toggle="collapse" href="#<?php echo $accord_rows['post_id'] ?>">
                                <?php echo $accord_rows['post_title'] ?>
                            </a>
                        </div>
                        <div id="<?php echo $accord_rows['post_id'] ?>" class="collapse" data-parent="#accord_posts">
                            <div class="card-body font-italic" style="font-size: 17px; text-align:justify">
                                <?php echo $accord_rows['post_desc'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
            <!-- Dynamic menu with dynamic content in php using ajax jquery -->
        <h5><q>Dynamic menu with Dynamic content in php using ajax jquery.</q></h5>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- link -->
            <?php
                $dynamic_query = "select * from accordian_tbl";
                $dynamic_result = mysqli_query($conn,$dynamic_query);
            ?>
            <ul class="nav navbar-nav">
                <li class="nav-item active">
                    <a href="javascript:void(0)" class="nav-link">Weblesson tutorial</a>
                </li>
                <?php
                    while($menu_row = mysqli_fetch_array($dynamic_result))
                    {
                        echo '<li class="nav-item" id="'.$menu_row["post_id"].'"><a href="javascript:void(0)" class="nav-link">'.$menu_row["post_title"].'</a></li>';
                    }
                ?>
            </ul>
        </nav>
        <span id="page_details"></span>
    </div>

        <!-- Multiple inline insert into mysql using ajax jquey in php -->
    <h5 align="center" class="p-4"><q>Multiple inline insert into mysql using ajax jquery in php.</q></h5>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm" id="crud_table">
                        <tr class="thead-dark">
                            <th width="30%">Item name</th>
                            <th width="45%">Item description</th>
                            <th width="10%">Item price</th>
                            <th width="5%"></th>
                        </tr>
                        <tr>
                            <td contenteditable="true" class="item_name"></td>
                            <td contenteditable="true" class="item_desc"></td>
                            <td contenteditable="true" class="item_price"></td>
                            <td></td>
                        </tr>
                    </table>
                    <div id="alert_msg" class="text-success text-center font-italic" style="font-size:20px"></div>
                    <div align="right">
                        <button type="button" id="Add" name="Add" class="btn btn-primary btn-sm">+</button>
                    </div>
                    <div align="right" class="my-2">
                        <button type="button" id="save" name="save" class="btn btn-primary btn-sm">Save</button>
                    </div>

                    <div id="inserted_data_item"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- Jquery ajax call to php script with json return -->
        <h5><q>Jquery ajax call to php script with json return.</q></h5>
        <div class="row">
            <div class="col-lg-6">
                <?php
                    $calljson_query = "select * from insert_modal order by name asc";
                    $calljson_result = mysqli_query($conn,$calljson_query);
                ?>
                <div class="form-group">
                    <select name="employee_list" id="employee_list" class="form-control">
                        <option value="">Select employee</option>
                        <?php
                            while ($row = mysqli_fetch_array($calljson_result)) {
                                echo '<option value="'.$row['Id'].'">'.$row['Name'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <p id="err_msg" class="text-danger font-italic" style="font-size: 19px;"></p>
                <div class="p-2">
                    <button type="button" id="search" name="search" class="btn btn-info btn-sm">Search</button>
                </div>
                <div class="table-responsive" id="emp_details" style="display: none;">
                    <table class="table table-hover table-bordered text-center">
                        <tr>
                            <th>Name</th>
                            <td class="text-primary" style="font-size: 17px;"><span id="emp_name"></span></td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td class="text-primary" style="font-size: 17px;"><span id="emp_address"></span></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td class="text-primary" style="font-size: 17px;"><span id="emp_gender"></span></td>
                        </tr>
                        <tr>
                            <th>Designation</th>
                            <td class="text-primary" style="font-size: 17px;"><span id="emp_designation"></span></td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td class="text-primary" style="font-size: 17px;"><span id="emp_age"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-lg-6">
                <h5><q>Json data to html table using ajax jquery getJSON method.</q></h5>
                <!-- json data to html table using ajax jquery getJSON method. -->
                <div class="table-responsive">
                    <table id="employee_table" class="table table-bordered table-striped table-sm text-center">
                        <tr class="thead-secondary">
                            <th>Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Designation</th>
                            <th>Age</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="width: 700px">
        <h5>PHP Login registration form with md5 password encryption.</h5>
        <div class="row">
            <div class="col-lg-12">
                <?php
                    if (isset($_GET['action']) == "login_pro") {
                ?>
                <h4 align="center">Login</h4>
                <form method="post">
                    <div class="form-group">
                        <label for="encrypt_user">Username</label>
                        <input type="text" name="encrypt_user" id="encrypt_user" class="form-control" placeholder="Username">
                        <label for="encrypt_pass">Password</label>
                        <input type="text" name="encrypt_pass" id="encrypt_pass" class="form-control" placeholder="Password">
                        <button type="submit" class="btn btn-primary my-3 btn-sm" name="login" id="login">Login</button>
                        <p align="center"><a href="index.php" class="btn btn-warning btn-sm">Register</a></p>
                    </div>
                </form>
                <?php
                    }else{
                ?>
                <h4 align="center">Register</h4>
                <form method="post">
                    <div class="form-group">
                        <label class="encrypt_username">Username</label>
                        <input type="text" name="encrypt_username" id="encrypt_username" class="form-control" placeholder="Username">
                        <label class="encrypt_password">Password</label>
                        <input type="text" name="encrypt_password" id="encrypt_password" class="form-control" placeholder="Password">
                        <label class="encrypt_conpassword">Confirm Password</label>
                        <input type="text" name="encrypt_conpassword" id="encrypt_conpassword" class="form-control" placeholder="Confirm Password">
                        <button type="submit" class="btn btn-primary my-3 btn-sm" name="register" id="register">Register</button>
                        <p align="center"><a href="index.php?action=login_pro" class="btn btn-info btn-sm">Login</a></p>
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="container-fluid">
            <!-- Load content while scrolling with jquery ajax and php -->
            <h5><q>Load content while scrolling with jquery ajax and php.</q></h5>
        <div class="row">
            <div class="col-lg-12">
                <h3>Auto load more data on page scroll.</h3>
                <div id="load_data"></div>
                <div id="load_data_message"></div>
            </div>
        </div>
    </div>
    <div class="cv-boxes-version">
        <div class="version-name">CODEIGNITER <br />
            <span class="version-no">3</span>
        </div>
    </div><!--cv-boxes-version ende-->
</body>
</html>



