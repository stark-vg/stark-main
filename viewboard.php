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

$sql = "SELECT * from `boards`";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>View Employee |  Admin Panel | Stark Technologies</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<header>
		<nav>
			<h1> Stark Technologies</h1>
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

		<table>
			<tr>

				<th align = "center">ID</th>
				<th align = "center">Board Code</th>
				<th align = "center">Board Name</th>
				<th align = "center">Last Request</th>
				<th align = "center">Board GPIO</th>
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($boards = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$boards['Id']."</td>";
					echo "<td>".$boards['BoardCode']."</td>";
					echo "<td>".$boards['BoardName']."</td>";
					echo "<td>".$boards['last_request']."</td>";
					echo "<td>".$boards['Gpio']."</td>";
					
					/*echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['email']."</td>";
					echo "<td>".$employee['birthday']."</td>";
					echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['nid']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['dept']."</td>";
					echo "<td>".$employee['degree']."</td>";
					echo "<td>".$employee['points']."</td>";*/

					echo "<td><a href=\"editboard.php?id=$boards[Id]\">Edit</a> | <a href=\"deleteboard.php?id=$boards[Id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>