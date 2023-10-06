<?php
    include_once('esp-database.php');

    $action = $id = $name = $gpio = $state = "";


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
          // echo 'Entered in output-action--Stark IOTs';
		   $action = test_input($_GET["action"]);
		    //echo 'Action '.$action;
           if ($action == "outputs_state") {
				$boardcode = test_input($_GET["boardcode"]);
				$customerid = test_input($_GET["customerid"]);
				$result = getAllOutputStates($boardcode,$customerid);
				if ($result) {
					while ($row = $result->fetch_assoc()) {
                    $rows[$row["gpio"]] = $row["state"];
                }
            }
				echo json_encode($rows);
				$result = getBoard($boardcode);
				if($result->fetch_assoc()) {
					updateLastBoardTime($boardcode);
				}
			}
			else if ($action == "output_apiupdate") {
				//echo 'Action '.$action;
				$bcode = test_input($_GET["boardcode"]);
				$custid = test_input($_GET["customerid"]);
				$gpio = test_input($_GET["gpio"]);
				$state = test_input($_GET["state"]);
				//$id = test_input($_GET["id"]);
				//echo 'output id '.$id;
				
				//echo $state;
				$result = updateAPIOutput($bcode,$custid, $gpio,$state);
				echo $result;
			}
			else if ($action == "output_boardidupdate") {
				//echo 'Action '.$action;
				$boardid = test_input($_GET["boardid"]);
				$custid = test_input($_GET["customerid"]);
				$gpio = test_input($_GET["gpio"]);
				$state = test_input($_GET["state"]);
				//$id = test_input($_GET["id"]);
				//echo 'output id '.$id;
				
				//echo $state;
				$result = updateAPIOutputById($boardid,$custid, $gpio,$state);
				echo $result;
			}
			else if ($action == "output_update") {
				$id = test_input($_GET["id"]);
				//echo 'output id '.$id;
				$state = test_input($_GET["state"]);
				//echo $state;
				$result = updateOutput($id, $state);
				echo $result;
			}
			
			
       
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
