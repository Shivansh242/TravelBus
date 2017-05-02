<?php
session_start();
include 'Dbconn.php';
class login extends Dbconn{
	public function __construct(){
		parent::__construct();
		try{
			if($this->dbcon!=null){
				if(empty($_POST))
					$sql=null;
				else
					$sql=$this->dbcon->prepare("SELECT `username`,`password` FROM `user_details` WHERE email='".$_POST['email']."'");
					$sql->execute();
					$r=$sql->fetch(PDO::FETCH_ASSOC);
				if($r==null)
					header('location:index.php?msg=emailerr');
				else if($r["password"]==$_POST["password"]){
						$_SESSION["id"]=$_POST["email"];
						$_SESSION["name"]=$r["username"];
						if($_SESSION["id"]=="admin@gmail.com")
							header("location:admin/adminhome.php");
						else
						header("location:index.php?msg=success");
					}
				else
					header('location:index.php?msg=passerr');
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
new login;
?>