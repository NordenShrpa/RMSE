<?php
session_start();
require("config.php");

if(!isset($_SESSION['auser'])) {
    header("location:index.php");
}

$error = "";
$msg = "";

if(isset($_POST['add'])) {
    $user_id = $_POST['user_id'];
    $admin_id = $_POST['admin_id'];
    $property_id = $_POST['property_id'];
    $appointment_time = $_POST['appointment_time'];
    $status = $_POST['status'];

    // Ensure these column names match your database table
    $sql = "INSERT INTO appointments (user_id, admin_id, property_id, appointment_time, status) VALUES ('$user_id', '$admin_id', '$property_id', '$appointment_time', '$status')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $msg = "<p class='alert alert-success'>Appointment Added Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Appointment Not Added. Some Error Occurred</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>LM HOMES | Add Appointment</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    
    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="assets/css/feathericon.min.css">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include("header.php"); ?>
    <!-- /Header -->
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Add Appointment</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Appointment</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Appointment Details</h4>
                        </div>
                        <form method="post">
                            <div class="card-body">
                                <?php echo $error; ?>
                                <?php echo $msg; ?>
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">User ID</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="user_id" required>
                                            <option value="">Select User</option>
                                            <?php
                                            $user_query = mysqli_query($con, "SELECT uid, uname FROM user");
                                            while($user_row = mysqli_fetch_assoc($user_query)) {
                                                echo "<option value='".$user_row['uid']."'>".$user_row['uname']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Admin ID</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="admin_id" required>
                                            <option value="">Select Admin</option>
                                            <?php
                                            $admin_query = mysqli_query($con, "SELECT aid, auser FROM admin");
                                            while($admin_row = mysqli_fetch_assoc($admin_query)) {
                                                echo "<option value='".$admin_row['aid']."'>".$admin_row['auser']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Property ID</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="property_id" required>
                                            <option value="">Select Property</option>
                                            <?php
                                            $property_query = mysqli_query($con, "SELECT pid, title FROM property");
                                            while($property_row = mysqli_fetch_assoc($property_query)) {
                                                echo "<option value='".$property_row['pid']."'>".$property_row['title']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Appointment Time</label>
                                    <div class="col-lg-9">
                                        <input type="datetime-local" class="form-control" name="appointment_time" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Status</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="status" required>
                                            <option value="">Select Status</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Complete">Complete</option>
                                            <option value="Canceled">Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <input type="submit" value="Submit" class="btn btn-primary" name="add" style="margin-left:200px;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>          
    </div>
    <!-- /Page Wrapper -->

    <!-- jQuery -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
    <!-- Slimscroll JS -->
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>