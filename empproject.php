<?php
session_start();
require_once ('process/dbh.php');
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: elogin.html");
	exit;
}
if(isset($_SESSION["username"])) {
	if(isLoginSessionExpired()) {
		session_unset(); 
		session_destroy(); 
		header("Location: elogin.html"); 
	} 
}
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	$custid=$_SESSION["id"];
	$room_sql = "SELECT id,name from `rooms` where 1";
	$rooms = mysqli_query($conn, $room_sql);
	$sql = " SELECT o.id , o.Appliance,o.state,o.lastrequest,bo.boardid from boards_outputs bo join boards b on bo.boardid=b.Id ";
	$sql.= " join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id JOIN boards_rooms br ON bo.boardid=br.boardid JOIN rooms r on r.id=br.roomid ";
	$sql.= " where bo.customerid=$custid and r.id=$id";
	$result = mysqli_query($conn, $sql);
	//echo $sql;
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Profile</title>
  

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/google-fonts/Nunito.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="vendor/google-fonts/Roboto.css" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
	<link rel="stylesheet" type="text/css" href="styleview.css">
	<link href="css/slider.css" rel="stylesheet" media="all">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="eloginwel.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">STARK IOT'S </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="eloginwel.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Setting</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" href="#">Home</a>
            <a class="collapse-item" href="#">Office</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Applinces</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <?php foreach($rooms as $room): ?>
					<a class="collapse-item" href="empproject.php?id=<?= $room['id'];?>"><?= $room['name']; ?></a>
			<?php endforeach; ?>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Add On
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Useful Links</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Back to Website:</h6>
            <a class="collapse-item" href="#">Home</a>
            <a class="collapse-item" href="#">Products</a>
            <a class="collapse-item" href="#">Features</a>
			<a class="collapse-item" href="#">Documentation</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Login:</h6>
            <a class="collapse-item" href="#.html">Register</a>
            <a class="collapse-item" href="logout.php">Logout</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="charts.php">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-table"></i>
          <span>Daily Usage</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
		<div class="d-sm-flex align-items-center justify-content-between mb-1">
		<span><h2 class="h3 mb-0 text-gray-800">Hi,<?php echo $_SESSION["empName"]?></h2></span>
		</div>
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="#" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="#" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="#" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="#" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
			<form method="POST" action="empproject.php?id=<?php echo $id?>" >
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                <span class="input-group">
                <img class="img-profile rounded-circle" src="process/<?php echo $_SESSION["pic"];?>"
				</span>
			 </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="myprofile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="changepassemp.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Password
                </a>
                <a class="dropdown-item" href="empproject.php">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
		<input type=hidden value=<?= $_SESSION["id"]; ?> id="custctrl" >
		
		<!--Start New Page-->
	<div id="divimg">
		<table class="table">
		<thead class="thead-dark">
			<tr>
			
				<th align = "center">Appliance</th>
				<th align = "center">Last Update</th>
				<th align = "center">State</th>
			</tr>
		</thead>

			<?php
			$x=1;
				while ($appliances = mysqli_fetch_assoc($result)) {
					$button_checked = $appliances['state'] ==1? "checked":"";
					$embedrangectrl=$appliances['state'] ==1 && strtolower($appliances['Appliance']) == 'fan'?"<div><input type=range name=$appliances[id] id=slide_$appliances[id] onchange=ControlFanSpeed(this) min=0 max=3 step=1 class=slider-width>	</div>":"<div><input type=range name=$appliances[id] id=slide_$appliances[id] onchange=ControlFanSpeed(this)  min=0 max=3 step=1 class=slider-width style=display:none></div>";
					echo "<tr>";
					echo "<td>".$appliances['Appliance']."</td>";
					echo "<td>".$appliances['lastrequest']."</td>";
					$inputcontrols= strtolower($appliances['Appliance']) == 'fan' ?  "<td align =center>".
					"<div class=onoffswitch>
						<input value=fan type=checkbox name=$appliances[id] id=myonoffswitch$x onchange=updateOutput(this) class=onoffswitch-checkbox  $button_checked>
						<label class=onoffswitch-label for=myonoffswitch$x><span class=onoffswitch-inner></span><span class=onoffswitch-switch></span></label>
					</div>".$embedrangectrl.
					"</td>"
					:"<td align =center>"."<div class=onoffswitch>
					<input type=checkbox name=$appliances[id] id=myonoffswitch$x onchange=updateOutput(this) class=onoffswitch-checkbox  $button_checked>
					<label class=onoffswitch-label for=myonoffswitch$x><span class=onoffswitch-inner></span><span class=onoffswitch-switch></span></label>
					</div>"."</td>";
					echo $inputcontrols;
					echo "<input type=hidden name=switchstate$x id=onoffstate$x >";
					echo "<input type=hidden value=$appliances[boardid] id=boardid >";
					$x++;
				}

			?>

		</table>
	</div>
		<script>
		
