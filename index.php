<?php session_start(); 
	if(isset($_SESSION["name"]))
		$user=$_SESSION["name"];
	if(isset($_REQUEST['msg'])){
		$msg=htmlspecialchars($_REQUEST['msg']);
		echo '<script>window.alert("'.$msg.'");</script>';
		$msg=null;
		unset($_REQUEST["msg"]);
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

<script>
	function showbus()
	{
		var res="";
		var from=document.getElementById("fromCity").value;
		var to=document.getElementById("toCity").value;
		var date=document.getElementById("date").value;
		var str=from+" "+to+" "+date;
		if(from=="" && to=="" && date=="")
			document.getElementById("data").innerHTML="";
		else
		{
			if(window.XMLHttpRequest)
			{
				xmlhttp=new XMLHttpRequest();
			}
			else
			{
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
				if(this.readyState==4 && this.status==200)
				{
					res=this.responseText;
					document.getElementById("data").innerHTML=res;
				}
			};
			xmlhttp.open("GET","connect.php?d="+str,true);
			xmlhttp.send();
		}
	}
	
	function book(x){
		<?php if(!isset($_SESSION["id"])){
			echo 'window.alert("login first");';
			echo "$('#signup').modal('show');";
			echo "return false";
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
    <?php if(isset($_SESSION["id"])) echo '<li><a href="view_booking_details.php">My Bookings</a></li>'; ?>
    <?php if(isset($_SESSION["id"])) echo '<li><a href="Edit_profile.php">Edit Profile</a></li>'; ?>
      <li><a href="Contact_Us.php">Contact us</a></li>
      <li><?php if(!isset($_SESSION["id"])) echo '<a href="#signup" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Login/Signup</a>';
	  			else
					echo '<a href="logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';
	   ?></li></ul>
       </div>
</nav>
    <!-- Modal -->
<div id="signin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onclick="change2();" >&times;</button>
        <h4 class="modal-title"><span><a href="#signup" data-toggle="modal" data-dismiss="modal"><i class="glyphicon glyphicon-arrow-left"></i></a></span> Login</h4>
      </div>
      <div class="container-fluid modal-body">
        		<!-- form -->
                <form method="post" action="login.php" class="form-horizontal">
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    					<input id="email" type="email" class="form-control" id="email" name="email" placeholder="Email" required>
  					</div>
                    <br>
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					<input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
  					</div>
                    <br>
                    <button style="float:right;" type="submit" class="btn btn-success">Login</button>
                    <p><a class="text-left" href="forgot_password.php" >Forgot Password?</a></p>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="signup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Signup</h4>
      </div>
      <div class="modal-body">
        
        <!-- form -->
        		<form method="post" action="getcmd.php" >
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    					<input id="user" type="text" class="form-control" name="username" placeholder="Username" required>
  					</div>
                    <br />
                    <div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    					<input id="email" type="email" class="form-control" id="email" name="email" placeholder="Email" required>
  					</div>
                    <br />
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					<input id="password" type="password" class="form-control" id="password" name="password" placeholder="Password" required>
  					</div>
                    <br />
                    <div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					<input id="password" type="password" class="form-control" id="password" name="cpassword" placeholder="Confirm Password" required>
  					</div>
                    <br />
                    <button style="float:right;" type="submit" class="btn btn-success">Signup</button>
                    <p>Already Have Account? <a class="text-left" href="#signin" data-toggle="modal" data-dismiss="modal">Signin</a></p>
				</form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
  
<div class="container-fluid" style="margin-top:5%; background:url("map.jpg");">
<center>
<form class="form-inline" >
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-bus"></i></span>
    <input type="text" class="form-control input-lg" name="fromCity" id="fromCity" placeholder="From" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-bus"></i></span>
    <input type="text" class="form-control input-lg" name="toCity" id="toCity" placeholder="To" required>
  </div>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
    <input type="date" class="form-control input-lg" name="date" id="date" placeholder="mm/dd/yy" min="<?php echo date("Y-m-d"); ?>" required>
  </div>
    <div class="form-group">
  <input class="btn btn-danger btn-lg" type="button" value="Search Buses" onclick="showbus();" />
</div>
</form>
<br>

	

</center>
</div>

<div class="container" id="data">
</div>
<noscript>
	<h2>Enable Javascript First</h2>
</noscript>

	<div class="container">
		<div id="rowdata" class="container-fluid bg-warning">
        <center>
        	<h2>Travel with us on <span class="glyphicon glyphicon-road"></span>TravelBus</h2>
            <br />
            <h3 style="margin:0% 10% 0% 10%; font-family:Brush Script Std, Brush Script MT, cursive; font-size:250%;" class="text-center text-danger">"And if travel is like love, it is, in the end, mostly because highted state of awareness, in which we are mindful, respective, undimmed by familiarity and ready to be transformed. That is why the best trips, like the best love affair never really end." <h2>~Pico iyer</h2></h3>
		</center>		
       </div>
       <center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
</center>
	</div>






<br/><br/><br/>


</body>
</html>
