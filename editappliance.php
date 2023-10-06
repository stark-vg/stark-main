<?php

require_once ('process/dbh.php');
$sql = "SELECT * FROM `outputs` WHERE 1";

//echo "$sql";
$result = mysqli_query($conn, $sql);
if(isset($_POST['update']))
{
	
	
$id = mysqli_real_escape_string($conn, $_POST['id']);
	$boardid = mysqli_real_escape_string($conn, $_POST['boardid']);
	$customerid = mysqli_real_escape_string($conn, $_POST['customerid']);
	$appliance = mysqli_real_escape_string($conn, $_POST['appliance']);
	$gpio = mysqli_real_escape_string($conn, $_POST['gpio']);
	$state = mysqli_real_escape_string($conn, $_POST['switchstate']);
	$roomid = mysqli_real_escape_string($conn, $_POST['roomid']);		

$result = mysqli_query($conn, "UPDATE `outputs` SET `appliance`='$appliance',`gpio`='$gpio',`state`='$state',`lastrequest`=now() WHERE id=$id");
$result = mysqli_query($conn, "UPDATE `boards_outputs` SET `boardid`='$boardid',`customerid`='$customerid' WHERE outputid=$id");
//$sql = "INSERT INTO `boards_outputs`( `boardid`, `outputid`, `customerid`) VALUES ('$boardid','$output_id','$customerid')";
$result = mysqli_query($conn, "UPDATE `boards_rooms` SET `roomid`='$roomid' WHERE boardid=$boardid");
	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='aloginwel.php';
    </SCRIPT>");


	
}
?>
<?php

require_once ('process/dbh.php');
$sql = "SELECT Id,BoardCode from `boards` where 1";

//echo "$sql";
$boards = mysqli_query($conn, $sql);

$cust_sql = "SELECT Id,firstName,lastName from `employee` where 1";

//echo "$sql";
$customers = mysqli_query($conn, $cust_sql);

$room_sql = "SELECT id,name from `rooms` where 1";

$rooms = mysqli_query($conn, $room_sql);

?>
<?php
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$sql = "SELECT * from `outputs` WHERE id=$id";
	$result = mysqli_query($conn, $sql);
	if($result){
	while($res = mysqli_fetch_assoc($result)){
	$appliance = $res['Appliance'];
	$gpio = $res['Gpio'];
	$state = $res['state'];
	$button_checked = $state =="1" ? "checked" :"";
	
}
}
$boardsql = "SELECT * from `boards_outputs` WHERE outputid=$id";
	$boardresult = mysqli_query($conn, $boardsql);
	if($boardresult)
	{
		while($boardres = mysqli_fetch_assoc($boardresult)){
	$boardid = $boardres['boardid'];
	$customerid = $boardres['customerid'];
	}
}
$roomsql = "SELECT * from `boards_rooms` WHERE boardid=$boardid";
	$roomresult = mysqli_query($conn, $roomsql);
	if($roomresult)
	{
		while($roomsdata = mysqli_fetch_assoc($roomresult)){
		$roomid = $roomsdata['roomid'];
		}
	}
	//echo $roomid
?>
<!DOCTYPE html>
<html>

<head>
   

    <!-- Title Page-->
    <title>Add Appliance | Admin Panel</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="vendor/google-fonts/Roboto.css" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
	<link href="css/slider.css" rel="stylesheet" media="all">
</head>

<body>
    <header>
        <nav>
            <h1>Stark Technologies</h1>
            <ul id="navli">
              <li><a class="homered" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addboard.php">Add Board</a></li>
				<li><a class="homeblack" href="viewboard.php">View Board</a></li>
				<li><a class="homeblack" href="addemp.php">Add Customer</a></li>
				<li><a class="homeblack" href="viewemp.php">View Customer</a></li>
				<li><a class="homeblack" href="addappliance.php">Add Appliance</a></li>
			    <li><a class="homeblack" href="addroom.php">Add Room</a></li>
				<li><a class="homeblack" href="viewroom.php">View Room</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="divider"></div>




    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Customer Appliance Info</h2>
                    <form id = "editappliance" action="editappliance.php" method="POST" >
                        

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <select name="boardid"  >
											<option disabled="disabled" selected="selected">Board</option>
											<?php foreach($boards as $board): ?>
											<option value="<?= $board['Id']; ?>" <?php if($boardid == $board['Id']) echo("selected")?> ><?= $board['BoardCode']; ?></option>
											<?php endforeach; ?>
									</select>
									 
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <select name="customerid" >
                                            <option disabled="disabled" selected="selected">Customer</option>
                                            <?php foreach($customers as $customer): ?>
											<option value="<?= $customer['Id']; ?>"<?php if($customerid == $customer['Id']) echo("selected")?>><?= $customer['firstName']; ?> <?= $customer['lastName']; ?></option>
											<?php endforeach; ?>
                                        </select>
                                </div>
                            </div>
                       
					   <div class="col-2">
                                <div class="input-group">
                                    <select name="roomid">
                                            <option disabled="disabled" selected="selected">Rooms</option>
                                            <?php foreach($rooms as $room): ?>
											<option value="<?= $room['id']; ?>"<?php if($roomid == $room['id']) echo("selected")?> ><?= $room['name']; ?></option>
											<?php endforeach; ?>
                                        </select>
                                </div>
                            </div>

					   </div>
		
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Appliance" name="appliance" value="<?php echo $appliance;?>" required="required">
                        </div>
                       
                                              
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Gpio" name="gpio" value="<?php echo $gpio;?>" required="required" >
                        </div>

                       
<div class="onoffswitch">
    <input type="checkbox" name="state" class="onoffswitch-checkbox" id="myonoffswitch" onchange="updateOutput(this)" tabindex="0" <?php echo $button_checked;?>>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>
</div>

                       <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" ><br><br>
					   <input type="hidden" name="switchstate" id="onoffstate" >
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script>
        function updateOutput(element) {
            
            if(element.checked){
               document.getElementById("onoffstate").value = "1";
            }
            else {
                document.getElementById("onoffstate").value = "0";
            }
           
        }
</script>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
