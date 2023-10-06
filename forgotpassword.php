<?php
include('process/dbh.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$error ="";
if (!$email) {
   $error .="<p>Invalid email address please type a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `employee` WHERE email='".$email."'";
   $results = mysqli_query($conn,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
	$error .= "<p>No user is registered with this email address!</p>";
   }
  }
   if($error!=""){
   echo "<div class='error'>".$error."</div>
   <br /><a href='javascript:history.go(-1)'>Go Back</a>";
   }
   else{
   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
   );
   
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5($email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;
	// Insert Temp Table
	mysqli_query($conn,	"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`) VALUES ('".$email."', '".$key."', '".$expDate."');");
// echo getcwd();
$webUrl="https://starkiot.azurewebsites.net/resetpassword.php?key='.$key.'&email='.$email.'&action=reset";
$localUrl="http://localhost/370project/resetpassword.php?key='.$key.'&email='.$email.'&action=reset";

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="http://localhost/370project/resetpassword.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">Click here</a></p>'; 
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   
$output.='<p>Thanks,</p>';
$output.='<p>Stark IOTs Team</p>';
$body = $output; 
$subject = "Password Recovery - espindia.com";
 
$email_to = $email;
$fromserver = "TestingIOT@gmail.com"; 
require 'vendor/autoload.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';
$mail->Host = "smtp.gmail.com"; // Enter your host here

$mail->SMTPAuth = true;
$mail->Username = "rajneesh.msf@gmail.com"; // Enter your email here
$mail->Password = "rajnee123$"; //Enter your password here
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->IsHTML(true);
$mail->From = "vipul.saini442@gmail.com";
$mail->FromName = "Stark IOTs Team";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if($mail->Send()){
echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Mail sent Successfully.')
		window.location.href='elogin.html';
		</SCRIPT>");	

}
else{
//echo "<div class='error'><p>An email has been sent to you with instructions on how to reset your password.</p></div><br /><br /><br />";
echo "Mailer Error: " . $mail->ErrorInfo;
 }
   }
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V4</title>

<link href="css/forgotpass.css" rel="stylesheet" id="bootstrap-css">
<script src="js/fogotpass.js"></script>
<script src="js/forgotpass1.js"></script>
</head>
<body>


<div class="container">
    	<div class="row">
    		<div class="col-md-3">
    		    <img src="images/forgot.png" class="img-fluid" alt="">
    		</div>
    		<div class="col-md-9" style="padding-top:100px">
    		    <h2 class="font-weight-light">Forgot your password?</h2>
    		    Not to worry. Just enter your email address below and we'll send you an instruction email for recovery.
    		    <form method="post" action="" name="reset"  class="mt-3">
    		        <input class="form-control form-control-lg" type="email" name="email" placeholder="Your email address" required>
    		        
    		        <div class="text-right my-3">
    		            <button type="submit" value="Reset Password" class="btn btn-lg btn-success">Reset Password</button>
    		        </div>
    		    </form>
    		</div>
    	</div>
    </div>
	</body>
</html>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
