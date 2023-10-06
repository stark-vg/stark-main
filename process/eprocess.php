<?php
require_once ('dbh.php');
session_start();
// check if the user is already logged in
if(isset($_SESSION['username']))
{
   header("location: eloginwel.php");
    exit;
}

//echo 'session time on eprocess'.$_SESSION["loggedin_time"];

$username=$_POST['mailuid']; 
$password=$_POST['pwd']; 

// To protect MySQL injection (more detail about MySQL injection)
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysqli_real_escape_string($conn,$username);
$password = mysqli_real_escape_string($conn,$password);

$sql="SELECT * FROM `employee` WHERE email = ? and password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $username,$password); 
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$conn->close();
//echo $sql;
if(mysqli_num_rows($result) == 1){
	//echo 'welcome';
	$employee = mysqli_fetch_array($result);
	$empid = $employee['id'];
	$username =$employee['email'];
	$empName = $employee['firstName'].' '.$employee['lastName'];
    
	$_SESSION["username"] = $username;
    $_SESSION["id"] = $empid;
    $_SESSION["loggedin"] = true;
	$_SESSION["empName"]=$empName;
	$_SESSION["pic"]=$employee['pic'];
	$_SESSION["loggedin_time"] = time();  
	//echo $empid;
    header("Location: ..//eloginwel.php?id=$empid");
}
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Invalid Email or Password')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}


?>