<?php
class Dbconn{
	public $dbcon;
	public function __construct()
	{
		$server="localhost";
		$database="travelbus_db";
		try{
			$dbcon=new PDO("mysql:host=$server;dbname=$database","root","");
			$dbcon->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			if($dbcon!=null)
				$this->dbcon=$dbcon;
			else
				echo "Error";
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>