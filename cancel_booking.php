<?php
session_start();
include 'Dbconn.php';
	if(isset($_SESSION["id"])){
		if(isset($_REQUEST["booking_id"])){
			
			class cancel_booking extends Dbconn{
				public function __construct(){
					parent::__construct();
					if($this->dbcon!=null){
						try{
							$id=$_REQUEST["booking_id"];
							echo $id;
							$sql=$this->dbcon->prepare("SELECT `bus_id`,`seats_booked` FROM `booking` WHERE `trans_id`=$id");
							$sql->execute();
							$row=$sql->fetch(PDO::FETCH_ASSOC);
							$bus_id=$row["bus_id"];
							$seats_to_add=$row["seats_booked"];
							$sql=$this->dbcon->prepare("SELECT `Seats` FROM `bus_details` WHERE `sno`=$bus_id");
							$sql->execute();
							$row=$sql->fetch(PDO::FETCH_ASSOC);
							$seats=$row["Seats"];
							$num=$seats+$seats_to_add;
							$sql=$this->dbcon->prepare("UPDATE `bus_details` SET `Seats`=$num WHERE `sno`=$bus_id");
							$sql->execute();
							$sql=$this->dbcon->prepare("DELETE FROM `booking` WHERE `trans_id`=$id");
							$sql->execute();
							header("location:view_booking_details.php?msg=bookingcanceled");
						}
						catch(PDOException $e){
							echo $e->getMessage();
						}
					}
				}
			}
			new cancel_booking;
		}
		else
		header("location:view_booking_details.php?msg=nobookingselected");
	}
	else
	header("location:index.php?msg=loginfirst");
?>