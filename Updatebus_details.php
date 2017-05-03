<?php
	session_start();
	if(!isset($_SESSION["id"]))
	header("location: ../index.php?msg=Login first");
	if(isset($_REQUEST["msg"]))
		echo '<script>window.alert("'.$_REQUEST["msg"].'");</script>';
	if(isset($_REQUEST["busid"])){
		$_SESSION["bus_edit"]=$_REQUEST["busid"];
	}
	else{
		echo '<script>window.alert("No bus selected");
		window.location.assign("showbus_details.php");
		</script>';
		
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
    	<li class="active"><a href="showbus_details.php">Show Buses</a></li>
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
        <center> <h2>Update bus details</h2>
              <br />
	<form class="form-horizontal" action ="updatebus.php" method="post">
			<div class="form-group">
				<label class="control-label col-sm-3" for="Bus Name">Bus Name</label>
				<div class="col-sm-7">
					<input type ="text" class="form-control" placeholder="Bus Name" name="name" required>
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
