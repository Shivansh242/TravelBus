<?php
	session_start();
	if(isset($_SESSION["id"])){
		if(isset($_REQUEST["booking_id"])){
			$_SESSION["booking_id"]=$_REQUEST["booking_id"];
		}
		else
		header("location:view_booking_details.php?msg=nobookingselected");
	}
	else
	header("location:index.php?msg=loginfirst");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Travel Bus</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
	window.print();
  </script>
  <style>
  
  	h2{
	font-family:Arial, Helvetica, sans-serif;
	text-align: center;
}
#rowdata{
	background: rgba(255, 255, 255, 0.5);
	margin:3% 0 3% 0;
	padding:1%;
	border-style:inset;
	border-width:0px 0px 1px 0px;
	border-radius:5px;
}
@media print {
    a {
        display:none;
    }
}
  </style>
  </head>
<body>

	<div class="container">
     <center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus e-ticket</h2>
</center>
<hr />
<p class="text-center">Greeting from TravelBus, Please take this ticket to the boarding point with you to claim your seat. Happy Journey!!</p>
<?php
	include 'Dbconn.php';
	class print_ticket extends Dbconn{
		public function __construct(){
			parent::__construct();
			try{
				if($this->dbcon!=null){
					$trans_id=$_SESSION["booking_id"];
					$sql=$this->dbcon->prepare("SELECT * FROM `booking` WHERE `trans_id`=$trans_id");
					$sql->execute();
					$data=$sql->fetch(PDO::FETCH_ASSOC);
					$name=$data["name_primary"];
					$seats=$data["seats_booked"];
					$bus_id=$data["bus_id"];
					$email=$data["email"];
					$adhar=$data["adhar"];
					$sql=$this->dbcon->prepare("SELECT * FROM `bus_details` WHERE `sno`=$bus_id");
					$sql->execute();
					$data=$sql->fetch(PDO::FETCH_ASSOC);
					$amount=$seats*$data["cost_per"];
					if($data["ac"]==1)
						$ac="AC";
					else
						$ac="Non-AC";
						
if (CRYPT_STD_DES == 1)
{
	$key=crypt($data["bus_name"],$name); 
}
else
{
	$key=crc32($data["bus_name"]+$name);
}
					echo '<div id="rowdata">
						<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">Primary passenger name: '.$name.'</div>
						<div class="col-sm-6 col-xs-6">Adhar no: '.$adhar.'</div>
					</h2></div>
					<br />
					<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">Bus name: '.$data["bus_name"].'</div>
						<div class="col-sm-6 col-xs-6">Bus type: '.$ac.'</div>
					</h2></div>
					<br />
					<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">Bus number: '.$data["bus_no"].'</div>
						<div class="col-sm-6 col-xs-6">Boarding point: '.$data["boarding"].'</div>
					</h2></div>
					<br />
					<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">From: '.$data["from_city"].'</div>
						<div class="col-sm-6 col-xs-6">To: '.$data["to_city"].'</div>
					</h2></div>
					<br />
					<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">Dated: '.$data["date"].'</div>
						<div class="col-sm-6 col-xs-6">Departure at: '.date("h:ia",strtotime($data["time"])).'</div>
					</h2></div>
					<br />
					<div class="row"><h2>
						<div class="col-sm-6 col-xs-6">Amount Paid: <i class="fa fa-inr"></i>'.$amount.'</div>
						<div class="col-sm-6 col-xs-6">Number of seats: '.$seats.'</div>
					</h2></div>
					<div class="row"><h2>
					<div class="col-sm-12 col-xs-12">Key: '.$key.'</div>
					</h2></div>
					</div>';
				}
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}
	new print_ticket;
?>
<p class="text-center">Key value ensures that ticket for TravelBus must not be forged.</p>
</div>
</body>