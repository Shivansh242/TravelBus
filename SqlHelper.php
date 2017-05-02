<?php
	session_start();
	include 'Dbconn.php';
	class Signup extends Dbconn			/*Class for signup objesct*/
	{
		public function __construct($username,$email,$password)
		{
			parent:: __construct();
			try{
				if($this->dbcon!=null)
				{
					$sql=$this->dbcon->prepare("SELECT * FROM `user_details` WHERE `email`='$email'");
					$sql->execute();
					if(($sql->rowcount())==0){
						$_SESSION["username"]=$username;
						$_SESSION["email"]=$email;
						$_SESSION["password"]=$password;
						$hash = ezmlm_hash($email);
						$code=$hash."".rand();
						mail($_POST["email"],"Secure code from TravelBus","Greetings from TravelBus, here is your secure code '".$code."'");
						$_SESSION["code"]=$code;
						header("Location:Signup.php?msg=Secure code has been send to your email id");
					}
					else if(($sql->rowcount())==1){
						header("Location:index.php?msg=Email-Id already exists");
					}
					$this->dbcon!=null;
					return true;
				}
				else{
					return false;
				}
				
			}catch(PDOException $e){
				echo "Error message: ".$e->getMessage();
			}
		}
	}
	
	class Confirm  extends Dbconn			/*Class for secure code confirmation objesct*/
	{
		public function __construct($secure_code)
		{
			parent:: __construct();
			try{
				if($this->dbcon!=null)
				{
					if($_SESSION["code"]==$secure_code){
					$username=$_SESSION["username"];
					$email=$_SESSION["email"];
					$password=$_SESSION["password"];
					$sql="INSERT INTO `user_details` (`username`,`email`,`password`) VALUES ('$username','$email','$password')";
					$this->dbcon->exec($sql);
					$this->dbcon=null;
					$_SESSION["username"]==null;
					$_SESSION["email"]=null;
					$_SESSION["password"]=null;
					$_SESSION["code"]=null;
					header("location:index.php?msg=Successfully registered, please login to continue");
					return true;
					}
			else
			header("location:Signup.php?msg=Invalid secure code");
				}
				else 
					return false;
				
			}catch(PDOException $e){
				echo "Error message: ".$e->getMessage();
			}
		}
	}
	
	class EditUser extends Dbconn			/*Class for Edit user objesct*/
	{
		public function __construct($uname_edit,$pass_edit)
		{
			parent::__construct();
			try{
				$id=$_SESSION["id"];
				if($this->dbcon!=null)
				{
					if($uname_edit!=""){
						$sql=$this->dbcon->query("UPDATE `user_details` SET `username`='$uname_edit' WHERE `email`='$id'");
						$sql->execute();
					}
					if($pass_edit!=""){
						$sql=$this->dbcon->query("UPDATE `user_details` SET `password`='$pass_edit' WHERE `email`='$id'");
						$sql->execute();
					}
				}
				$this->dbcon=null;
				header("location:Edit_profile.php?msg=saved");
			}
			catch(PDOException $e){
				echo "Error message: ".$e->getMessage();
			}
		}
	}
	
	
	class Query extends Dbconn{						/*Class for Message objesct*/
		public function __construct($name,$msg_email,$mob_number,$query){
			parent::__construct();
			try{
				if($this->dbcon!=null){
					$sql="INSERT INTO `query_info` (`name`,`email`,`mob`,`msg`) VALUES ('$name','$msg_email',',$mob_number','$query')";
					$this->dbcon->exec($sql);
					$this->dbcon=null;
					header("location:index.php?msg=Message saved");
				}
			}
			catch(PDOException $e){
				echo "Error message: ".$e->getMessage();
			}
		}
	}
	
	
	class AddBus extends Dbconn{
		public function __construct($bus_name,$bus_no,$ac,$from_city,$to_city,$date,$time,$seats,$cost_per,$boarding){
			parent::__construct();
			try{
				if($this->dbcon!=null){
					if($ac=="Yes")
						$acc=1;
					else
						$acc=0;
					$sql ="INSERT INTO `bus_details` (`bus_name`,`bus_no`,`ac`,`from_city`,`to_city`,`date`,`time`,`Seats`,`total_seat`,`cost_per`,`boarding`)
					VALUES ('$bus_name','$bus_no','$acc','$from_city','$to_city','$date','$time','$seats','$seats','$cost_per','$boarding')";
					$this->dbcon->exec($sql);
					$this->dbcon=null;
					header("location:admin/addbus_details.php?msg=Bus successfully added");
				}
			}
			catch(PDOException $e){
				echo "Error message: ".$e->getMessage();
			}
		}
	}
?>