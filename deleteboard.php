<?php
//including the database connection file
include("process/dbh.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from tables
$result = mysqli_query($conn, "DELETE FROM `boards` WHERE id=$id");
$sql="Delete from `outputs` where id in ( Select outputid FROM `boards_outputs` bo join `outputs` o ON bo.outputid=o.id WHERE boardid=$id )";
$result = mysqli_query($conn,$sql );
$result = mysqli_query($conn, "DELETE FROM `boards_outputs` WHERE boardid=$id");
$result = mysqli_query($conn, "DELETE from `boards_rooms` WHERE boardid=$id");

//redirecting to the display page (index.php in our case)
header("Location:viewboard.php");
?>

