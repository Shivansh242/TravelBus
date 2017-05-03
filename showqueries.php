<?php
session_start();
if(isset($_REQUEST["msg"])){
	if($_REQUEST["msg"]=="replysend")
		echo "<script>window.alert('Reply successfully send');</script>";
	 else if($_REQUEST["msg"]=="noqueryselected")
		echo "<script>window.alert('No Query Selected');</script>";
}
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

<script>
	function reply(x){
		window.location.assign("reply_user.php?queryid="+x);
	}
	function del(x){
		window.location.assign("deletequery.php?queryid="+x);
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
    	<li><a href="showbus_details.php">Show Buses</a></li>
      <li><a href="addbus_details.php">Add Buses</a></li>
      <li><a href="user_details.php">View Users</a></li>
      <li class="active"><a href="showqueries.php">Show Quries</a></li>
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
<h2 style="text-shadow: 2px 2px white"><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
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
$result = mysql_query("SELECT * FROM query_info");
echo '<table class="table table-hover table-condensed">
<tr class="info">
	<th>Name</th><th>Mobile number</th><th>Query</th><th>Email</th></th><th></th><th></th>
</tr>';
while($row = mysql_fetch_array($result))
{
	$x=$row["sno"];
	$y=$row['email'];
echo  "<tr>".
	"<td>".$row['name']."</td>"."<td>".$row['mob']."</td>"."<td id='msg'>".$row['msg']."</td>"."<td>".$row['email']."</td>"."<td><button class='btn btn-danger' onclick='reply(".$x.")'>Reply</button></td><td><button style='text-shadow: 1px 1px black' class='btn btn-link' onclick='del(".$x.")'>Delete</button></td>"."</tr>";
}
echo '</table>';
?>
		</center>		
       </div>
	</div>
<br/><br/>
</body>
</html>