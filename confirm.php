<?php

	include 'Dbconn.php';
	class Signup extends Dbconn
	{
		public function __construct()
		{
			parent:: __construct();
			try{
				if($this->dbcon!=null && $_GET["code"]==$_GET["codeconf"])
				{
					if(empty($_GET))
					$sql=null;
					else
					$sql="INSERT INTO `user_details` (`username`,`email`,`password`) VALUES ('".$_GET["user"]."','".$_GET["email"]."','".$_GET["pass"]."')";
					$this->dbcon->exec($sql);
					echo "<p>success</p>";
					$this->dbcon=null;
				}
				else 
				echo "<p>Invalid code</p>";
				$this->dbcon=null;
				$_GET=null;
				
			}catch(PDOException $e){
				if(strripos($e->getMessage(),"Duplicate entry")>-1)
				echo "<p>Email error</p>";
			}
		}
	}
	new Signup;
?>
