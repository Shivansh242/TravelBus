<?php
session_start();
if(!isset($_SESSION["id"]))
	header("location: ../index.php?msg=Login first");
if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]=="Busadded")
	echo '<script>window.alert("Bus successfully added");</script>';
else if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]=="busupdated")
	echo '<script>window.alert("Bus successfully updated");</script>';
else if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]=="busdeleted")
	echo '<script>window.alert("Bus successfully deleted");</script>';
else if(isset($_REQUEST["msg"]) && $_REQUEST["msg"]=="nobusselected")
	echo '<script>window.alert("No bus selected");</script>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Travel Bus</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/background.css" />
<link rel="stylesheet" href="../css/rowdata.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
input,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
</style>
<script>
	function edit(x){
		window.location.assign("Updatebus_details.php?busid="+x);
	}
	function del(x){
		window.location.assign("deletebus.php?busid="+x);
	}
	
</script>
</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      		</button>
      <a style="font-size:1.4em;" class="navbar-brand" href="adminhome.php"><span class="glyphicon glyphicon-road"></span>TravelBus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
    	<li class="active"><a href="showbus_details.php">Show Buses</a></li>
      <li><a href="addbus_details.php">Add Buses</a></li>
      <li><a href="user_details.php">View Users</a></li>
      <li><a href="showqueries.php">Show Quries</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    	<li class="active"><a style="font-size:1.2em;">Welcome Admin</a></li>'?>
      <li><?php if(isset($_SESSION["id"])) echo '<a href="../logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';?></li>
    </ul>
       </div>
</nav>
 

<noscript>
	<h2>Enable Javascript First</h2>
</noscript>

	<div class="container">
    <center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
</center>
		<div id="rowdata" class="container-fluid bg-warning table-responsive">
        <center>
        <?php
$conn = mysql_connect("localhost","root","");
if (!$conn)
{
	die("could not connect".mysql_error());
}
else
{
	mysql_select_db("travelbus_db");
}
mysql_select_db("travelbus_db");
$result = mysql_query("SELECT * FROM bus_details");
echo '<table class="table table-hover table-condensed">
<tr class="info">
	<th>Bus name</th><th>Ac</th><th>From City</th><th>To City</th><th>Boarding</th><th>Date</th><th>Departure</th><th>Seats left</th><th>Cost</th><th></th><th></th>
</tr>';
while($row = mysql_fetch_array($result))
{
$time=strtotime($row['time']);
	if('1'==$row['ac'])
	{$ac2='Yes';}
	else
	{$ac2='No';}
	$x=$row["sno"];
echo  "<tr>
<td>".$row['bus_name']."</td><td>".$ac2."</td><td>".$row['from_city']."</td><td>".$row['to_city']."</td><td>".$row['boarding']."</td><td>".$row['date']."</td>"."<td>".date("h:ia",$time)."</td>"."<td>".$row['Seats']." / ".$row['total_seat']."</td>"."<td>".$row['cost_per']."</td>"."<td><button class='btn btn-link' onclick='edit(".$x.")'>Edit</button></td><td><button class='btn btn-link' onclick='del(".$x.")'>Delete</button></td>"."</tr>";
}
echo '</table>';
?>
		</center>		
       </div>
	</div>


<br/><br/>


</body>
</html>