<<<<<<< HEAD
		//setTimeout(function () { location.reload(1); }, 5000);
=======
		setTimeout(function () { location.reload(1); }, 10000);
>>>>>>> b476bcd0d6a21cc0432e991c33115dc30b5b61db
		function updateOutput(element) {
			var xhr = new XMLHttpRequest();
			if(element.checked){
				xhr.open("GET", "esp-outputs-action.php?action=output_update&id="+element.name+"&state=1", true);
				if(element.value == 'fan'){
					Show(element);
				}
			}	
			else {
				xhr.open("GET", "esp-outputs-action.php?action=output_update&id="+element.name+"&state=0", true);
				if(element.value == 'fan'){
					Hide(element);
				}
			}
			xhr.send();
		}	
		
		function Show(element) {
			//alert('show'+element.name);
			document.getElementById('slide_'+element.name).style.display = "block";
			document.getElementById('slide_'+element.name).value = 3;
			ControlFanSpeed(element);
		}

		function Hide(element) {
			document.getElementById('slide_'+element.name).style.display = "none";
			EnableDisableGPIO(custid,boardid,5,0);
			EnableDisableGPIO(custid,boardid,17,0);
			EnableDisableGPIO(custid,boardid,16,0);
		}
		//R2 GPIO17
		//R3 GPIO16
		//R4 GPIO4
		function ControlFanSpeed(element){
			//alert('ControlFanSpeed name '+element.name);
			//alert('ControlFanSpeed value '+element.value);
			var custid=document.getElementById("custctrl").value;
			var boardid=document.getElementById("boardid").value;
			//alert('Customer Id: '+ custid);
			//alert('Board Id: '+ boardid);
			switch (element.value) {
			case '1':
				EnableDisableGPIO(custid,boardid,5,1);
				EnableDisableGPIO(custid,boardid,17,0);
				EnableDisableGPIO(custid,boardid,16,0);
				break;
			case '2':
				EnableDisableGPIO(custid,boardid,5,0);
				EnableDisableGPIO(custid,boardid,17,1);
				EnableDisableGPIO(custid,boardid,16,0);
				break;
			default:
				EnableDisableGPIO(custid,boardid,5,0);
				EnableDisableGPIO(custid,boardid,17,0);
				EnableDisableGPIO(custid,boardid,16,1);
			}
		}
		
		function EnableDisableGPIO(custid,boardid,gpio,state){
			var xhr = new XMLHttpRequest();
			var baseurl=window.location.origin;
			var local=window.location.hostname;
			var url=`/esp-outputs-action.php?action=output_boardidupdate&customerid=${custid}&boardid=${boardid}&gpio=${gpio}&state=${state}`;
			var fullUrl=local=='localhost'?baseurl+'/370project'+url:baseurl+url;
			//alert(fullUrl);
			xhr.open("GET",fullUrl , true);
			xhr.send();
		}
<<<<<<< HEAD
		
		
=======
>>>>>>> b476bcd0d6a21cc0432e991c33115dc30b5b61db
		</script>
		<!--End New Page-->
        </div>
        <!-- /.container-fluid -->
		
		

      </div>
      <!-- End of Main Content -->
	  
	  
	  

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; STARK IOT'S 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->
   
			
  

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
  
  

</body>

</html>





