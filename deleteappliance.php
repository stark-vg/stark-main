<?php
//including the database connection file
include("process/dbh.php");

//getting id of the data from url
$id = $_GET['id'];

//deleting the row from outputs table
$result = mysqli_query($conn, "DELETE FROM outputs WHERE id=$id");
$result = mysqli_query($conn, "DELETE FROM boards_outputs WHERE id=$id");

//redirecting to the display page (index.php in our case)
header("Location:aloginwel.php");
?>

