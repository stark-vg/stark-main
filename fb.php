<?php
include('config.php');
$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();
if(isset($_GET['code']))
{
	 if(isset($_SESSION['access_token']))
	 {
	  $access_token = $_SESSION['access_token'];
	 }
	 else
	 {
	  $access_token = $facebook_helper->getAccessToken();

	  $_SESSION['access_token'] = $access_token;

	  $facebook->setDefaultAccessToken($_SESSION['access_token']);
	 }
	$user= $graph_response->getGraphUser();
	$graph_response = $facebook->get("/me?fields=name,email", $access_token);

	$facebook_user_info = $graph_response->getGraphUser();

	$user= $graph_response->getGraphUser();
	if(!empty($facebook_user_info['id']))
	{
		$_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
	}

	if(!empty($facebook_user_info['name']))
	{
		$_SESSION['user_name'] = $facebook_user_info['name'];
	}

	if(!empty($facebook_user_info['email']))
	{
		$_SESSION['user_email_address'] = $facebook_user_info['email'];
	}
 }
 else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/370project/elogin.html', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}



// Call Facebook API
//require 'vendor/autoload.php';

//$facebook = new Facebook\Facebook([
  //'app_id'      => '177903137344722',
  //'app_secret'     => 'e48323dd711c7361aed1d6d955b0faa7',
  //'default_graph_version'  => 'v2.5'
//]);



/*if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();
 
 $user= $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/370project/elogin.html', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}*/
//$facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/370project/');
//ry
//{
 // $access_token = $facebook_helper->getAccessToken();
//  $facebook->setDefaultAccessToken($_SESSION['access_token']);
  
 // if(isset($access_token)){
//	$_SESSION['access_token'] = $access_token;
//	header('location:alogin.html');
  //}
//} catch(Exception $e)
//{
//echo $e->getTraceAsString();
//}

//echo $facebook_login_url;
// End of Facebook Call
?>
<?php 
if(isset($facebook_login_url))
{
echo $facebook_login_url;
}
else{
echo '<div
class = "panel-heading">welcome User </div><div class = "panel-body">';
echo '<img serc="'.$_SESSION["user"].'"/>'; 

}

?>