<?php
session_start();
function test_input($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $data;
}


if(isset($_POST["email"]))					/* Call for resgistrtion form */
{		
	extract($_POST);
	if($username!="" && $email!="" && $password!=""){
		$username=test_input($username);
		$password=test_input($password);
		if (!preg_match("/^[a-zA-Z ]*$/",$username)){
  				header("location: index.php?msg=Only letters and white space allowed for username"); 
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      			header("Location: index.php?msg=Invalid Entry of Email Id");
    		}
		else if (strlen($password)<8 || strlen($password)>16){
				header("Location: index.php?msg=Password length should be greater than 8 and less than 16 characters");
			}
		else if ($password!=$cpassword){
				header("Location: index.php?msg=Confirm password didn't match");
			}
		else{
			include 'SqlHelper.php';
			$signup=new Signup($username,$email,$password);
			if(!$signup)
				header("Location: index.php?msg=Some error occurred");
		}
	}
	else
	header("Location:index.php?msg=Username,email or password cannot be left blank");
}


else if(isset($_POST["secure_code"]))
{				/* Call for secure code confirmation */
	extract($_POST);
	if($secure_code!=""){
		$secure_code=test_input($secure_code);
		if (!preg_match("/^[0-9]{1,10}$/",$secure_code)) {
      			header("location:Signup.php?msg=Invalid Entry for Secure code");
    		}
		else{
			include 'SqlHelper.php';
			$confirm=new Confirm($secure_code);
			if(!$confirm)
				header("location:index.php?msg=Some error occurred");
		}
	}
	else
	header("location:Signup.php?msg=Secure code cannot be left blank");
}


else if(isset($_POST["uname_edit"]) || isset($_POST["pass_edit"])){				/*Call for Profile edit and password change */
	extract($_POST);
	if(isset($uname_edit)){
		$pass_edit="";
		$uname_edit=test_input($uname_edit);
		if(!preg_match("/^[a-zA-Z ]*$/",$uname_edit) || $uname_edit==""){
  				header("location:Edit_profile.php?msg=Only letters and white space allowed for username"); 
		}
		else{
			include 'SqlHelper.php';
			$edit=new EditUser($uname_edit,$pass_edit);
			if(!$edit)
				header("location:Edit_profile.php?msg=Some error occurred");
		}
	}
	else if(isset($pass_edit)){
		$uname_edit="";
		if($cur_pass!="" && $pass_edit!="" && $cpass_edit!=""){
			$cur_pass=test_input($cur_pass);
			$pass_edit=test_input($pass_edit);
			$cpass_edit=test_input($cpass_edit);
			if($cur_pass!=$_SESSION["cur_pass"])
				header("location:Edit_profile.php?msg=Incorrent current password");
			else if($pass_edit!=$cpass_edit)
				header("location:Edit_profile.php?msg=Confirm password must be same");
			else{
				unset($_SESSION["cur_pass"]);
				include 'SqlHelper.php';
				$update_pass=new EditUser($uname_edit,$pass_edit);
				if(!$update_pass)
					header("location:Edit_profile.php?msg=Some error occurred");
			}
		}
		else
			header("location:Edit_profile.php?msg=Current and new password cannot be left blank");
	}
}


else if(isset($_POST["query"])){		/* Call for Message and Query */
	extract($_POST);
	if(!isset($msg_email) && isset($_SESSION["id"]))
		$msg_email=$_SESSION["id"];
	if($name!="" && $msg_email!="" && $mob_number!="" && $query!=""){
		$name=test_input($name);
		$mob_number=test_input($mob_number);
		$query=test_input($query);
		if (!preg_match("/^[a-zA-Z ]*$/",$name)){
  				header("location:Contact_Us.php?msg=Only letters and white space allowed for name"); 
		}
		else if(!filter_var($msg_email, FILTER_VALIDATE_EMAIL)) {
      			header("Location:Contact_Us.php?msg=Invalid Entry of Email Id");
    	}
		else if(!preg_match("/^([789]{1})([234789]{1})([0-9]{8})$/",$mob_number)){
				header("Location:Contact_Us.php?msg=Invalid mobile number");
		}
		else if(!preg_match("/^[a-zA-Z 0-9]*$/",$query)){
				header("Location:Contact_Us.php?msg=Only letters, numbers and white space are allowed in the query");
		}
		else{
			include 'SqlHelper.php';
			$query=new Query($name,$msg_email,$mob_number,$query);
			if(!$query)
			header("location:Contact_Us.php?msg=Some error occurred");
		}
	}
	else
			header("location:Contact_Us.php?msg=Name, email, mobile number or message can be left blank");
}


