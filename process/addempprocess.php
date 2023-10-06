<?php

require_once ('dbh.php');

$firstname = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];
//$nid = $_POST['nid'];
//$dept = $_POST['dept'];
//$degree = $_POST['degree'];
//$salary = $_POST['salary'];
$birthday =$_POST['birthday'];
//echo "$birthday";
$files = $_FILES['file'];
$filename = $files['name'];
$filrerror = $files['error'];
$filetemp = $files['tmp_name'];
$fileext = explode('.', $filename);
$filecheck = strtolower(end($fileext));
$fileextstored = array('png' , 'jpg' , 'jpeg');

if(in_array($filecheck, $fileextstored)){

    $destinationfile = 'images/'.$filename;
    move_uploaded_file($filetemp, $destinationfile);
    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`,   `address`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$address','$destinationfile')";
	$result = mysqli_query($conn, $sql);
	$last_id = $conn->insert_id;

	if (mysqli_errno($conn) == 1062) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Duplicate Email Id.')
		window.location.href='..//addemp.php';
		</SCRIPT>");
	}
	if(($last_id) > 0){
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Succesfully Registered')
		window.location.href='..//viewemp.php';
		</SCRIPT>");
	}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Registere')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

}

else{

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`,  `address`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$address','images/no.jpg')";
	$result = mysqli_query($conn, $sql);
	$last_id = $conn->insert_id;
	
	if (mysqli_errno($conn) == 1062) {
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Duplicate Email Id.')
		window.location.href='..//addemp.php';
		</SCRIPT>");
	}
	if(($last_id) >0 ){
		echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Succesfully Registered')
		window.location.href='..//viewemp.php';
		</SCRIPT>");
	}
}
?>