<?php
if(isset($_REQUEST["busid"])){
	$id=$_REQUEST["busid"];
$conn = mysql_connect("localhost","root","");
if (!$conn)
{
	die("could not connect".mysql_error());
}
else{
	mysql_select_db("travel_db");
	}

mysql_select_db("travelbus_db");
$sql ="delete from bus_details where sno=$id";
$res = mysql_query($sql,$conn);
mysql_close($conn);
header("location:showbus_details.php?msg=busdeleted");
}
else
	header("location:showbus_details.php?msg=nobusselected");
?>