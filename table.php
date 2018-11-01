<html>
<head>
<title>Webpage for ECE4970 Demo</title>
<style>
  .top_color { 
    background-color:#2E2E2E; 
    width:100%; 
    height:60px
  }
   .button_color {
    background-color:#2E2E2E; 
    width:100%; 
    height:65px;
    position:absolute;
    bottom:0px;
  }
   p {
     color:#FFFFFF;
     font-style:italic;
     font-weight:bold;
     font-size:25px;
     position:absolute;
     right:60px;
     top:0px;
  }
  h3.pos_left {
    position:relative;
    left:100px;
  }
  h3.pos_left_little {
    position:relative;
    right:20px;
  }
  label.right {
    position:relative;
    left: 100px;
  }
  label.effect {
    -webkit-text-fill-color: transparent;
    -webkit-text-stroke: 2px #17202A;
    font-size:30px;
    background: url(http://www.pencilscoop.com/demos/CSS_Text_Effects/images/galaxy.jpg);
    background-size: cover;
 
  }
  .itemlist-table {
   position:absolute;
	left:5%;
	top:40%;
  }
  .temperature_table {
   position:absolute;
	left:38%;
	top:35%;
  }
  .power_status_table {
   position:absolute;
	right:7%;
	top:35%;
  }
  .door_status {
    float:left;
   	 height:190px;
   	 width:300px;
  }
  .power_status {
   	 float:left;
   	 height:190px;
    width:300px;
    position:relative;
    left:30%;
  }
  .status {
    position:absolute;
    left:20%;
    top:12%;
  }
  #circle_red {
     width: 40px;
     height: 40px;
     background: red;
     -moz-border-radius: 20px;
     -webkit-border-radius: 20px;
     border-radius: 20px;
  }
  #circle_green {
     width: 40px;
     height: 40px;
     background: green;
     -moz-border-radius: 20px;
     -webkit-border-radius: 20px;
     border-radius: 20px;
  }
  .circle_move1 {
    position:relative;
    left:150px;
    bottom:100px;
  }
  .circle_move2 {
    position:relative;
    left:150px;
    bottom:40px;
  }
  .circle_move3 {
    position:relative;
    left:180px;
    bottom:100px;
  }
  .circle_move4 {
    position:relative;
    left:180px;
    bottom:40px;
  }
  img.tiger {
    width: 15%;
  }
  .button_location {
    position:absolute;
    left:45%;
    bottom:12%;
  }
  button.reload_button {
	width: 150px; 
	height: 40px;
	border-width: 0px; 
	border-radius: 3px; 
	background: #1E90FF;
	cursor: pointer; 
	outline: none; 
	font-family: Microsoft YaHei; 
	color: white; 
	font-size: 17px;
}
  .power_duration {
    position:absolute;
    right:7%;
    bottom:15%;
  }
  td {
    text-align:center;
  }
  td.high_temp {
    color:#FF0000;
    font-weight:bold;
  }
  
</style>
</head>
<body>
<div class = top_color>
  <p>University of Missouri-Columbia</p>
</div>
<div class = button_color>
  <p>ECE4970 Group7   Status Monitor Website</p>
</div>
<div class = button_location>
  <button class = reload_button onclick="window.location.href='/table.php'">Reload Data</button>
</div>
<img src="tiger.png"  alt="Tiger" class = 'tiger'/>
<div class = "itemlist-table">
  <h3 class = "pos_left">Table for ItemList</h3>
  <table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
        <tr>
            <th>id</th>
            <th>SerialNumber</th>
            <th>ProductName</th>
            <th>ItemStatus</th>
        </tr>
<?php
// connect to DBMS
$servername = "localhost";
$username = "testuser";
$password = "testuser";
$dbname = "espdemo";

// Create connection
$database = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($database->connect_error) {
    die("<p>Connection failed: " . $database->connect_error . "</p>");
}

//mysql_select_db($Student,$link); // choose table itemlist
$sql1 = "SELECT * FROM ItemList WHERE item_status = 1"; // execute mysql order
$result1 = mysqli_query($database,$sql1); // use mysql_query() to send sql apply
  
while($row = mysqli_fetch_array($result1)) // use while loop to send result from sql to array
{
	echo "<tr>";
	echo "<td>".$row[id]."</td>"; 
	echo "<td>".$row[serial_number]." </td>"; 
	echo "<td>".$row[product_name]." </td>"; 
	echo "<td>".$row[item_status]." </td>"; 
	echo "</tr>";
}
echo "</table>";
echo "</div>";
?>
   
<div class = "temperature_table">
  <h3 class = "pos_left_little">Table for Temperature Measurement</h3>
	<table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
        <tr>
            <th>id</th>
            <th>Temperature</th>
            <th>CheckInTime</th>
        </tr>

<?php
$sql2 = "SELECT * FROM Temperature ORDER BY check_in_time DESC LIMIT 10 "; // select lastest 10 data
$result2 = mysqli_query($database,$sql2); // use mysql_query() to send sql apply
  
while($row = mysqli_fetch_array($result2)) // use while loop to send result from sql to array
{
	echo "<tr>";
	echo "<td>".$row[id]."</td>"; 
  	if($row[temperature] > 5){
		 echo "<td class = high_temp >".$row[temperature]." </td>"; 
    }
  	else{
      echo "<td>".$row[temperature]." </td>";
    }
	echo "<td>".$row[check_in_time]." </td>"; 
	echo "</tr>";
}
?>
  </table>
</div>

