<?php
	session_start();
	if(!isset($_SESSION["id"]))
		header("location:index.php?msg=notloggedyet");
	else if(isset($_POST["btn"]))
	{
		$_SESSION["busid"]=$_POST["btn"];
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
html,body{
	height:100%;
	overflow:auto;
}
body{
background-image: url("header-bg.jpg");
background-size:cover;
background-repeat:repeat;
background-position:center;
position:relative;
min-height:100%;
top:0px;
}
h2{
	font-family:Arial, Helvetica, sans-serif;
	text-align: center;
}
input,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
#rowdata{
	background: rgba(255, 255, 255, 0.5);
	margin:3% 0 3% 0;
	padding:1%;
	border-style:inset;
	border-width:0px 0px 1px 0px;
	border-radius:5px;
}
</style>
<script>
	
	
	function book(x){
		<?php if(!isset($_SESSION["id"])){
			echo 'window.alert("login first");';
			echo "$('#signin').modal('show');";
		}
		 ?>
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
      <a style="font-size:1.4em;" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-road"></span>TravelBus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">BUS TICKETS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
	  if(isset($_SESSION["name"]))
	  echo '<li class="active"><a style="font-size:1.2em;"> Welcome '.$_SESSION["name"].'</a></li>'?>
    <li><a href="#">Print tickets</a></li>
      <li><a href="#">Cancel tickets</a></li>
      <li><a href="Contact_Us.php">Contact us</a></li>
      <li><?php if(isset($_SESSION["id"])) echo '<a href="logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';
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
        	<h2>User booking form</h2>
        	<?php
			if(isset($_SESSION["busid"])){
				include 'Dbconn.php';
				class booking extends Dbconn{
					public function __construct(){
						parent::__construct();
						try{
							if($this->dbcon!=null){
								$sql=$this->dbcon->prepare("SELECT `bus_name`,`Seats`,`date`,`time`,`from_city`,`to_city`,`cost_per` FROM `bus_details` WHERE sno='".$_SESSION["busid"]."'");
								$sql->execute();
								$r=$sql->fetch(PDO::FETCH_ASSOC);
								$_SESSION["cost"]=$r["cost_per"];
								$_SESSION["seat"]=$r["Seats"];
								echo '
								<script>
								function calculate(){
		document.getElementById("amount").innerHTML=(document.getElementById("seat").value)*'.$r["cost_per"].';
		if(document.getElementById("seat").value>'.$r["Seats"].'){
		window.alert("sorry not more than '.$r["Seats"].' seats available");
		document.getElementById("seat").value='.$r["Seats"].';
		}
								}
								</script>
								<div class="row">
								<br />
								<div class="col-md-4"><h2><i class="fa fa-bus"></i> '.$r["bus_name"].'</h1></div>
								<div class="col-md-3"><h2>Dated '.$r["date"].'</h1></div>
								<div class="col-md-5"><h2>Departure at '.date("h:ia",strtotime($r["time"])).'</h1></div>
								</div>
								<br /><br /><br />
                        <div class="row">
						<form class="form-horizontal" method="post" action="payamount.php">
                  <div class="col-sm-6">
  						<div class="form-group">
    						<div class="col-sm-10 col-md-offset-1 col-sm-offset-1">
      						<input type="text" class="form-control input-lg" name="pname" placeholder="Name of Primary passenger" required>
    						</div>
  						</div>
  						<div class="form-group">
    						<div class="col-sm-10 col-md-offset-1 col-sm-offset-1"> 
      						<input type="email" class="form-control input-lg" name="email" placeholder="Email-id" required>
    						</div>
  						</div>
                        <div class="form-group">
    						<div class="col-sm-10 col-md-offset-1 col-sm-offset-1"> 
      						<input type="text" class="form-control input-lg" name="mob_number" placeholder="Mobile number" required>
    						</div>
  						</div>
						<div class="form-group">
    						<div class="col-sm-10 col-md-offset-1 col-sm-offset-1"> 
      						<input type="text" class="form-control input-lg" name="adhar" placeholder="Adhar number" required>
    						</div>
  						</div>
                  </div>
                  <div class="col-sm-6">
  						<div class="form-group">
    						<div class="col-sm-5 col-md-offset-1 col-sm-offset-1">
      						<input type="number" class="form-control input-lg" name="nu_seat" id="seat" min="1" max='.$r["Seats"].' placeholder="Number of seats to book" onchange="calculate();" onkeyup="calculate();" required>
    						</div>
							<div class="col-sm-5"><h2><i class="fa fa-inr"></i>'.$r["cost_per"].' per seat</h2></div>
  						</div>
						<div class="form-group">
    						<div class="col-sm-10 col-md-offset-1 col-sm-offset-1">
								<h2>Total Fair: <i class="fa fa-inr"></i><span id="amount">0</span></h2>
    						</div>
  						</div>
  						<div class="form-group"> 
    						<div class="col-sm-5 col-md-offset-6 col-sm-offset-6">
      						<button type="submit" class="btn btn-danger btn-lg">Proceed to pay</button>
    						</div>
  						</div>
						<br /><br />
                 </div>
					</form>
							</div>';
							}
						}
						catch(PDOException $e){
							echo $e->getMessage();
						}
					}
				}
				new booking;
			}
			else
			echo "login first";
			?>
		</center>		
       </div>
	</div>


<br/><br/>


</body>
</html>
