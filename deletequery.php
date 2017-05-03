<?php
	session_start();
	if(isset($_REQUEST["queryid"])){
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
$id=$_REQUEST["queryid"];
$result=mysql_query("DELETE from query_info WHERE sno=$id;");
unset($_REQUEST["queryid"]);
header("location:showqueries.php?msg=QueryDeleted");
}
else
	header("location:showqueries.php?msg=noqueryselected");

?>