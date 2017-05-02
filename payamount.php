<?php
session_start();
include 'Dbconn.php';
if(isset($_SESSION["id"]) && isset($_SESSION["busid"])){
class pay extends Dbconn{
	function __construct(){
		parent::__construct();
		try{
			if($this->dbcon!=null){
			$sql="INSERT INTO `booking` (`userid`,`name_primary`,`mobile_number`,`seats_booked`,`bus_id`,`email`,`adhar`) VALUES ('".$_SESSION["id"]."','".$_POST["pname"]."','".$_POST["mob_number"]."','".$_POST["nu_seat"]."','".$_SESSION["busid"]."','".$_POST["email"]."','".$_POST["adhar"]."')";
				$this->dbcon->exec($sql);
				$i=$_SESSION["seat"]-$_POST["nu_seat"];
				$v=$_SESSION["busid"];
			$sql1="UPDATE bus_details
			SET Seats=$i WHERE sno=$v";
				$this->dbcon->exec($sql1);
				header("location:index.php?msg=bookingsuccess");
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
new pay;
}
else
header("location:index.php?msg=bookingerror");
?>