<?php
	session_start();
	if(!isset($_SESSION["id"]))
	header("location: ../index.php?msg=Login first");
	else if(isset($_REQUEST["msg"]))
		echo '<script>window.alert("'.$_REQUEST["msg"].'");</script>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Travel Bus</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/background.css" />
<link rel="stylesheet" href="../css/rowdata.css" />
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

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
    	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>
        			<span class="icon-bar"></span>                        
      		</button>
      <a style="font-size:1.4em;" class="navbar-brand" href="adminhome.php"><span class="glyphicon glyphicon-road"></span>TravelBus</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
    	<li><a href="showbus_details.php">Show Buses</a></li>
      <li class="active"><a href="addbus_details.php">Add Buses</a></li>
      <li><a href="user_details.php">View Users</a></li>
      <li><a href="showqueries.php">Show Quries</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    	<li class="active"><a style="font-size:1.2em;">Welcome Admin</a></li>'?>
      <li><?php if(isset($_SESSION["id"])) echo '<a href="../logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';?></li>
    </ul>
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
        <center> <h2>Bus details form</h2>
              <br />
	<form class="form-horizontal" action ="../getcmd.php" method="post">
			<div class="form-group">
				<label class="control-label col-sm-3" for="Bus Name">Bus Name</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="Bus Name" name="bus_name" required>
               	</div>
            </div>
            <div class="form-group">
				<label class="control-label col-sm-3" for="Bus bumber">Bus Nnumber</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="Bus number" name="bus_no" required>
               	</div>
            </div>
			<div class="form-group row">
            		<label class=" control-label col-sm-3" for="Ac">Ac</label>
                    <div class="radio col-sm-2">
      					<label><input type="radio" name="ac" value="Yes">Yes</label>
   					</div>
                    <div class="radio col-sm-2">
      					<label><input type="radio" name="ac" value="No" checked="checked">No</label>
   					</div>
            </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="From City">From City</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="From City" name="from_city" required>
                </div>
            </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="To City">To City</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="To City" name="to_city" required>
                 </div>
            </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="Date">Date</label>
				<div class="col-sm-7">
					<input type ="date" class="form-control" name="date" required>
                </div>
            </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="time">Time</label>
				<div class="col-sm-7">
					<input type ="time" class="form-control" name="time" required>
            	</div>
             </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="time">Seats</label>
				<div class="col-sm-7">
					<input placeholder="Seats" class="form-control" type ="text" name="seats" required>
                </div>
            </div>
			<div class="form-group">
				<label class="control-label col-sm-3" for="Cost Per">Fair</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="Fair" name="cost_per" required>
            	</div>
            </div>
            <div class="form-group">
				<label class="control-label col-sm-3" for="boarding">Boarding point</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="Boarding point" name="boarding" required>
            	</div>
            </div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-7">
					<button type ="submit" class="btn btn-danger" value="submit" name="submit">Submit</button>
                </div>
            </div>
	</form>
		</center>		
       </div>
	</div>


<br/><br/>


</body>
</html>
