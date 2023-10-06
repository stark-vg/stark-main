<?php

session_start();
if(isset($_SESSION['email']))
{
    header("location: alogin.php");
    exit;
}

require_once ('dbh.php');

$username = $password = "";
$err = "";

$email = $_POST['mailuid'];
$password = $_POST['pwd'];

//$sql = "SELECT * from `alogin` WHERE email = '$email' AND password = '$password'";
//echo "$sql";
//$result = mysqli_query($conn, $sql);


$sql="SELECT * FROM `alogin` WHERE email = ? and password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $email,$password); 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
if(mysqli_num_rows($result) == 1){

    $employee = mysqli_fetch_array($result);
	$empid = $employee['id'];
	$username =$employee['email'];
	
    
	$_SESSION["username"] = $username;
    $_SESSION["id"] = $empid;
    $_SESSION["loggedin"] = true;
	$_SESSION["loggedin_time"] = time();  
	
    
	echo ("logged in");
	header("Location: ..//aloginwel.php");
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}
?>