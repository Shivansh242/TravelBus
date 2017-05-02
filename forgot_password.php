<?php
if(isset($_REQUEST["msg"])){
	if($_REQUEST["msg"]=="notexist")
		echo '<script>window.alert("Email-id doesnot exist");</script>';
	else if($_REQUEST["msg"]=="blank")
		echo '<script>window.alert("Email cannot be left blank");</script>';
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
input.transparent,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
#rowdata{
	background: rgba(255, 255, 255, 0.5);
	margin:2% 0 2% 0;
	padding:1%;
	border-style:inset;
	border-width:0px 0px 1px 0px;
	border-radius:5px;
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
      <li><a href="Contact_Us.php">Contact us</a></li>
	</ul>
       </div>
</nav>
  
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
                        		<h1>Forgot Password?</h1>
										<p class="lead">Fill in your registered email id..</p>
										<p>If you are a registered user, Your password will be mailed to your email-id.</p>
                                        <br /><br />
              
                        </div>				<!-- end of heading row -->
                        <div class="row">
						<form class="form-horizontal" method="post" action="mail_password.php" >
                  <div class="col-sm-8">
  						<div class="form-group">
    						<div class="col-sm-8 col-sm-offset-4">
      						<input type="email" class="form-control input-lg transparent" name="email" placeholder="Resgistered Email-id" required>
    						</div>
  						</div>
                   </div>
                   <div class="col-sm-4">
                        <div class="form-group"> 
    						<div class="col-sm-2">
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
