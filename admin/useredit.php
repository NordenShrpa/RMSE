<?php
session_start();
require("config.php");

if(!isset($_SESSION['auser'])) {
    header("location:index.php");
    exit();
}

$error = "";
$msg = "";

if(isset($_POST['update'])) {
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $uemail = $_POST['uemail'];
    $upass = $_POST['upass'];
    $uphone = $_POST['uphone'];
    $utype = $_POST['utype'];

    // Handle file upload
    $uimage = $_FILES['uimage']['name'];
    $uimage_tmp = $_FILES['uimage']['tmp_name'];
    $uimage_folder = "user/";

    if($uimage) {
        move_uploaded_file($uimage_tmp, $uimage_folder . $uimage);
        $sql = "UPDATE user SET uname=?, uemail=?, upass=?, uphone=?, utype=?, uimage=? WHERE uid=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssi", $uname, $uemail, $upass, $uphone, $utype, $uimage, $uid);
    } else {
        $sql = "UPDATE user SET uname=?, uemail=?, upass=?, uphone=?, utype=? WHERE uid=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $uname, $uemail, $upass, $uphone, $utype, $uid);
    }

    if(mysqli_stmt_execute($stmt)) {
        $msg = "<p class='alert alert-success'>User Updated Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>User Not Updated. Some Error Occurred</p>";
    }
    mysqli_stmt_close($stmt);
}

$uid = $_GET['id'];
$query = mysqli_prepare($con, "SELECT * FROM user WHERE uid=?");
mysqli_stmt_bind_param($query, "i", $uid);
mysqli_stmt_execute($query);
$result = mysqli_stmt_get_result($query);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>LM Homes | Edit User</title>
    
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
                        <h3 class="page-title">Edit User</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit User Details</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php echo $error; ?>
                                <?php echo $msg; ?>
                                
                                <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">User Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="uname" value="<?php echo $row['uname']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Email</label>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control" name="uemail" value="<?php echo $row['uemail']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Password</label>
                                    <div class="col-lg-9">
                                        <input type="password" class="form-control" name="upass" value="<?php echo $row['upass']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Phone</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="uphone" value="<?php echo $row['uphone']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">User Type</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="utype" value="<?php echo $row['utype']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Image</label>
                                    <div class="col-lg-9">
                                        <input type="file" class="form-control" name="uimage">
                                        <img src="user/<?php echo $row['uimage']; ?>" height="50px" width="50px">
                                    </div>
                                </div>
                                
                                <input type="submit" value="Update" class="btn btn-primary" name="update" style="margin-left:200px;">
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