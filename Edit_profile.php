<?php
session_start();
	if(isset($_SESSION["id"])){
		if(isset($_REQUEST["msg"])){
				echo '<script>window.alert("'.$_REQUEST["msg"].'");</script>';
				unset($_REQUEST["msg"]);
		}
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
input.transparent,textarea{
       background-color:rgba(255, 255, 255, 0.8) !important;
       border:none !important;
    }
</style>

</head>

<body>
<script>
	function change(){
		document.getElementById("name").style.display="none";
		document.getElementById("input_name").type="text";
		document.getElementById("submit").type="submit";
	}
	function open_modal(){
		$('#change_pass').modal('show');
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
    <?php if(isset($_SESSION["id"])) echo '<li><a href="view_booking_details.php">My Bookings</a></li>'; ?>
    <?php if(isset($_SESSION["id"])) echo '<li class="active"><a href="Edit_profile.php">Edit Profile</a></li>'; ?>
      <li><a href="Contact_Us.php">Contact us</a></li>
      <li><?php if(isset($_SESSION["id"])) echo '<a href="logout.php"><span class="glyphicon glyphicon-user"></span>logout</a>';
	   ?></li></ul>
       </div>
</nav>
  
<noscript>
	<h2>Enable Javascript First</h2>
</noscript>
<center>
<h2><span class="glyphicon glyphicon-road"></span>TravelBus</h2>
</center>


<div id="change_pass" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
        
        <!-- form -->
        		<form method="post" action="getcmd.php" >
                    <div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
    					<input type="password" class="form-control" name="cur_pass" placeholder="Current password" required>
  					</div>
                    <br />
  					<div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					<input type="password" class="form-control" name="pass_edit" placeholder="New Password" required>
  					</div>
                    <br />
                    <div class="input-group">
    					<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    					<input type="password" class="form-control" name="cpass_edit" placeholder="Confirm Password" required>
  					</div>
                    <br/>
				
        
      </div>
      <div class="modal-footer">
        <button style="position:center;" type="submit" class="btn btn-success">Confirm</button>
        </form>
      </div>
    </div>

  </div>
</div>


	<center>
		<div id="rowdata" class="container" style="padding-right:10%">		<!-- start rowdata division -->
					<div class="container">
						<div class="row">		<!-- heading row -->
                        		<h1>Edit your profile</h1>
                                        <br /><br />
              
                        </div>				<!-- end of heading row -->
                        <?php
						if(isset($_SESSION["id"])){
						include 'Dbconn.php';
						class profile extends Dbconn{
							public function __construct(){
							parent::__construct();
								try{
									if($this->dbcon!=null){
										$user=$_SESSION["id"];
										$sql=$this->dbcon->query("SELECT * FROM `user_details` WHERE `email`='$user'");
										$sql->execute();
										$row=$sql->fetch(PDO::FETCH_ASSOC);
										$_SESSION["cur_pass"]=$row["password"];
										echo $_SESSION["cur_pass"];
										echo '<div class="row"><center>
                        
                        <form class="form-horizontal" method="post" action="getcmd.php">
                        <div class="form-group">
    						<div class="col-sm-5">
							<h3 id="name" class="pull-left">Username: '.$row["username"].'</h3>
      						<input id="input_name" type="hidden" class="form-control input-lg transparent" name="uname_edit" value="'.$row["username"].'" placeholder="Your name here" required>
    						</div>
							<div class="col-sm-5">
								<input type="button" class="btn btn-danger" value="Edit" onclick="change();">
							</div>
  						</div>
						<hr>
                        <div class="form-group">
    						<div class="col-sm-5">
							<input id="input_cur" type="hidden" class="form-control input-lg transparent" name="cur_pass" placeholder="current password" required><br />				
							<input id="input_pass" type="hidden" class="form-control input-lg transparent" name="pass_edit" placeholder="new passwoord" required><br />
							<input id="input_cpass" type="hidden" class="form-control input-lg transparent" name="cpass_edit" placeholder="confirm password" required>
    						</div>
							<div class="col-sm-5">
								<input type="button" class="btn btn-danger" value="Change Password" onclick="open_modal();">
							</div>
  						</div>
						<div class="col-sm-10">
								<input id="submit" type="hidden" class="btn btn-danger" value="save changes">
							</div>
                        </form>
						
						</center></div>';
										
									}
									$this->dbcon=null;
								}
								catch(PDOException $e){
									echo "Sql error:".$e->getMessage();
								}
							}
						}
						new profile;
						}
						?>
                        
						</div>
                        <br /><br />
				</div>					<!-- ending rowdata division -->
		</center>   



</body>
</html>
