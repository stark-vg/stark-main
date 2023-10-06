<?php

//$servername = "starkiots.mysql.database.azure.com";
//$dBUsername = "vipul@starkiots";
//$dbPassword = "69t2bdmxnRjg$";
$servername = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "370project";

//$conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);

try {
     $conn = mysqli_connect($servername, $dBUsername, $dbPassword, $dBName);
	 if(!$conn){
	echo "Database Connection Failed";
}
      // Code following an exception is not executed.
<<<<<<< HEAD
     // echo 'Never executed';
=======
      //echo 'Never executed';
>>>>>>> b476bcd0d6a21cc0432e991c33115dc30b5b61db
   }catch (Exception $e) {
      echo 'Caught exception: ',  $e->getMessage(), "\n";
   }
   


function isLoginSessionExpired() {
	$login_session_duration = 300; 
	$current_time = time(); 
	if(isset($_SESSION['loggedin_time']) and isset($_SESSION["username"])){  
		if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){ 
			return true; 
		} 
	}
	return false;
}
function strbool($value)
{
	return $value ? 'true' : 'false';
}

?>
