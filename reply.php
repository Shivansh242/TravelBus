<?php
	session_start();
	if(isset($_SESSION["queryid"])){
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
$id=$_SESSION["queryid"];
unset($_SESSION["queryid"]);
$result = mysql_query("SELECT email FROM query_info WHERE sno=$id");
$row = mysql_fetch_array($result);
$email=$row["email"];
mail($email,"Query reply from TravelBus",$_POST["reply"]);
$result=mysql_query("DELETE from query_info WHERE sno=$id;");
header("location:showqueries.php?msg=replysend");
}
else
	header("location:showqueries.php?msg=noqueryselected");

?>