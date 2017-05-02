<?php
		include 'Dbconn.php';
		class BusDetails extends Dbconn{
			private $s;
				public function __construct(){
					parent::__construct();
					$s=explode(" ",$_GET['d']);
					$date=date_create($s[2]);
					$date=date_format($date,"Y/m/d");
					
					try{
						
						if($this->dbcon!=null){
							$sql=$this->dbcon->prepare("SELECT `sno`,`bus_name`,`ac`,`time`,`Seats`,`total_seat`,`cost_per`,`boarding` FROM `bus_details` WHERE from_city='".$s[0]."' AND to_city='".$s[1]."' AND date='".$date."'");
							$sql->execute();
							if(($sql->rowCount())==0)
								echo '<div id="rowdata" class="container-fluid bg-warning">
									<center>
									<h2 class="text-danger">*No Records Found*</h2>
									</center>
								</div>';
								date_default_timezone_set("Asia/Kolkata");
							while($r=$sql->fetch(PDO::FETCH_ASSOC)){
								$d=strtotime($r["time"]);
								$busdatetime=strtotime($date." ".date("h:ia",$d));
								$curr_date_time=time()+3600;
								if($busdatetime>=$curr_date_time){
								$ac="";
								if($r["ac"]==1)
									$ac="Ac";
								else
									$ac="Non-Ac";
								echo '<div id="rowdata" class="container-fluid bg-warning"><div class="row">';
									echo '<div class="col-md-3"><h2><i class="fa fa-bus"></i> '.$r["bus_name"].'<br />('.$ac.')</h2></div>';
									echo '<div class="col-md-4">
												<div class="row">
													<h3 class="text-center">Departure at '.date("h:ia",$d).'</h3>
												</div>
												<div class="row">
													<p class="text-center text-danger lead">Boarding point: '.$r["boarding"].'</p>
												</div>
										</div>';
									echo '<div class="col-md-3">
											<div classs="row">
												<h2 class="text-center"><i class="fa fa-ticket"></i> left: '.$r["Seats"].'</h2>
											</div>
											<div class="row">
												<h4 class="text-center text-danger"><i class="fa fa-ticket"></i> Total: '.$r["total_seat"].'</h4>
											</div>
										</div>';
									echo '<div class="col-md-2"><center>
											<div class="row">
												<h3 class="text-danger">INR '.$r["cost_per"].'</h3>
											</div>
											<div class="row">
											<form method="post" action="booking.php" onSubmit="return book('.$r["sno"].')">
												<button type="submit" name="btn" value='.$r["sno"].' class="btn btn-danger">Book ticket</button>
												</form>
											</div>
										</center></div>';
									echo '</div></div>';
							}
							}
						}
						$this->dbcon=null;
					}catch(PDOException $e){
						echo $e->getMessage();
					}
				}
		}
		new BusDetails; 
	?>