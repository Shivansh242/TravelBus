<?php
	session_start();
	if(!isset($_SESSION["id"]))
		header("location:index.php?msg=logiinfirst");
	if(isset($_REQUEST["msg"])){
		if($_REQUEST["msg"]="bookingcanceled")
			echo '<script>window.alert("Booking Canceled successfully")</script>';
		else if($_REQUEST["msg"]="nobookingselected")
			echo '<script>window.alert("No booking selected")</script>';
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
<link rel="stylesheet" href="css/background.css" />
<link rel="stylesheet" href="css/rowdata.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
input,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
</style>

</head>

<body>
<script>
	function print(x){
		//window.open("print_ticket.php?booking_id="+x,"myWindow","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=yes, width=1350, height=650 ");
		window.open("print_ticket.php?booking_id="+x,"myWindow","toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=yes ");
	}
	function cancel(x){
		window.location.assign("cancel_booking.php?booking_id="+x);
	}
</script>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      		</button>
      <a style="font-size:1.4em;" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-road"></span>TravelBus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li><a href="index.php">BUS TICKETS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
	  if(isset($_SESSION["name"]))
	  echo '<li class="active"><a style="font-size:1.2em;"> Welcome '.$_SESSION["name"].'</a></li>'?>
      <?php if(isset($_SESSION["id"])) echo '<li class="active"><a href="view_booking_details.php">My Bookings</a></li>'; ?>
      <?php if(isset($_SESSION["id"])) echo '<li><a href="Edit_profile.php">Edit Profile</a></li>'; ?>
      <li><a href="Contact_Us.php">Contact us</a></li>
      <li><?php if(isset($_SESSION["id"])) echo '<a href="logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';
	  else echo '<a href="#signup" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Login/Signup</a>';
	   ?></li></ul>
       </div>
</nav>
  
  
  


  

<noscript>
	<h2>Enable Javascript First</h2>
</noscript>

	<div class="container">
    <center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
</center>
<div id="rowdata" class="container-fluid bg-warning">
        <center>
        <?php
			include 'Dbconn.php';
			class view_bookings extends Dbconn{
				public function __construct(){
					parent::__construct();
					try{
						if($this->dbcon!=null){
							$user=$_SESSION["id"];
							$sql=$this->dbcon->prepare("SELECT `bus_id`,`trans_id`,`seats_booked` FROM booking WHERE userid='$user'");
							$sql->execute();
							
							if(($sql->rowCount())==0)
								echo '<div id="rowdata" class="container-fluid bg-warning">
									<center>
									<h2 class="text-danger">*No Records Found*</h2>
									</center>
								</div>';
							else{
							date_default_timezone_set("Asia/Kolkata");
							echo '<h2> Your Bookings </h2>
							<div class="table-responsive"><table class="table table-hover">
<tr class="active">
	<th>Bus name</th><th>Ac</th><th>From City</th><th>To City</th><th>Date</th><th>Departure at</th><th>Seats booked</th><th>Cost paid</th><th></th><th></th>
</tr>';
								while($r=$sql->fetch(PDO::FETCH_ASSOC)){
									
							$seats=$r["seats_booked"];
							$busid=$r["bus_id"];
							$booking_id=$r["trans_id"];
							$sql1=$this->dbcon->prepare("SELECT * FROM `bus_details` WHERE sno='$busid'");
							$sql1->execute();
							$row=$sql1->fetch(PDO::FETCH_ASSOC);
									$time=strtotime($row['time']);
									$busdatetime=strtotime($row['date']." ".date("h:ia",$time));
									$curr_date_time=time()+3600;
	if('1'==$row['ac'])
	{$ac2='Yes';}
	else
	{$ac2='No';}
echo  "<tr>
<td>".$row['bus_name']."</td><td>".$ac2."</td><td>".$row['from_city']."</td><td>".$row['to_city']."</td><td>".$row['date']."</td><td>".date("h:ia",$time)."</td><td>".$seats."</td><td><i class='fa fa-inr'></i>".$row['cost_per']*$seats."</td>";

if($busdatetime>=$curr_date_time){
	echo "<td><button class='btn btn-danger' onclick='print(".$booking_id.")'>Print</button></td>
		<td><button class='btn btn-danger' onclick='cancel(".$booking_id.")'>Cancel booking</button></td>";
		}
	echo "</tr>";
								}
							}
							echo '</table></div>';
						}
						$this->dbcon=null;
					}
					catch(PDOException $e){
						echo $e->getMessage();
					}
				}
			}
			new view_bookings;
		?>
        </center>
        </div>
	</div>


<br/><br/>


</body>
</html>
