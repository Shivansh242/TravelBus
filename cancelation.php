<?php
	session_start();
	if(!isset($_SESSION["id"]))
		header("location:index.php?msg=notloggedyet");
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
      <li><a href="index.php">BUS TICKETS</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
    <?php
	  if(isset($_SESSION["name"]))
	  echo '<li class="active"><a style="font-size:1.2em;"> Welcome '.$_SESSION["name"].'</a></li>'?>
    <li><a href="#">Print tickets</a></li>
      <li class="active"><a href="cancelation.php">Cancel tickets</a></li>
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
        	
		</center>		
       </div>
	</div>


<br/><br/>


</body>
</html>