else if(isset($_POST["bus_name"])){				/* Call for Add bus */
	foreach($_POST as $key=>$val){
		$_POST[$key]=test_input($val);
	}
	extract($_POST);
	date_default_timezone_set("Asia/Kolkata");
	if(!isset($ac))
	$ac="No";
	if($bus_name!="" && $bus_no!="" && $ac!="" && $from_city!="" && $to_city!="" && $date!="" && $time!="" && $seats!="" && $cost_per!="" && $boarding!=""){
		if (!preg_match("/^[a-zA-Z ]*$/",$bus_name)){
  				header("location:admin/addbus_details.php?msg=Only letters and white space allowed for bus name"); 
		}
		else if(!preg_match("/^[a-zA-Z 0-9]*$/",$bus_no)){
  				header("location:admin/addbus_details.php?msg=Only letters,numbers and white space allowed for bus number"); 
		}
		else if(!($ac=="Yes" || $ac=="No")){
				header("location:admin/addbus_details.php?msg=Invalid input for Ac"); 
		}
		else if (!preg_match("/^[a-zA-Z ]*$/",$from_city) || !preg_match("/^[a-zA-Z ]*$/",$to_city)){
  				header("location:admin/addbus_details.php?msg=Only letters and white space allowed for city name"); 
		}
		else if(!($date=date_create($date))){
			header("location:admin/addbus_details.php?msg=Invalid date format");
		}
		else if(!date_create($time)){
			header("location:admin/addbus_details.php?msg=Invalid time format");
		}
		else if(strtotime(date_format($date,"Y/m/d")." ".date("h:ia",strtotime($time)))<(time()+24*3600)){
			header("location:admin/addbus_details.php?msg=New bus can be added atlest 24 hours before time");
		}
		else if(!preg_match("/^([0-9]{2,3})$/",$seats)){
				header("Location:admin/addbus_details.php?msg=Invalid entry for number of seats");
		}
		else if(!preg_match("/^([0-9]{2,5})$/",$cost_per)){
				header("Location:admin/addbus_details.php?msg=Invalid entry for cost");
		}
		else if(!preg_match("/^[a-zA-Z 0-9]*$/",$boarding)){
  				header("location:admin/addbus_details.php?msg=Only letters,numbers and white space allowed for boarding point"); 
		}
		else{
			include 'SqlHelper.php';
			$addbus=new AddBus($bus_name,$bus_no,$ac,$from_city,$to_city,date_format($date,"Y/m/d"),date("H:i",strtotime($time)),$seats,$cost_per,$boarding);
			if(!$addbus)
				header("location:admin/addbus_details.php?msg=Some error occured");
		}
	}
	else
		header("location:admin/addbus_details.php?msg=No field can be left blank");
}


else if(isset($_POST["bus_name_edit"])){			/* Call for Edit bus */
	extract($_POST);
	if($bus_name_edit!="" && $date!="" && $time!="" && $boarding!=""){
	$bus_name=test_input($bus_name_edit);
	$date=test_input($date);
	$time=test_input($time);
	$boarding=test_input($boarding);
	if (!preg_match("/^[a-zA-Z ]*$/",$bus_name)){
  		header("location:admin/Updatebus_details.php?msg=Only letters and white space allowed for bus name"); 
	}
	else if(!($date=date_create($date))){
		header("location:admin/Updatebus_details.php?msg=Invalid date format");
	}
	else if(!date_create($time)){
		header("location:admin/Updatebus_details.php?msg=Invalid time format");
	}
	else if(strtotime(date_format($date,"Y/m/d")." ".date("h:ia",strtotime($time)))<(time()+24*3600)){
			header("location:admin/Updatebus_details.php?msg=New bus can be added atlest 24 hours before time");
	}
	else if(!preg_match("/^[a-zA-Z 0-9]*$/",$boarding)){
  		header("location:admin/Updatebus_details.php?msg=Only letters,numbers and white space allowed for boarding point"); 
	}
	else{
		include 'SqlHelper.php';
		$editbus=new EditBus($bus_name,date_format($date,"Y/m/d"),date("H:i",strtotime($time)),$boarding);
		if(!$editbus)
			header("location:Updatebus_details.php?msg=Some error occured");
	}
	}
	else
		header("location:Updatebus_details.php?msg=No fields can be left blank");
}


else
	header("location:index.php?msg=Invalid submission");
?>