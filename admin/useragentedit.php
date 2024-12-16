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
    $aid = $_POST['aid'];
    $aname = $_POST['aname'];
    $aemail = $_POST['aemail'];
    $aphone = $_POST['aphone'];
    $utype = $_POST['utype'];

    // Handle file upload
    $aimage = $_FILES['aimage']['name'];
    $aimage_tmp = $_FILES['aimage']['tmp_name'];
    $aimage_folder = "agent/";

    if($aimage) {
        move_uploaded_file($aimage_tmp, $aimage_folder . $aimage);
        $sql = "UPDATE agent SET aname=?, aemail=?, aphone=?, utype=?, aimage=? WHERE aid=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssssi", $aname, $aemail, $aphone, $utype, $aimage, $aid);
    } else {
        $sql = "UPDATE agent SET aname=?, aemail=?, aphone=?, utype=? WHERE aid=?";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $aname, $aemail, $aphone, $utype, $aid);
    }

    if(mysqli_stmt_execute($stmt)) {
        $msg = "<p class='alert alert-success'>Agent Updated Successfully</p>";
    } else {
        $error = "<p class='alert alert-warning'>Agent Not Updated. Some Error Occurred</p>";
    }
    mysqli_stmt_close($stmt);
}

$aid = $_GET['id'];
$query = mysqli_prepare($con, "SELECT * FROM agent WHERE aid=?");
mysqli_stmt_bind_param($query, "i", $aid);
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
    <title>LM Homes | Edit Agent</title>
    
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
                        <h3 class="page-title">Edit Agent</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Agent</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Agent Details</h4>
                        </div>
                        <form method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php echo $error; ?>
                                <?php echo $msg; ?>
                                
                                <input type="hidden" name="aid" value="<?php echo $row['aid']; ?>">
                                
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Agent Name</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="aname" value="<?php echo $row['aname']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Email</label>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control" name="aemail" value="<?php echo $row['aemail']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Phone</label>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" name="aphone" value="<?php echo $row['aphone']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">User Type</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="utype" required>
                                            <option value="">Select User Type</option>
                                            <option value="user" <?php if($row['utype']=="user"){echo "selected";} ?>>User</option>
                                            <option value="agent" <?php if($row['utype']=="agent"){echo "selected";} ?>>Agent</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Image</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="aimage" type="file">
                                        <img src="agent/<?php echo $row['aimage']; ?>" alt="Agent Image" width="100" height="100">
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
