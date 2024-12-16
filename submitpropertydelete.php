<<<<<<< HEAD
<?php
include("config.php");
$pid = $_GET['id'];
$sql = "DELETE FROM property WHERE pid = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Property Deleted</p>";
	header("Location:feature.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>Property Not Deleted</p>";
	header("Location:feature.php?msg=$msg");
}
mysqli_close($con);
=======
<?php
include("config.php");
$pid = $_GET['id'];
$sql = "DELETE FROM property WHERE pid = {$pid}";
$result = mysqli_query($con, $sql);
if($result == true)
{
	$msg="<p class='alert alert-success'>Property Deleted</p>";
	header("Location:feature.php?msg=$msg");
}
else{
	$msg="<p class='alert alert-warning'>Property Not Deleted</p>";
	header("Location:feature.php?msg=$msg");
}
mysqli_close($con);
>>>>>>> 256ef260f70f7486ad7b00e75238722238e2a6e5
?>