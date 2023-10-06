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
$sql = "SELECT * from `rooms`";

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

				

                <th align = "center">Id</th>
				<th align = "center">Room Name</th>
				<th align = "center">Description</th>
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($rooms = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$rooms['id']."</td>";
					echo "<td>".$rooms['name']."</td>";
					echo "<td>".$rooms['description']."</td>";
				
					echo "<td><a href=\"editroom.php?id=$rooms[id]\">Edit</a> | <a href=\"deleteroom.php?id=$rooms[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
	
</body>
</html>