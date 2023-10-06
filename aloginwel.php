<?php 
require_once ('process/dbh.php');

session_start();
if( $_SESSION['loggedin'] !==true)
{
	header("location: alogin.html");
	exit;
}
if(isset($_SESSION["username"])) {
	if(isLoginSessionExpired()) {
		session_unset(); 
		session_destroy(); 
		header("Location: alogin.html"); 
	} 
}
//$sql = "SELECT o.id outputId,e.firstName,e.lastName,b.BoardCode,b.BoardName,o.Appliance,o.Gpio,o.state from boards_outputs bo join boards b on bo.boardid=b.Id join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id ";
$sql ="SELECT o.id outputId,e.firstName,e.lastName,b.BoardCode,b.BoardName,r.name roomname,o.Appliance,o.Gpio,o.state from boards_outputs bo join boards b on bo.boardid=b.Id ";
$sql .=	" join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id " ;
$sql .=	" Left JOIN boards_rooms br ON bo.boardid=br.boardid ";
$sql .= " Left JOIN rooms r on r.id=br.roomid";
//echo $sql;
$result = mysqli_query($conn, $sql);
?>

<?php

require_once ('process/dbh.php');
$sql = "SELECT Id,BoardCode FROM boards ";

//echo "$sql";
$boards = mysqli_query($conn, $sql);

$cust_sql = "SELECT Id,firstName,lastName from `employee` where 1";

$customers = mysqli_query($conn, $cust_sql);

	if(isset($_POST['submit'])) {
        $by_customerid = $_POST['customerid'];
        //$search_query = "SELECT o.id outputId,e.firstName,e.lastName,b.BoardCode,b.BoardName,o.Appliance,o.Gpio,o.state from boards_outputs bo join boards b on bo.boardid=b.Id join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id WHERE ";
		$search_query ="SELECT o.id outputId,e.firstName,e.lastName,b.BoardCode,b.BoardName,r.name roomname,o.Appliance,o.Gpio,o.state from boards_outputs bo join boards b on bo.boardid=b.Id ";
		$search_query .=	" join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id " ;
		$search_query .=	" Left JOIN boards_rooms br ON bo.boardid=br.boardid ";
		$search_query .= " Left JOIN rooms r on r.id=br.roomid WHERE ";
		
		if($by_customerid == -1) {
			$search_query .= " 1";         
		}
		elseif($by_customerid >0)
		{
			 $search_query .= " bo.customerid='$by_customerid'";
		}
        $search_query;
		//echo "$search_query";
        $result = mysqli_query($conn,$search_query);
}


?>


<html>
<head>
	<title>Admin Panel |Stark Technologies</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
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
	 

	<div class="divider"></div><br/>
		<form action="" method="post">
			<div class="input-group">
                 <!-- <span>Board</span><select name="boardid">
											<option disabled="disabled" selected="selected">Board</option>
											<?php foreach($boards as $board): ?>
											<option value="<?= $board['Id']; ?>"><?= $board['BoardCode']; ?></option>
											<?php endforeach; ?>
									</select>-->
				<span>Customer</span><select name="customerid">
                                            <option disabled="disabled" selected="selected">Customer</option>
											<option value="-1">ALL</option>
                                            <?php foreach($customers as $customer): ?>
											<option value="<?= $customer['Id']; ?>"><?= $customer['firstName']; ?> <?= $customer['lastName']; ?></option>
											<?php endforeach; ?>
                                        </select>
						
                            <button class="btn btn--radius btn--green" type="submit"  name="submit" value="Search">Search</button>
                                               
			</div>
		</form>
	<div id="divimg">
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Customer Information </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Customer Name</th>
				<th align = "center">Board Code</th>
				<th align = "center">Room Name</th>
				<th align = "center">Appliance</th>
				<th align = "center">GPIO</th>
				<th align = "center">State</th>
				
				<th align = "center">Options</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					//echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['BoardCode']."</td>";
					echo "<td>".$employee['roomname']."</td>";
					echo "<td>".$employee['Appliance']."</td>";
					echo "<td>".$employee['Gpio']."</td>";
					echo "<td>".$employee['state']."</td>";
					
					echo "<td><a href=\"editappliance.php?id=$employee[outputId]\">Edit</a> | <a href=\"deleteappliance.php?id=$employee[outputId]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
					
					$seq+=1;
				}


			?>
			
			<!--<input type="checkbox" name="state" class="onoffswitch-checkbox" id="myonoffswitch" onchange="updateOutput(this)" tabindex="0" <?php echo $button_checked;?>>
    <label class="onoffswitch-label" for="myonoffswitch">
        <span class="onoffswitch-inner"></span>
        <span class="onoffswitch-switch"></span>
    </label>-->

		</table>
	</div>
</body>
</html>