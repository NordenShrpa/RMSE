<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include("config.php");

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        // Add appointment
        $date = $_POST['date'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        $user_id = $_SESSION['user_id'];
        mysqli_query($con, "INSERT INTO appointments (user_id, date, time, description) VALUES ('$user_id', '$date', '$time', '$description')");
    } elseif (isset($_POST['edit'])) {
        // Edit appointment
        $id = $_POST['id'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $description = $_POST['description'];
        mysqli_query($con, "UPDATE appointments SET date='$date', time='$time', description='$description' WHERE id='$id' AND user_id='{$_SESSION['user_id']}'");
    } elseif (isset($_POST['delete'])) {
        // Delete appointment
        $id = $_POST['id'];
        mysqli_query($con, "DELETE FROM appointments WHERE id='$id' AND user_id='{$_SESSION['user_id']}'");
    }
}

// Fetch appointments
$user_id = $_SESSION['user_id'];
$appointments = mysqli_query($con, "SELECT * FROM appointments WHERE user_id='$user_id'");
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
<meta name="description" content="Homex template">
<meta name="keywords" content="">
<meta name="author" content="Unicoder">
<link rel="shortcut icon" href="images/favicon.ico">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

<!-- CSS Link -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="css/layerslider.css">
<link rel="stylesheet" type="text/css" href="css/color.css" id="color-change">
<link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<!-- Title -->
<title>Homex - Real Estate Template</title>
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
                        <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>Manage Appointments</b></h2>
                    </div>
                    <div class="col-md-6">
                        <nav aria-label="breadcrumb" class="float-left float-md-right">
                            <ol class="breadcrumb bg-transparent m-0 p-0">
                                <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manage Appointments</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner -->
        
        <!-- Appointment Management -->
        <div class="full-row">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="double-down-line-left text-secondary position-relative pb-4 my-4">Add/Edit Appointment</h4>
                                <form method="POST" class="mb-5">
                                    <input type="hidden" name="id" id="appointment-id">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="time">Time</label>
<div class="container">
    <h1 class="mt-5">Manage Appointments</h1>
    <form method="POST" class="mb-5">
        <input type="hidden" name="id" id="appointment-id">
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" class="form-control" name="date" id="date" required>
        </div>
        <div class="form-group">
            <label for="time">Time</label>
            <input type="time" class="form-control" name="time" id="time" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" required></textarea>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Add Appointment</button>
        <button type="submit" name="edit" class="btn btn-warning">Edit Appointment</button>
    </form>
    <h2>Your Appointments</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($appointments)) { ?>
                <tr>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td>
                        <button class="btn btn-info" onclick="editAppointment(<?php echo $row['id']; ?>, '<?php echo $row['date']; ?>', '<?php echo $row['time']; ?>', '<?php echo $row['description']; ?>')">Edit</button>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script>
function editAppointment(id, date, time, description) {
    document.getElementById('appointment-id').value = id;
    document.getElementById('date').value = date;
    document.getElementById('time').value = time;
    document.getElementById('description').value = description;
}
</script>
<?php include("footer.php"); ?>
