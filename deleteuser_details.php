<?php
if(isset($_REQUEST["userid"]))
{
	$id=$_REQUEST["userid"];
$conn = mysql_connect("localhost","root","");
if (!$conn)
{
	die("could not connect".mysql_error());
}
else{
	mysql_select_db("travelbus_db");
	}

mysql_select_db("travelbus_db");
$sql ="delete from user_details where sno=$id";
$res = mysql_query($sql,$conn);
mysql_close($conn);
header("location:user_details.php?msg=Userdeleted");
}
?>