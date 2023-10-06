<?php
   	
	
    $servername = "starkiots.mysql.database.azure.com";
    // Your Database name
    $dbname = "370project";
    // Your Database user
    $username = "vipul@starkiots";
    // Your Database user password
    $password = "69t2bdmxnRjg$";

     function createOutput($name, $board, $gpio, $state) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Outputs (name, board, gpio, state)
        VALUES ('" . $name . "', '" . $board . "', '" . $gpio . "', '" . $state . "')";

       if ($conn->query($sql) === TRUE) {
            return "New output created successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function deleteOutput($id) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM Outputs WHERE id='". $id .  "'";

       if ($conn->query($sql) === TRUE) {
            return "Output deleted successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    
   function updateAPIOutputById($boardid,$custid, $gpio,$state) {
        global $servername, $username, $password, $dbname;

<<<<<<< HEAD
	function updateAPIOutputById($boardid,$custid, $gpio,$state) {
        global $servername, $username, $password, $dbname;

=======
>>>>>>> b476bcd0d6a21cc0432e991c33115dc30b5b61db
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		
		$gpiosql = " SELECT o.id outid from boards_outputs bo join boards b on bo.boardid=b.Id ";
		$gpiosql.= " join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id  ";
		$gpiosql.= " where bo.customerid=$custid and b.Id='". $boardid ."' and o.Gpio=$gpio";
		
		$gpioresult = $conn->query($gpiosql);
		
		if ($gpioresult) {
			while ($row = $gpioresult->fetch_assoc()) {
			$id = $row["outid"];
		}}
		
		//echo $id;
		$sql = "UPDATE outputs SET lastrequest=now(), state='" . $state . "' WHERE id='". $id .  "'";
		
		if ($conn->query($sql) === TRUE) {
            return "Output state updated successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
    function updateAPIOutput($bcode,$custid, $gpio,$state) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		
		$gpiosql = " SELECT o.id outid from boards_outputs bo join boards b on bo.boardid=b.Id ";
		$gpiosql.= " join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id  ";
		$gpiosql.= " where bo.customerid=$custid and b.BoardCode='". $bcode ."' and o.Gpio=$gpio";
		
		$gpioresult = $conn->query($gpiosql);
		
		if ($gpioresult) {
			while ($row = $gpioresult->fetch_assoc()) {
			$id = $row["outid"];
		}}
		
		//echo $id;
		$sql = "UPDATE outputs SET lastrequest=now(), state='" . $state . "' WHERE id='". $id .  "'";
		
		if ($conn->query($sql) === TRUE) {
            return "Output state updated successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }
<<<<<<< HEAD
	
	 function updateOutput($id, $state) {
=======
 function updateOutput($id, $state) {
>>>>>>> b476bcd0d6a21cc0432e991c33115dc30b5b61db
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		$sql = "UPDATE outputs SET lastrequest=now(), state='" . $state . "' WHERE id='". $id .  "'";
		
		if ($conn->query($sql) === TRUE) {
            return "Output state updated successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function getAllOutputs() {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, name, board, gpio, state FROM Outputs ORDER BY board";
        if ($result = $conn->query($sql)) {
            return $result;
        }
        else {
            return false;
        }
        $conn->close();
    }

    function getAllOutputStates($boardcode,$customerid) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
		//$sql= "SELECT o.Gpio gpio,o.state state from boards_outputs bo join boards b on bo.boardid=b.Id join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id where bo.customerid='" . $customerid . "' and b.BoardCode='" . $boardcode . "'";
		$sql = " SELECT o.Gpio gpio,o.state state from boards_outputs bo join boards b on bo.boardid=b.Id ";
		$sql.= " join outputs o on bo.outputid=o.id join employee e on bo.customerid=e.id  ";
		$sql.= " where bo.customerid=$customerid and b.BoardCode='". $boardcode ."'";
		//echo $sql;
      //  $sql = "SELECT gpio, state FROM Outputs WHERE board='" . $board . "'";
        if ($result = $conn->query($sql)) {
            return $result;
        }
        else {
            return false;
        }
        $conn->close();
    }

    function getOutputBoardById($id) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT board FROM Outputs WHERE id='" . $id . "'";
        if ($result = $conn->query($sql)) {
            return $result;
        }
        else {
            return false;
        }
        $conn->close();
    }

    function updateLastBoardTime($boardcode) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE boards SET last_request=now() WHERE boardcode='". $boardcode ."'";

       if ($conn->query($sql) === TRUE) {
            return "Output state updated successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function getAllBoards() {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT board, last_request FROM Boards ORDER BY board";
        if ($result = $conn->query($sql)) {
            return $result;
        }
        else {
            return false;
        }
        $conn->close();
    }

    function getBoard($boardcode) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT boardcode, last_request FROM boards WHERE BoardCode='" . $boardcode . "'";
        if ($result = $conn->query($sql)) {
            return $result;
        }
        else {
            return false;
        }
        $conn->close();
    }

    function createBoard($board) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO Boards (board) VALUES ('" . $board . "')";

       if ($conn->query($sql) === TRUE) {
            return "New board created successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function deleteBoard($board) {
        global $servername, $username, $password, $dbname;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM Boards WHERE board='". $board .  "'";

       if ($conn->query($sql) === TRUE) {
            return "Board deleted successfully";
        }
        else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

?>
