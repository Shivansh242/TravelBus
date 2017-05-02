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
input.transparent,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
</style>

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
      <li><a href="index.php">BUS TICKETS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
	session_start();
	  if(isset($_SESSION["name"]))
	  echo '<li class="active"><a style="font-size:1.2em;"> Welcome '.$_SESSION["name"].'</a></li>'?>
    <?php if(isset($_SESSION["id"])) echo '<li><a href="view_booking_details.php">My Bookings</a></li>'; ?>
    <?php if(isset($_SESSION["id"])) echo '<li><a href="Edit_profile.php">Edit Profile</a></li>'; ?>
      <li class="active"><a href="#">Contact us</a></li>
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
        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    <p><a class="text-left" href="#" data-toggle="modal" data-dismiss="modal">Forgot Username/Password?</a></p>
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
  
<noscript>
	<h2>Enable Javascript First</h2>
</noscript>
<center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
</center>
	<center>
		<div id="rowdata" class="container" style="padding-right:10%">		<!-- start rowdata division -->
					<div class="container">
						<div class="row">		<!-- heading row -->
                        		<h1>Contact Us</h1>
										<p class="lead">Have a question or want further information?</p>
										<p>Fill in the short form and we will get back to you as soon as possible.</p>
                                        <br /><br />
              
                        </div>				<!-- end of heading row -->
                        <div class="row">
						<form class="form-horizontal" method="post" action="getcmd.php" onSubmit="return validateForm();">
                  <div class="col-sm-6">
  						<div class="form-group">
    						<div class="col-sm-12">
      						<input type="text" class="form-control input-lg transparent" name="name" placeholder="Your name here" required>
    						</div>
  						</div>
                        <?php
                        if(!isset($_SESSION["id"]))
  						echo '<div class="form-group">
    						<div class="col-sm-12"> 
      						<input type="email" class="form-control input-lg transparent" name="msg_email" placeholder="Email-id" required>
    						</div>
  						</div>';
						?>
                        <div class="form-group">
    						<div class="col-sm-12"> 
      						<input type="text" class="form-control input-lg transparent" name="mob_number" placeholder="Mobile number" required>
    						</div>
  						</div>
                  </div>
                  <div class="col-sm-6">
  						<div class="form-group">
    						<div class="col-sm-11"> 
      						<textarea type="textarea" style="resize:none;" rows="<?php
                        if(!isset($_SESSION["id"])) echo 6;
						else echo 4;?>" class="form-control input-lg" name="query" placeholder="Write your query here" required></textarea>
                            <input type="hidden" value="Contact_Us.php"  /> 
    						</div>
  						</div>
  						<div class="form-group"> 
    						<div class="col-sm-11">
      						<button type="submit" class="btn btn-danger btn-lg">Submit</button>
    						</div>
  						</div>
                 </div>
					</form>
							</div>
						</div>
                        <br /><br />
				</div>					<!-- ending rowdata division -->
		</center>   



</body>
</html>
