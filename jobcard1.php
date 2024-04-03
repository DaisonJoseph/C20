<?php
		/*$m = new MongoClient();
		$db = $m->allianz;
		session_start();
		if(isset($_SESSION["Uid"]))
		{
			$username = $_SESSION["Uid"];
		}
            $filename = basename($_SERVER['PHP_SELF']); */
?>
<?php 
 //   session_start();
	require '/var/www/html/vendor/autoload.php';
	$m = new MongoDB\Client("mongodb://localhost:27017");
	$db = $m->allianz;
	$collection = $db->jobcard;	
	$input1 = array("LOB"=>"ORSA");	
	$results1 = $collection->find($input1);
	
	$input2 = array("LOB"=>"OO");	
	$results2 = $collection->find($input2);
	
	$input3 = array("LOB"=>"OA");	
	$results3 = $collection->find($input3);
	
	$input4 = array("LOB"=>"OT");	
	$results4 = $collection->find($input4);
	
	$input5 = array("LOB"=>"XLoB");	
	$results5 = $collection->find($input5);
	
	//$results = $collection->find();
//	$user = $db->user; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } 
	//$cursor = $collection->find ()->sort(array('demiseSequence'=>-1));
	foreach($results as $result){
	$appname = $result['appname'];
	}
	$id = 1;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CAP360 Decommission Analyzer</title>
   <!--old UI-->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/hexa1.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
  <!--old UI close-->
  <!-- Favicon -->
  <link rel="icon" href="images/decomm.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="assets/css/argon.css?v=1.2.0" type="text/css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
	input[type=text] {
  width: 100%;
  height:auto;
  color:white;
  text-align:center;
  word-wrap: break-word;
  background-color:#342668;
  padding: 12px 20px;
  margin: 3px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=button] {
  width: 100%;
  height:auto;
  color:white;
  text-align:center;
  word-wrap: break-word;
  background-color:#342668;
  padding: 12px 20px;
  margin: 3px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

.verticle {
  width: 100%;
  height:auto;
  color:white;
  text-align:center;
  background-color:#342668;
  padding: 12px 20px;
  margin: 3px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
</style>
</head>

<body>
  <!-- Sidenav -->
<nav class="navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <?php include 'sidebar.php' ?>
  </nav>
  
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<div class="col-xl-5">
             <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Job Card</div>
            </div>
			
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none"></li>
            <!--<li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in">Decommission Plan</i>
              </a>
            </li>-->
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
		  <img src="images/allianz3.png" alt="ficoh" style="height:50px;width:210px">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="images/<?php echo $username?>.jpg">
                  </span>
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo $username?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu  dropdown-menu-right ">
                <a href="login.php" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid ">
        <div class="header-body">
          <div class="row">
			</div>
          <!-- Card stats -->
          <div class="row">
            <div class="col-xl-12">
              <!--<div class="card">
                <div class="card-body" style="font-size:20px;">Decommission Plan</div>
              </div>-->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      <div class="row">
      </div>
      <div class="row">
       <div class="col-xl-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Decommission Plan</h3>
                </div>
              </div>
            </div>
	<div class="card-body">
			<div class="panel-group" id="accordion">
				<div class="dropdown btn-group">
					<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose LOB
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li class="active"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">ORSA</a></li>
						<li><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">OO</a></li>
						<li><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">OA</a></li>
						<li><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">OT</a></li>
						<li><a data-toggle="collapse" data-parent="#accordion" href="#collapse5">XLOB</a></li>
					</ul>
				</div>
				<!--<START OF ORSA>-->
				<div class="panel">
					<div id="collapse1" class="collapse" data-parent="#accordion">
						<h4 style="color:#3F51B5;margin-left:30px;">ORSA</h4>
					
						<?php
							foreach($results1 as $result){
								$appname = $result->appname;
						?>
						<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
						<?php
							}
						?>
					
					<?php 
						foreach($results1 as $result){
							$appname = $result['appname'];
					?>
						<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
											<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
												<div class="col-sm-3">
													<div style="text-align:center;"><strong>Application Type</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
													<div style="text-align:center;"><strong>Line Of Business</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														
													<div style="text-align:center;"><strong>Application Owner</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
													<div style="text-align:center;"><strong>Currently active</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
													<div style="text-align:center;"><strong>Age Of Application</strong></div>
													<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														
													<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
													<div class="row">
														<div class="col-sm-2">
															<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
														</div>
														<div class="col-sm-10" >
															<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
														</div>
													</div>
													<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
													<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
													</div>
													<div style="text-align:center;"><strong>Application Description</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
													</div>
														
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
														</div>
															
													</div>
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
														</div>
													</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							
								<div class="modal-footer">
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>						
				</div>
			</div>
		<!--<END OF ORSA>-->
				<!--<START OF OO>-->	
							<div class="panel">
											<div id="collapse2" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OO</h4>
												
						<?php
							foreach($results2 as $result){
								$appname = $result->appname;
						?>
						<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
						<?php
							}
						?>
					
					<?php 
						foreach($results2 as $result){
							$appname = $result['appname'];
					?>
						<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
											<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
												<div class="col-sm-3">
													<div style="text-align:center;"><strong>Application Type</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
													<div style="text-align:center;"><strong>Line Of Business</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														
													<div style="text-align:center;"><strong>Application Owner</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
													<div style="text-align:center;"><strong>Currently active</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
													<div style="text-align:center;"><strong>Age Of Application</strong></div>
													<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														
													<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
													<div class="row">
														<div class="col-sm-2">
															<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
														</div>
														<div class="col-sm-10" >
															<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
														</div>
													</div>
													<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
													<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
													</div>
													<div style="text-align:center;"><strong>Application Description</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
													</div>
														
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
														</div>
															
													</div>
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
														</div>
													</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							
								<div class="modal-footer">
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>						
				</div>
			</div>
			<!--<END OF OO>-->
				<!--<START OF OA>-->
										<div class="panel">
											<div id="collapse3" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OA</h4>
												
						<?php
							foreach($results3 as $result){
								$appname = $result->appname;
						?>
						<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
						<?php
							}
						?>
					
					<?php 
						foreach($results3 as $result){
							$appname = $result['appname'];
					?>
						<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
											<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
												<div class="col-sm-3">
													<div style="text-align:center;"><strong>Application Type</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
													<div style="text-align:center;"><strong>Line Of Business</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														
													<div style="text-align:center;"><strong>Application Owner</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
													<div style="text-align:center;"><strong>Currently active</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
													<div style="text-align:center;"><strong>Age Of Application</strong></div>
													<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														
													<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
													<div class="row">
														<div class="col-sm-2">
															<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
														</div>
														<div class="col-sm-10" >
															<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
														</div>
													</div>
													<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
													<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
													</div>
													<div style="text-align:center;"><strong>Application Description</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
													</div>
														
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
														</div>
															
													</div>
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
														</div>
													</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							
								<div class="modal-footer">
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>						
				</div>
			</div>
			<!--<END OF OA>-->
				<!--<START OF OT>-->					
										
										<div class="panel">
											
											<div id="collapse4" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OT</h4>
												
						<?php
							foreach($results4 as $result){
								$appname = $result->appname;
						?>
						<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
						<?php
							}
						?>
					
					<?php 
						foreach($results4 as $result){
							$appname = $result['appname'];
					?>
						<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
											<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
												<div class="col-sm-3">
													<div style="text-align:center;"><strong>Application Type</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
													<div style="text-align:center;"><strong>Line Of Business</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														
													<div style="text-align:center;"><strong>Application Owner</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
													<div style="text-align:center;"><strong>Currently active</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
													<div style="text-align:center;"><strong>Age Of Application</strong></div>
													<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														
													<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
													<div class="row">
														<div class="col-sm-2">
															<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
														</div>
														<div class="col-sm-10" >
															<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
														</div>
													</div>
													<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
													<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
													</div>
													<div style="text-align:center;"><strong>Application Description</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
													</div>
														
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
														</div>
															
													</div>
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
														</div>
													</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							
								<div class="modal-footer">
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					</div>	
				</div>					
					<!--<END OF OT>-->
							<!--<START OF XLOB>-->
										<div class="panel">
											
											<div id="collapse5" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">XLOB</h4>
												
						<?php
							foreach($results5 as $result){
								$appname = $result->appname;
						?>
						<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
						<?php
							}
						?>
						
					<?php 
						foreach($results5 as $result){
							$appname = $result['appname'];
					?>
						<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
											<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
												<div class="col-sm-3">
													<div style="text-align:center;"><strong>Application Type</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
													<div style="text-align:center;"><strong>Line Of Business</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														
													<div style="text-align:center;"><strong>Application Owner</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
													<div style="text-align:center;"><strong>Currently active</strong></div>
													<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
													<div style="text-align:center;"><strong>Age Of Application</strong></div>
													<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														
													<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
													<div class="row">
														<div class="col-sm-2">
															<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
														</div>
														<div class="col-sm-10" >
															<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
														</div>
													</div>
													<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
													<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
													</div>
													<div style="text-align:center;"><strong>Application Description</strong></div>
													<div>
														<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
													</div>
														
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
														</div>
															
													</div>
													<div class="row">
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
														</div>
														<div  class="col-sm-6">
															<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
															<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
														</div>
													</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							
								<div class="modal-footer">
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>
					</div>
				</div>
					<!--<END OF XLOB>-->
			</div>  <!--PANEL CLOSE-->
			
			
			
			
			
			
			
					<!--<section class="menu-list">
					
					<?php
					foreach($results as $result){
						$appname = $result->appname;
					?>
					<p class="hexagon item-<?php echo $result['ID'];?>"><a href="#<?php echo $result['demiseSequence']?>" class="label" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'];?>"><?php echo "$appname"?></a></p>
					<?php
					}
					?>
					</section>-->
					<?php 
					foreach($results as $result){
						$appname = $result->appname;
					?>
					<div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result['demiseSequence'];?>" role="dialog">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div style="background-color:#ffbf00" class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname"?></strong></h3>
								</div>
							<!--<div id="carousel-controls-<?php //echo $result['demiseSequence'];?>" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
							<div class="item">-->
								<div class="modal-body">
									<div class="container-fluid">
										<div style="border: 2px solid black;width:100%;">
										
											<!--<div  style="background-color:#ffbf00;border-bottom:2px solid black;text-align:center;">
												<h3>Application Name - <?php //echo "$appname"?>  </h3>
											</div>-->
												<div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
													<div class="col-sm-3">
														<div style="text-align:center;"><strong>Application Type</strong></div>
														<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['application type']?>" /></div>
														<div style="text-align:center;"><strong>Line Of Business</strong></div>
														<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['LOB']?>" /></div>
														<!--<div>
															<textarea  style="margin-bottom:20px;width:100%;background-color:#342668;color:white;text-align:center;height:auto;" ><?php echo $result['LOB']?></textarea>
														</div>-->
														<div style="text-align:center;"><strong>Application Owner</strong></div>
														<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application Owner']?>" /></div>
														<div style="text-align:center;"><strong>Currently active</strong></div>
														<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Application currently active']?>" /></div>
														<div style="text-align:center;"><strong>Age Of Application</strong></div>
														<div style="margin-bottom:25px"><input type="text" readonly  value="<?php echo $result['Application age']?>"/></div>
														<!--<div style="text-align:center;"><strong>Biz Owner</strong></div>
														<div style="margin-bottom:10px"><input type="text"  value="<?php //echo $result['bizOwner']?>"/></div>-->
														<div style="text-align:center;margin-bottom:10px"><strong>Days to Decomission</strong></div>
														<div class="row">
															<div class="col-sm-2">
																<h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result['noofDays']?> </h2>
															</div>
															<div class="col-sm-10" >
																<img style="margin-left:90px;margin-bottom:25px;" src="images/men.png" alt="image">
															</div>
														</div>
														<div style="text-align:center;"><strong>Cost to Decomission</strong></div>
														<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result['Cost']?> </h3>
													</div>
													<div class="col-sm-9 ">
														<div style="text-align:center;"><strong>Decommission Pattern</strong></div>
														<div>
															<textarea class="verticle" rows="1"><?php echo $result['demisePattern']?></textarea>
														</div>
													
															<div style="text-align:center;"><strong>Application Description</strong></div>
														<div>
															<textarea class="verticle" rows="1"><?php echo $result['description']?></textarea>
														</div>
														
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['pointOfArrival']?>" /></div>
																<!--<div>
																	<textarea class="verticle" rows="1" ><?php //echo $result['pointOfArrival']?></textarea>
																</div>-->
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['poaReady']?>" /></div>
															</div>
															<!--<div  class="col-sm-4">
																<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
																<div style="margin-bottom:15px"><input type="text" value="<?php //echo $result['endDate']?>" /></div>
															</div>-->
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['startDate']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['endDate']?>" /></div>
															</div>
															<!--<div  class="col-sm-4">
																<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
																<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['endDate']?>" /></div>
															</div>-->
														</div>
														
														<div class="row">
															<div class="col-sm-6">
																<div style="text-align:center;margin-bottom:15px;"><strong>Decomission Pattern Detail</strong></div>
																<table id="myTable" class="table table-striped">
																	<tbody>
																		<tr style="padding:4px !important;">
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result['ID']?>"> <?php echo $result['DataforCompliance']?></td>
																		</tr>
																		<!--<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result['ID']?>"> <?php echo $result['GapAnalysis']?></td>
																		</tr>-->
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result['ID']?>"><?php echo $result['DataMigration']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result['ID']?>"> <?php echo $result['DataArchival']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php echo $result['ID']?>"> <?php echo $result['BigBang']?></td>
																		</tr>
																		<tr>
																		 <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																		 <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result['ID']?>"> <?php echo $result['UserMigration']?></td>
																		</tr>
																	</tbody>
																</table>
															</div>
															<div class="col-sm-6">
																<div style="text-align:center;"><strong>Decomission Sequence</strong></div>
																<div class="circle1" style="margin-bottom:10px;"><?php echo $result['demiseSequence']?></div>
																<!--<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:25px"><input type="text"  value="<?php echo $result['support']?>"/></div>-->
															</div>
														</div>
														<div class="row">
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Level of Documentation']?>" /></div>
															</div>
															<div  class="col-sm-6">
																<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
																<div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result['Support']?>" /></div>
															</div>
															
															<!--<div  class="col-sm-4">
																<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
																<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['endDate']?>" /></div>
															</div>-->
														</div>
													</div>
												</div>
										</div>
									</div>
								</div>
							<!--</div>
							</div>-->
								<div class="modal-footer">
								<!--<a class="left carousel-control" href="#<?php //echo $result['demiseSequence']?>" role="button" data-slide="prev">-->
									<!--<span class="glyphicon glyphicon-chevron-left" id="<?php //echo $result['demiseSequence']?> - 1" onclick="slideIt('toLeft');"></span>-->
								 <!--</a>
								 <a class="right carousel-control" href="#<?php //echo $result['demiseSequence']?>" role="button" data-slide="next">-->
									<!--<span class="glyphicon glyphicon-chevron-right" id="<?php //echo $result['demiseSequence']?> + 1" onclick="slideIt('toRight');"></span>-->
								 <!--</a>-->

								 <!--<button type="button" class="glyphicon glyphicon-chevron-left data-toggle="modal" data-target="#<?php //echo $result['ID']; ?>" id="<?php //echo $result['demiseSequence']  - 1; ?>"></button>-->
								 <!--<a href="sample.php?file=<?php //echo $result["ID"]?>.pdf">Download the Job Card</a>-->
								 <button class="btn btn-success" style="margin-right:160px;">
								 <a href="sample.php?file=<?php echo $result["appname"]?>.pdf" class="pull-left"> Download Jobcard
									<i class="fa fa-download"></i>
								 </a>
								</button>
								 <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] - 1;?>"></button>
								 <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result['demiseSequence'] + 1;?>"></button>
								 <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<?php
					}
					?>
				
			
	</div>

    <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Optional JS -->
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="assets/js/argon.js?v=1.2.0"></script>
	<script src="assets/js/amchart.js"></script>
	<script src="assets/js/chart.js"></script>
	<script src="assets/js/animated.js"></script>
	
	
	<script>
	$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
	});
	</script>
	<script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="assets/plugins/jquery-countto/jquery.countTo.js"></script>
<!-- Morris Plugin Js -->
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <script src="assets/plugins/morrisjs/morris.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/jquery.charts-sparkline.js"></script>	

	<!-- Custom Js -->
    <script src="assets/js/admin.js"></script>
    <script src="assets/js/pages/index.js"></script>
	<script src="assets/js/dashboard3.js"></script>

	
    <!-- Demo Js -->
    <script src="assets/js/demo.js"></script>
	
	<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
	<script src="https://www.amcharts.com/lib/3/serial.js"></script>
	<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
	<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
	
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script>
function setStyles()
  {
	setDecomissionPattern();  
	  
  }
  function setDecomissionPattern()
  {
	<?php 
	foreach($results as $result){
	?>
	  var DataforCompliance_<?php echo $result->ID?> = '<?php echo $result->DataforCompliance;?>';
	 
	   if(DataforCompliance_<?php echo $result->ID?> == "Yes")
	   {
		    
			
			
		   document.getElementById('DataforCompliance_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('DataforCompliance_<?php echo $result->ID?>').style.backgroundColor = "red";
	   }
	   
	   /*var GapAnalysis_<?php echo $result->ID?> = '<?php echo $result->GapAnalysis;?>';
	   if(GapAnalysis_<?php echo $result->ID?> == "yes")
	   {
		   
		   document.getElementById('GapAnalysis_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		  document.getElementById('GapAnalysis_<?php echo $result->ID?>').style.backgroundColor = "red";
	   }*/
	   
	   var DataMigration_<?php echo $result->ID?> = '<?php echo $result->DataMigration;?>';
	   if(DataMigration_<?php echo $result->ID?> == 'Yes')
	   {
		   
		   document.getElementById('DataMigration_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('DataMigration_<?php echo $result->ID?>').style.backgroundColor = "red";
	   }
	   
	   var DataArchival_<?php echo $result->ID?> = '<?php echo $result->DataArchival;?>';
	   if(DataArchival_<?php echo $result->ID?> == 'Yes')
	   {
		   
		   document.getElementById('DataArchival_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		  document.getElementById('DataArchival_<?php echo $result->ID?>').style.backgroundColor = "red"; 
	   }
	   
	   var BigBang_<?php echo $result->ID?> = '<?php echo $result->BigBang;?>';
	   if(BigBang_<?php echo $result->ID?> == 'Yes')
	   {
		   
		   document.getElementById('BigBang_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('BigBang_<?php echo $result->ID?>').style.backgroundColor = "red";
	   }
	   
	   var UserMigration_<?php echo $result->ID?> = '<?php echo $result->UserMigration;?>';
	   if(UserMigration_<?php echo $result->ID?> == 'Yes')
	   {
		   
		   document.getElementById('UserMigration_<?php echo $result->ID?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('UserMigration_<?php echo $result->ID?>').style.backgroundColor = "red";
	   }
   <?php
	}
	?>	  
	  
  } 

 </script>

 <script>
 $( ".hexagon" )
  .mouseenter(function() {
  $(this).addClass('active');
  })
  .mouseleave(function() {
  $(this).removeClass('active');
  });
 </script>
 <script>

</script>
</body>
</html>