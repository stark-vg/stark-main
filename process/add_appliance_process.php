<?php
require_once ('dbh.php');

$boardid = $_POST['boardid'];
$customerid = $_POST['customerid'];

$typeid = $_POST['typeid'];

$appliance = $_POST['appliance'];
$gpio = $_POST['gpio'];
$state = $_POST['state'];
$roomid = $_POST['roomid'];
$actualgpio = [
    '1' => 33,
    '2' => 22,
    '3' => 21,
    '4' => 19,
    '5' => 18,
    '6' => 99,
    '7' => 98,
    '8' => 97,
    '9' => 96,
    '10' => 95
];

if($typeid == 1)
{
    $sql = "INSERT INTO `outputs`( `Appliance`, `state`, `Gpio`) VALUES ('$appliance','$state','$gpio')";
    $result = mysqli_query($conn, $sql);
    $output_id = $conn->insert_id;
    if(($output_id) >0 )
    {
        $sql = "INSERT INTO `boards_outputs`( `boardid`, `outputid`, `customerid`) VALUES ('$boardid','$output_id','$customerid')";
        $result = mysqli_query($conn, $sql);
    }

    $sqlroom = "SELECT * FROM `boards_rooms`WHERE boardid = '$boardid' AND roomid =  '$roomid' ";
    $roomresult = mysqli_query($conn, $sqlroom);
    $row = mysqli_num_rows($roomresult);
    if ($row==0){
	$sql = "INSERT INTO `boards_rooms`( `boardid`, `roomid`) VALUES ('$boardid','$roomid')";
    $result = mysqli_query($conn, $sql);
   }
   echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Succesfully Added.')
            window.location.href='..//aloginwel.php';
            </SCRIPT>");
}
else
{
    for ($x = 1; $x <= $gpio; $x++) 
        {
            //echo $actualgpio[$x];
            $sql = "INSERT INTO `outputs`( `Appliance`, `state`, `Gpio`) VALUES ('$appliance $x','$state','$actualgpio[$x]')";
            $result = mysqli_query($conn, $sql);
            $output_id = $conn->insert_id;
            if(($output_id) >0 )
            {
                $sql = "INSERT INTO `boards_outputs`( `boardid`, `outputid`, `customerid`) VALUES ('$boardid','$output_id','$customerid')";
                $result = mysqli_query($conn, $sql);
            }
        }
        if(($output_id) >0 )
        {
            $sql = "INSERT INTO `boards_rooms`( `boardid`, `roomid`) VALUES ('$boardid','$roomid')";
            $result = mysqli_query($conn, $sql);
            //echo $sql;  
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Succesfully Registered')
            window.location.href='..//aloginwel.php';
            </SCRIPT>");
        }    

}







?>