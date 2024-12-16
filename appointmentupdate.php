<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");
if(!isset($_SESSION['uemail']))
{
    header("location:login.php");
}

$error = "";
$msg = "";
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $status = $_POST['status'];

    $sql = "UPDATE appointments SET title='$title', description='$description', date='$date', time='$time', status='$status' WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if($result)
    {
        $msg = "<p class='alert alert-success'>Appointment Updated Successfully</p>";
    }
    else
    {
        $error = "<p class='alert alert-warning'>Appointment Not Updated. Some Error Occurred</p>";
    }
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointments WHERE id='$id'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
    }
    else
    {
        header("Location: viewappointments.php");
    }
}
else
{
    header("Location: viewappointments.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/favicon.ico">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!-- CSS Link -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Title -->
    <title>RealEstate - Update Appointment</title>
</head>
<body>
<div id="page-wrapper">
    <div class="row"> 
        <!-- Header start -->
        <?php include("include/header.php");?>
        <!-- Header end -->
        
        <!-- Banner -->
        <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Update Appointment</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Update Appointment</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner -->
        
        <!-- Update appointment -->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="text-secondary double-down-line text-center">Update Appointment</h2>
                    </div>
                </div>
                <div class="row p-5 bg-white">
                    <form method="post">
                        <div class="description">
                            <h5 class="text-secondary">Appointment Information</h5><hr>
                            <?php echo $error; ?>
                            <?php echo $msg; ?>
                            
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">Title</label>
                                        <div class="col-lg-9">
                                            <input type="text" class="form-control" name="title" required value="<?php echo $row['title']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">Description</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" name="description" rows="5" required><?php echo $row['description']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">Date</label>
                                        <div class="col-lg-9">
                                            <input type="date" class="form-control" name="date" required value="<?php echo $row['date']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">Time</label>
                                        <div class="col-lg-9">
                                            <input type="time" class="form-control" name="time" required value="<?php echo $row['time']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label">Status</label>
                                        <div class="col-lg-9">
                                            <select class="form-control" required name="status">
                                                <option value="scheduled" <?php if($row['status'] == 'scheduled') echo 'selected'; ?>>Scheduled</option>
                                                <option value="completed" <?php if($row['status'] == 'completed') echo 'selected'; ?>>Completed</option>
                                                <option value="cancelled" <?php if($row['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" value="Update" class="btn btn-primary" name="update" style="margin-left:200px;">
                        </div>
                    </form>
                </div>            
            </div>
        </div>
        <!-- Update appointment -->
        
        <!-- Footer start -->
        <?php include("include/footer.php");?>
        <!-- Footer end -->
        
        <!-- Scroll to top --> 
        <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i class="fas fa-angle-up"></i></a> 
        <!-- End Scroll To top --> 
    </div>
</div>
<!-- Wrapper End --> 

<!-- Js Link -->
<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/custom.js"></script>
</body>
</html>
