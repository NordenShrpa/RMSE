<?php
session_start();
include("config.php");
if(!isset($_SESSION['uemail']))
{
    header("location:login.php");
}

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $sql = "DELETE FROM appointments WHERE id = '$id'";
    $result = mysqli_query($con, $sql);
    if($result)
    {
        header("location:appointmentview.php?msg=Appointment Deleted Successfully");
    }
    else
    {
        header("location:appointmentview.php?msg=Appointment Not Deleted. Some Error Occurred");
    }
}
?>
