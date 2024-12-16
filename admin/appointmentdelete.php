<?php
include("config.php");

$aid = $_GET['id'];
$sql = "DELETE FROM appointments WHERE id = {$aid}";
$result = mysqli_query($con, $sql);

if($result == true) {
    $msg = "<p class='alert alert-success'>Appointment Deleted</p>";
    header("Location:appointmentview.php?msg=$msg");
} else {
    $msg = "<p class='alert alert-warning'>Appointment Not Deleted</p>";
    header("Location:appointmentview.php?msg=$msg");
}

mysqli_close($con);
?>