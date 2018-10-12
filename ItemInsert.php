<?php
//Creates new record as per request, Call using this wesleygdatabase.epizy.com/ESPDemoCode.php?temp=VALUE&door=VALUE
    //Connect to database
    $servername = "localhost";
    $username = "testuser";
    $password = "testuser";
    $dbname = "espdemo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get current date and time
   // date_default_timezone_set('Asia/Kolkata');
   // $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
   // $t = date("H:i:s");

    if(!empty($_GET['itemid']))
    {
    	$itemid = $_GET['itemid'];

	    $sql = "select * FROM itemlist where serial_number = '$itemid'"; //Check if item already exist. 

		$result = $conn->query($sql);
	if ($result->num_rows > 0) { //Check if item is already exist or not. 
		$sql="select item_status from itemlist where serial_number='$itemid'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc(); //Retrieve row count. 
		$itemstatus=$row['item_status'];
		if ($itemstatus ==1) {//Check whether item is in or out. 
			$sql="update itemlist set item_status=0 where serial_number='$itemid' && item_status=1";
			$result = $conn->query($sql);
			echo"Item Checked out";
		}
			else {
				$sql="update itemlist set item_status=1 where serial_number='$itemid' && item_status=0";
			$result = $conn->query($sql);
			echo"item checked in";
			}
	}
else {
	$sql = "insert into itemlist (serial_number,item_status) VALUES ('$itemid','1')"; //Insert new entry into items table, mark as present. 
		$conn->query($sql);
		echo"New item created";
	}	

	}


	$conn->close();
?>

