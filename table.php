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
	left:100px;
	top:350px
  }
  .temperature-table {
   position:absolute;
	right:200px;
	top:320px
  }
  .door_status {
	float: left;
	with: 50%
  
	
  }
  .power_status {
   width:50%
   float:left
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
  .power_statusContainer {
width: 500px
    
}
  .circle_move1 {
    position:relative;
    left:450px;
    top:0px;
  }
  .circle_move2 {
    position:relative;
    left:50px;

  }
  img.tiger {
    width: 15%;
  }
  .button_location {
    position:absolute;
    left:40%;
    bottom:15%;
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
  <table border = 1>
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
   
<div class = "temperature-table">
  <h3 class = "pos_left_little">Table for Temperature measurement</h3>
	<table border = 1>
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
	echo "<td>".$row[temperature]." </td>"; 
	echo "<td>".$row[check_in_time]." </td>"; 
	echo "</tr>";
}
?>
  </table>
    </div>
     <div class = "power_statusContainer">
    <div class = "door_status">
<?php
	$sql3 = "SELECT * FROM DoorStatus ORDER BY check_time DESC LIMIT 1"; // 
   $result3 = mysqli_query($database,$sql3);
  	$row = mysqli_fetch_array($result3);
      
   echo "<label style='position:relative; left:100px;' class = 'effect'>DoorStatus</label><br><br>";
   echo "<label class = 'effect'>Open</label><br><br>";
   echo "<label class = 'effect'>Close</label>";
   if($row[door_status]){
     echo "<div id = 'circle_red'class = 'circle_move1'><div><br>"; // show the red circle 
   }  
   else if(!$row[door_status]){
     echo "<div id = 'circle_green' class = 'circle_move2'></div><br>";// show the green cirlce 
   }
?>    
    </div>
    
    <div class = "power_status">
<?php
	$sql4 = "SELECT * FROM PowerStatus ORDER BY check_time DESC LIMIT 1"; // 
   $result3 = mysqli_query($database,$sql4);
  	$row = mysqli_fetch_array($result4);
      
   echo "<label style='position:relative; left:100px;' class = 'effect'>PowerStatus</label><br><br>";
   echo "<label class = 'effect'>On</label><br><br>";
   echo "<label class = 'effect'>Off</label>";
   if($row[power_status]){
     echo "<div id = 'circle_red'class = 'circle_move1'></div><br>"; // show the red circle 
   }  
   else if(!$row[power_status]){
     echo "<div id = 'circle_green' class = 'circle_move2'></div><br>";// show the green cirlce 
   }
?>    
    </div> 
	</div> 
</html>
  
  
  
  
  