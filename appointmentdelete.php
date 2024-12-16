<<<<<<< HEAD
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
=======
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
>>>>>>> 256ef260f70f7486ad7b00e75238722238e2a6e5
