<?php

require_once ('dbh.php');

$Name = $_POST['Name'];
$Desc = $_POST['Desc'];

$sql = "INSERT INTO `rooms`( `name`, `description`) VALUES ('$Name','$Desc')";
$result = mysqli_query($conn, $sql);
if (mysqli_errno($conn) == 1062) {
    //echo("Error description: " . mysqli_error($conn));
	echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Duplicate Room.')
			window.location.href='..//addroom.php';
			</SCRIPT>");
}
else{
		$last_id = $conn->insert_id;
		if(($last_id) > 0){
			echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('Saved Succesfully.')
			window.location.href='..//viewroom.php';
			</SCRIPT>");
			}
}
?>