<?php

require_once ('dbh.php');

$BoardId = $_POST['BoardId'];
$BoardName = $_POST['BoardName'];
$Gpio = $_POST['Gpio'];
/*$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$nid = $_POST['nid'];
$dept = $_POST['dept'];
$degree = $_POST['degree'];
$salary = $_POST['salary'];
$birthday =$_POST['birthday'];
//echo "$birthday";
$files = $_FILES['file'];
$filename = $files['name'];
$filrerror = $files['error'];
$filetemp = $files['tmp_name'];
$fileext = explode('.', $filename);
$filecheck = strtolower(end($fileext));
$fileextstored = array('png' , 'jpg' , 'jpeg'); */

/*if(in_array($filecheck, $fileextstored)){

    $destinationfile = 'images/'.$filename;
    move_uploaded_file($filetemp, $destinationfile);

    $sql = "INSERT INTO `employee`(`id`, `firstName`, `lastName`, `email`, `password`, `birthday`, `gender`, `contact`, `nid`,  `address`, `dept`, `degree`, `pic`) VALUES ('','$firstname','$lastName','$email','1234','$birthday','$gender','$contact','$nid','$address','$dept','$degree','$destinationfile')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;

$sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
$salaryQ = mysqli_query($conn, $sqlS);
$rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");

if(($result) == 1){
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Registered')
    window.location.href='..//viewemp.php';
    </SCRIPT>");
    //header("Location: ..//aloginwel.php");
}

else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Failed to Registere')
    window.location.href='javascript:history.go(-1)';
    </SCRIPT>");
}

}*/

//else{

      $sql = "INSERT INTO `boards`( `BoardId`, `BoardName`,`GPIO`) VALUES ('$BoardId','$BoardName','$Gpio')";

$result = mysqli_query($conn, $sql);

$last_id = $conn->insert_id;
if(($last_id) > 0){
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Saved Succesfully.')
    window.location.href='..//viewemp.php';
    </SCRIPT>");
}
//$sqlS = "INSERT INTO `salary`(`id`, `base`, `bonus`, `total`) VALUES ('$last_id','$salary',0,'$salary')";
//$salaryQ = mysqli_query($conn, $sqlS);
//$rank = mysqli_query($conn, "INSERT INTO `rank`(`eid`) VALUES ('$last_id')");

//if(($result) == 1){
    
    //echo ("<SCRIPT LANGUAGE='JavaScript'>
    //window.alert('Succesfully Registered')
   // window.location.href='..//viewemp.php';
  //  </SCRIPT>");
    //header("Location: ..//aloginwel.php");
//}

// else{
//     echo ("<SCRIPT LANGUAGE='JavaScript'>
//     window.alert('Failed to Registere')
//     window.location.href='javascript:history.go(-1)';
//     </SCRIPT>");
// }
//}






?>