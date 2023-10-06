<?php

require_once ('process/dbh.php');
$sql = "SELECT distinct b.Id,b.BoardCode FROM boards b LEFT JOIN boards_outputs bo on b.id=bo.boardid  ";

$boards = mysqli_query($conn, $sql);

$cust_sql = "SELECT Id,firstName,lastName from `employee` where 1";

$customers = mysqli_query($conn, $cust_sql);

$room_sql = "SELECT id,name from `rooms` where 1";

$rooms = mysqli_query($conn, $room_sql);

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
                <div class="card-heading" style="padding: 0px 0px 0px 47px;"><span>Note: Please select Type single for existing board and multiple for existing boards.</span></div>
                
                <div class="card-body">
                    <h2 class="title">Customer Appliance Info</h2>
                    <form action="process/add_appliance_process.php" method="POST" enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <select name="boardid">
                                        <option disabled="disabled" selected="selected">Board</option>
                                        <?php foreach($boards as $board): ?>
                                        <option value="<?= $board['Id']; ?>"><?= $board['BoardCode']; ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <select name="customerid">
                                        <option disabled="disabled" selected="selected">Customer</option>
                                        <?php foreach($customers as $customer): ?>
                                        <option value="<?= $customer['Id']; ?>"><?= $customer['firstName']; ?> <?= $customer['lastName']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <select name="roomid">
                                        <option disabled="disabled" selected="selected">Rooms</option>
                                        <?php foreach($rooms as $room): ?>
                                        <option value="<?= $room['id']; ?>"><?= $room['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="input-group">
                                    <select name="typeid">
                                        <option disabled="disabled" selected="selected">Type</option>
                                        <option value="1">Single</option>
                                        <option value="2">Multiple</option>
                                       <!-- <option value="<?= $type['id']; ?>"><?= $type['name']; ?></option>-->
                                        
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Appliance" name="appliance" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Gpio" name="gpio" required="required">
                        </div>
                        <select id="outputState" name="state">
                            <option value="0">0 = OFF</option>
                            <option value="1">1 = ON</option>
                        </select>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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