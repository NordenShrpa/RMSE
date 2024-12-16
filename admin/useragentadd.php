<?php
session_start();
require("config.php");

if(!isset($_SESSION['auser'])) {
    header("location:index.php");
    exit;
}

$error = "";
$msg = "";

if(isset($_POST['add'])) {
    $aname = $_POST['aname'];
    $aemail = $_POST['aemail'];
    $apassword = $_POST['apassword'];
    $aphone = $_POST['aphone'];
    $aimage = $_FILES['aimage']['name'];
    $atmp_name = $_FILES['aimage']['tmp_name'];
    $alocation = "agent/".$aimage;

    move_uploaded_file($atmp_name, $alocation);

    $sql = "INSERT INTO agent (aname, aemail, apassword, aphone, aimage, utype) VALUES ('$aname', '$aemail', '$apassword', '$aphone', '$aimage', 'agent')";
    $result = mysqli_query($con, $sql);

    if($result) {
        $msg = "<p class='alert alert-success'>Agent Added Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Agent Not Added. Some Error Occurred</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>LM Homes | Add Agent</title>
    
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
                        <h3 class="page-title">Add Agent</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Agent</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Agent Details</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php echo $error; ?>
                                <?php echo $msg; ?>
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Agent Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="aname" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Email</label>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control" name="aemail" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" name="apassword" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Phone</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="aphone" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="aimage" required>
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