<div class = "power_status_table">
  <h3>Table for Power Status</h3>
	<table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
        <tr>
            <th>id</th>
            <th>Power Status</th>
            <th>Check Time</th>
        </tr>

<?php
$sql2 = "SELECT * FROM PowerStatus ORDER BY check_time DESC LIMIT 6 "; // select lastest 6 data
$result2 = mysqli_query($database,$sql2); // use mysql_query() to send sql apply
  
while($row = mysqli_fetch_array($result2)) // use while loop to send result from sql to array
{
	echo "<tr>";
	echo "<td>".$row[id]."</td>"; 
	echo "<td>".$row[power_status]." </td>"; 
	echo "<td>".$row[check_time]." </td>"; 
	echo "</tr>";
}
?>
  </table>
</div>
  
<div class = 'status'>
<div class = 'door_status'>
<?php
	$sql3 = "SELECT * FROM DoorStatus ORDER BY check_time DESC LIMIT 1"; // 
   $result3 = mysqli_query($database,$sql3);
  	$row = mysqli_fetch_array($result3);
      
   echo "<label style='position:relative; left:100px;' class = 'effect'>DoorStatus</label><br><br>";
   echo "<label class = 'effect'>Open</label><br><br>";
   echo "<label class = 'effect'>Close</label>";
   if($row[door_status]){
     echo "<div id = 'circle_red' class = 'circle_move1'></div><br>"; // show the red circle 
   }  
   else if(!$row[door_status]){
     echo "<div id = 'circle_green' class = 'circle_move2'></div><br>";// show the green cirlce 
   }
?>    
</div>
    
<div class = 'power_status'>
<?php
  	$sql6 = "SELECT COUNT(*) as count FROM PowerStatus"; // 
   $result6 = mysqli_query($database,$sql6);
   $row = mysqli_fetch_assoc($result6);
   $count = $row['count'];
	$sql4 = "SELECT * FROM PowerStatus ORDER BY check_time DESC LIMIT 1"; // 
   $result4 = mysqli_query($database,$sql4);
  	$row = mysqli_fetch_array($result4);
      
   echo "<label style='position:relative; left:125px;' class = 'effect'>PowerStatus</label><br><br>";
   echo "<label class = 'effect'>Regular</label><br><br>";
   echo "<label class = 'effect'>Battery</label>";
  	if($count == 0){
     echo "<div id = 'circle_green' class = 'circle_move3'></div><br>"; // show the green circle 
    }//check if the table is empty
   else if($row[power_status]){
     echo "<div id = 'circle_green' class = 'circle_move3'></div><br>"; // show the green circle 
   }  
   else if(!$row[power_status]){
     echo "<div id = 'circle_red' class = 'circle_move4'></div><br>";// show the red cirlce 
   }
?>    
</div> 
</div>
    <div class = 'power_duration'>
        <?php
        $sql6 = "SELECT COUNT(*) as count FROM PowerStatus"; // 
        $result6 = mysqli_query($database,$sql6);
        $row = mysqli_fetch_assoc($result6);
        $count = $row['count'];
        // echo "<p>".count."</p>"; 
        if($count == 1){
          /*echo "<table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
        		<tr><td class = 'duration_table'>Duration of Power</td></tr>
        		<tr><td class = 'duration_table'>Regular Power is On</td></tr>
      			</table>";*/
          
        }//for check the duration, check if there are at least two rows of data 
      	 else if($count > 1){
          $sql7 = "SELECT power_status FROM PowerStatus ORDER BY check_time DESC LIMIT 1,1"; // get last second line
          $sql8 = "SELECT power_status FROM PowerStatus ORDER BY check_time DESC LIMIT 1"; // get last line
        	$result7 = mysqli_query($database,$sql7);
          $result8 = mysqli_query($database,$sql8);
        	$row = mysqli_fetch_array($result7);
          $row1 = mysqli_fetch_array($result8);
          if($row[power_status] == 0){
            //last second row equal to 0
           if($row1[power_status] == 1) {
             //last row equal to 1
            /* echo "<table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
        		<tr><td>Duration of Power</td></tr>
        		<tr><td>Regular Power is On</td></tr>
      			</table>";*/
             $sql1 = "SELECT check_time FROM PowerStatus ORDER BY check_time DESC LIMIT 1,1"; //time of second last line
             $sql2 = "SELECT check_time FROM PowerStatus ORDER BY check_time DESC LIMIT 1"; //time of last line
             $result1 = mysqli_query($database,$sql1);
          	  $result2 = mysqli_query($database,$sql2);
             $row = mysqli_fetch_array($result1);
             $row1 = mysqli_fetch_array($result2);
             $timediff = strtotime ($row1[check_time]) - strtotime ($row[check_time]);
             $d = floor($timediff/3600/24); //day
				  $h = floor(($timediff%(3600*24))/3600); //hour
             $m = floor(($timediff%(3600*24))%3600/60); //minute
             $s = floor(($timediff%(3600*24))%60); //second
             //echo "<h3>".$d."days".$h."hours".$m."minutes".$s."seconds </h3>"; 
             echo "<table border = 1 cellspacing=0 cellpadding=0 bordercolor=#000000>
             <tr><th></th><th>Duration Of Power</th></tr>
             <tr><td>Days</td><td>".$d."</td></tr>
             <tr><td>Hours</td><td>".$h."</td></tr>
             <tr><td>Minutes</td><td>".$m."</td></tr>
             <tr><td>Seconds</td><td>".$s."</td></tr>
             </table>";
           } 
          }           
         }//check if last status of power is 0, which means switch to battery mode
        ?>
    </div>
</html>
  
  
  
  
  