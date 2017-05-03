<?php
session_start();
if(isset($_SESSION["bus_edit"])){
	$id=$_SESSION["bus_edit"];
	unset($_SESSION["bus_edit"]);
$busname = $_POST['bus_name'];
$dat = $_REQUEST['date'];
$tim = $_REQUEST['time'];
$boarding=$_REQUEST['boarding'];
$conn = mysql_connect("localhost","root","");
if (!$conn)
{
	die("could not connect".mysql_error());
}
else{
	mysql_select_db("travel_db");
	}

mysql_select_db("travelbus_db");
$sql ="UPDATE bus_details 
	SET bus_name='$busname',date='$dat',time='$tim',boarding='$boarding'
	WHERE sno=$id";
$res = mysql_query($sql,$conn);
mysql_close($conn);
header("location:showbus_details.php?msg=busupdated");
}
else
	header("location:showbus_details.php?msg=nobusselected");
?>