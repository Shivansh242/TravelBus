<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Travel Bus Signup Confirmation</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/background.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	$(document).ready(function(){
    	$('#confirm').modal('show');
	});
</script>
</head>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a style="font-size:1.4em;" class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-road"></span>TravelBus</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">BUS TICKETS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="Contact_Us.php">Contact us</a></li>
      <li><a href="#confirm" data-toggle="modal"><span class="glyphicon glyphicon-user"></span>Confirm</a></li>
</nav>
  
  
  
 <div id="confirm" class="modal fade" role="dialog">
  <div class="modal-dialog">


    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span><i class="glyphicon glyphicon-lock"></i></span> Confirm Secure Code</h4>
      </div>
      <div class="container-fluid modal-body">
   
                <form class="form-horizontal" method="post" action="getcmd.php" id="confirm" onsubmit="conf();">
                	<br />
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-briefcase"></i></span>
    					<input id="scode" name="secure_code" type="text" class="form-control" placeholder="Secure code here" required>
  					</div>
                    <br />
  						<input class="btn btn-success" style="float:right;" type="submit" value="Confirm" />
				</form>
                <p class="text-center text-danger">Secure code has been send to your email-id</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div> 	
  

<div id="data">
</div>

</body>
</html>