<?php
include 'Dbconn.php';
if(isset($_POST)){
	class mail_pass extends Dbconn{
		public function __construct(){
			parent::__construct();
			if($this->dbcon!=null){
				try{
					$email=$_POST["email"];
					$sql=$this->dbcon->prepare("SELECT `username`,`password` FROM `user_details` WHERE `email`='$email'");
					$sql->execute();
					if($sql->rowCount()==0){
						header("location:forgot_password.php?msg=notexist");
					}
					else{
						$row=$sql->fetch(PDO::FETCH_ASSOC);
						$pass=$row["password"];
						$user=$row["username"];
						if(mail($email,"Password of TravelBus","Greetings from TravelBus '$user', password for your TravelBus account is $pass .")){
							header("location:index.php?msg=pass_mailed");
						}
					}
				}
				catch(PDOException $e){
					echo $e->getMessage();
				}
			}
			$this->dbcon=null;
		}
	}
	new mail_pass;
}
else
header("location:forgot_password.php?msg=blank");
?>