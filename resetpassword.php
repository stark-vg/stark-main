<?php
include('process/dbh.php');
$error="";
if (isset($_GET["key"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
  $key = $_GET["key"];
  $email = $_GET["email"];
  $curDate = date("Y-m-d H:i:s");
  $sql ="SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';";
  $query = mysqli_query($conn,$sql);
  //echo $sql;
  $row = mysqli_num_rows($query);
  //echo 'Number of rows'.$row ;
  //echo 'second place'.$key;
if ($row==""){
		$error .= '<h2>Invalid Link</h2>
		<p>The link is invalid/expired. Either you did not copy the correct link
		from the email, or you have already used the key in which case it is 
		deactivated.</p>
		<p><a href="http://localhost/370project/forgotpassword.php">
		Click here</a> to reset password.</p>';
 }
else
{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Reset Password</title>
		<link href="css/forgotpass.css" rel="stylesheet" id="bootstrap-css">
		</head>
		<body>
		<div class="container">
				<div class="row">
					<div class="col-md-3">
						<img src="images/reset-password-icon.jpg" class="img-fluid" alt="">
					</div>
					<div class="col-md-9" style="padding-top:100px">
						<h2 class="font-weight-light">Reset Password</h2>
						
						<form method="post" action="" name="update"  class="mt-3">
							<input type="hidden" name="action" value="update" />
							<input class="form-control form-control-lg textbox-width" type="password" name="pass1" maxlength="15" placeholder="Enter New Password" required >
							<div class = "mt-5"> 
							<input class="form-control form-control-lg textbox-width" type="password"  name="pass2" maxlength="15"  placeholder="Re-Enter New Password" required >
							<input type="hidden" name="email" value="<?php echo $email;?>"/>
							<input type="hidden" name="key" value="<?php echo $key;?>"/>
							</div>
							<div class="mt-5">
								<button type="submit" value="Reset Password" class="btn btn-lg btn-success">Reset Password</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</body>
		</html>
		<?php
	}
	else{
			$error .= "<h2>Link Expired</h2>
			<p>The link is expired. You are trying to use the expired link which 
			as valid only 24 hours (1 days after request).<br /><br /></p>";
	}
}

	if($error!=""){
	  echo "<div class='error'>".$error."</div><br />";
	} 
} // isset email key validate end
 
 
if(isset($_POST["email"]) && isset($_POST["action"]) &&  ($_POST["action"]=="update")){
	$error="";
	$pass1 = mysqli_real_escape_string($conn,$_POST["pass1"]);
	$pass2 = mysqli_real_escape_string($conn,$_POST["pass2"]);
	$email = $_POST["email"];
	$key = $_POST["key"];
	$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
	$error.="Password do not match, both password should be same.";
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	window.alert('$error')
	window.location.href='resetpassword.php?key=$key&email=$email&action=reset';
    </SCRIPT>");
	
}
  
if($error!=""){
	echo "<div class='error'>".$error."</div><br />";
}
else{
	//$pass1 = md5($pass1);
	mysqli_query($conn,"UPDATE `employee` SET `password`='".$pass1."', `trandate`='".$curDate."' WHERE `email`='".$email."';");
	mysqli_query($conn,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");
	echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
	<p><a href="http://localhost/370project/elogin.html">
	Click here</a> to Login.</p></div><br />';
} 
}
?>


