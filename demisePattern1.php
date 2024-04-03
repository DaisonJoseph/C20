<?php 
require '/var/www/html/vendor/autoload.php';
session_start();

if(isset($_SESSION["Uid"]))
{
	$username = $_SESSION["Uid"];
}
$filename = basename($_SERVER['PHP_SELF']); 
if(isset($_SESSION['Uid'])){
//header('Location:index.php');
}
else
{
	header('Location:login.php');

}
	
$m = new MongoDB\Client("mongodb://localhost:27017");
$db = $m->allianz;
$demiseCol = $db->demise;
$demiseColOA = $db->demiseOA;
$demiseColOO = $db->demiseOO;
$demiseColORSA = $db->demiseORSA;
$demiseColOT = $db->demiseOT;
$demiseColXLOB = $db->demiseXLOB;

$patterns = $demiseCol->find();
$patternsOA = $demiseColOA->find();
$patternsOO = $demiseColOO->find();
$patternsORSA = $demiseColORSA->find();
$patternsOT = $demiseColOT->find();
$patternsXLOB = $demiseColXLOB->find();

$demisePatterns = $demiseCol->distinct("DemisePattern");
$demisePatternsOA = $demiseColOA->distinct("DemisePattern");
$demisePatternsOO = $demiseColOO->distinct("DemisePattern");
$demisePatternsORSA = $demiseColORSA->distinct("DemisePattern");
$demisePatternsOT = $demiseColOT->distinct("DemisePattern");
$demisePatternsXLOB = $demiseColXLOB->distinct("DemisePattern");

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns = $demiseCol->find($sql);
} else{
    $selectedPatterns1 = $demiseCol->find();
    $numbers = array();
    foreach($selectedPatterns1 as $selectedPattern1){
        $numbers[] = $selectedPattern1->DemiseId;
    }
}

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql1=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns2 = $demiseColOA->find($sql1);
} else{
    $selectedPatterns2 = $demiseColOA->find();
    $numbers = array();
    foreach($selectedPatterns2 as $selectedPattern2){
        $numbers[] = $selectedPattern2->DemiseId;
    }
}

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql2=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns3 = $demiseColOO->find($sql2);
} else{
    $selectedPatterns3 = $demiseColOO->find();
    $numbers = array();
    foreach($selectedPatterns3 as $selectedPattern3){
        $numbers[] = $selectedPattern3->DemiseId;
    }
}

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql3=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns4 = $demiseColORSA->find($sql3);
} else{
    $selectedPatterns4 = $demiseColORSA->find();
    $numbers = array();
    foreach($selectedPatterns4 as $selectedPattern4){
        $numbers[] = $selectedPattern4->DemiseId;
    }
}

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql4=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns5 = $demiseColOT->find($sql4);
} else{
    $selectedPatterns5 = $demiseColOT->find();
    $numbers = array();
    foreach($selectedPatterns5 as $selectedPattern5){
        $numbers[] = $selectedPattern5->DemiseId;
    }
}

if(isset($_GET["ids"])){
    $ids = explode(",", $_GET["ids"]);
    $numbers = array();
    foreach($ids as $id){
        if($id != ""){
            $numbers[] = intval($id);
        }
    }
	$sql5=array("DemiseId" => array('$in' => $numbers));
    $selectedPatterns6 = $demiseColXLOB->find($sql5);
} else{
    $selectedPatterns6 = $demiseColXLOB->find();
    $numbers = array();
    foreach($selectedPatterns6 as $selectedPattern6){
        $numbers[] = $selectedPattern6->DemiseId;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CAP360 Decommission Analyzer</title>
   <!--old UI-->
  <!--<link href="assets/css/style.css" rel="stylesheet">-->
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
  <style>
        .dot {
            height: 100px;
            width: 100px;
            background-color: #007300;
            border-radius: 50% !important;
            display: inline-block;
        }
        .inner-dot{
            margin-top: 20px;
            height: 60px;
            width: 60px;
            background-color: #fff;
            border-radius: 50% !important;
            display: inline-block;
        }
		.btn{
			margin: 5px;
			background-color:#3F51B5;
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
             <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Demise Pattern By Applications</div>
            </div>
			
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none"></li>
            <!--<li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>-->
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
		  <img src="images/allianz3.png" alt="ficoh" style="height:50px;width:210px">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                 <!--<span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="images/<?php echo $username?>.jpg">
                  </span>-->
                  <div class="media-body  ml-2  d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold" style="text-transform: uppercase"><?php echo $username?></span>
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
                  <h3 class="mb-0"></h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
             <?php 
				foreach($patterns as $pattern){
				?>
				<button class="btn  <?php if(in_array($pattern["DemiseId"], $numbers)){echo "btn-success";}else{echo "btn-danger";} ?>" id="<?php echo $pattern["DemiseId"]; ?>" style="margin: 5px;background-color:#3F51B5;"><?php echo $pattern["Application"]; ?></button>
				<?php
					}
				?>
              </div>
			  <div class="col-sm-12" style="margin: 20px; ">
				<button class="btn btn-primary" onclick="searchPatterns()">Search</button>
			  </div>
            </div>
          </div>
        </div>
		<div class="col-sm-12">
			<div class="row">
				<?php 
					$modalId = 111;
					foreach($demisePatterns as $dPattern){
						$filter = array(
								"DemiseId"=>array(
									'$in' => $numbers
									), 
								"DemisePattern" => $dPattern
								);
						//$demises = $demiseCol->find(array("DemiseId" => array('$in' => $numbers), "DemisePattern" => $dPattern));
						$count = $demiseCol->count($filter);
					?>
					<div class="col-sm-2"  style="text-align: center; font-size:9px; ">
						<div class="dot" style="background-color:#3F51B5">
							<div class="inner-dot" >
								<h3 style="margin-top: 40%; cursor: pointer" data-toggle="modal" data-target="#<?php echo $modalId; ?>"><?php echo $count; ?><h3>
							</div>
						</div>
						</br>
						</br>
						<p style="height: 30px;"><?php echo $dPattern; ?></p>
						<div class="modal fade" id="<?php echo $modalId; ?>" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content" style="height: 150px">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title"><?php echo $dPattern; ?></h4>
									</div>
									<div class="modal-body">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Applications</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													foreach($demises as $demise){
												?>
												<tr>
													<td><?php echo $demise->Application; ?></td>
												</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php
					$modalId++;
					}
				?>
			</div>
		</div>
		<div class="col-sm-12" >  
			<!--<div class="panel panel-default">
				<div class="panel-body">
					<div id="chartdiv" style="height: 13000px;"></div>
				</div>
			</div>-->
			<div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3">Demise Pattern</h5>
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
					<!--ORSA start-->				
					<div class="panel">
						<div id="collapse1" class="collapse" data-parent="#accordion">
							<h4 style="color:#3F51B5;margin-left:30px;font-size:18px">ORSA</h4>
												
							<div class="panel-group" id="accordion1">
								<div class="dropdown btn-group" style="margin-left:30px;">
									<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose Action To Lead
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="active"><a data-toggle="collapse" data-parent="#accordion1" href="#collapse11">Decommission</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse12">Remains</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse13">Integrate</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse14">Out of scope</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse15">All</a></li>
									</ul>
								</div>
								
								<div class="panel">
									<div id="collapse11" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
										<p><div  id="demise-Decomm-ORSA" style="height:2500px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse12" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
										<p><div  id="demise-Remains-ORSA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse13" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
										<p><div  id="demise-Integrate-ORSA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="demise-NA-ORSA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse15" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
										<p><div  id="demise-ORSA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
                            </div>
							<div id="balloon"></div>
						</div>
					</div>
					<!--ORSA END-->
					<!--OO Start-->
					<div class="panel">	
						<div id="collapse2" class="collapse" data-parent="#accordion">
							<h4 style="color:#3F51B5;margin-left:30px;">OO</h4>
							<div class="panel-group" id="accordion2">
								<div class="dropdown btn-group" style="margin-left:30px;">
									<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose Action To Lead
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="active"><a data-toggle="collapse" data-parent="#accordion2" href="#collapse11">Decommission</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse12">Remains</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse13">Integrate</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse14">Out of scope</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse15">All</a></li>
									</ul>
								</div>
								
								<div class="panel">
									<div id="collapse11" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
										<p><div  id="demise-Decomm-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse12" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
										<p><div  id="demise-Remains-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse13" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
										<p><div  id="demise-Integrate-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="demise-NA-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse15" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
										<p><div  id="demise-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
                            </div>
							<div id="balloon1"></div>
						</div>
					</div>
					<!--OO END-->
					<!--OA start-->
					<div class="panel">
						<div id="collapse3" class="collapse" data-parent="#accordion">
							<h4 style="color:#3F51B5;margin-left:30px;">OA</h4>
							<div class="panel-group" id="accordion3">
								<div class="dropdown btn-group" style="margin-left:30px;">
									<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose Action To Lead
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="active"><a data-toggle="collapse" data-parent="#accordion3" href="#collapse11">Decommission</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse12">Remains</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse13">Integrate</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse14">Out of scope</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse15">All</a></li>
									</ul>
								</div>
								
								<div class="panel">
									<div id="collapse11" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
										<p><div  id="demise-Decomm-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse12" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
										<p><div  id="demise-Remains-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse13" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
										<p><div  id="demise-Integrate-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="demise-NA-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse15" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
										<p><div  id="demise-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
                            </div>
							<div id="balloon2"></div>
						</div>			
					</div>
					<!--OA END-->
					<!--OT start-->
					<div class="panel">
						<div id="collapse4" class="collapse" data-parent="#accordion">
							<h4 style="color:#3F51B5;margin-left:30px;">OT</h4>
							<div class="panel-group" id="accordion4">
								<div class="dropdown btn-group" style="margin-left:30px;">
									<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose Action To Lead
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="active"><a data-toggle="collapse" data-parent="#accordion4" href="#collapse11">Decommission</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse12">Remains</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse13">Integrate</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse14">Out of scope</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse15">All</a></li>
									</ul>
								</div>
								
								<div class="panel">
									<div id="collapse11" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
										<p><div  id="demise-Decomm-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse12" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
										<p><div  id="demise-Remains-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse13" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
										<p><div  id="demise-Integrate-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="demise-NA-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse15" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
										<p><div  id="demise-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
                            </div>
							<div id="balloon3"></div>
						</div>			
					</div>
					<!--OT END-->
					<!--XLOB start-->
					<div class="panel">
						<div id="collapse5" class="collapse" data-parent="#accordion">
							<h4 style="color:#3F51B5;margin-left:30px;">XLOB</h4>
							<div class="panel-group" id="accordion5">
								<div class="dropdown btn-group" style="margin-left:30px;">
									<button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose Action To Lead
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li class="active"><a data-toggle="collapse" data-parent="#accordion5" href="#collapse11">Decommission</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse12">Remains</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse13">Integrate</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse14">Out of scope</a></li>
										<li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse15">All</a></li>
									</ul>
								</div>
								
								<div class="panel">
									<div id="collapse11" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
										<p><div  id="demise-Decomm-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse12" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
										<p><div  id="demise-Remains-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse13" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
										<p><div  id="demise-Integrate-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="demise-NA-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
								<div class="panel">
									<div id="collapse15" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
										<p><div  id="demise-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>
                            </div>
							<div id="balloon4"></div>
						</div>
					</div>
					<!--XLOB end-->
				</div>
			</div>
		</div>
    </div>
</div>
		</div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts style="margin: 20px;"-->
  <!-- Core -->
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
  
	<script src="https://www.amcharts.com/lib/4/core.js"></script>
	<script src="https://www.amcharts.com/lib/4/charts.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
	<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <!-- Custom Js 
	<script src="js/amchart.js"></script>
	<script src="js/chart.js"></script>
	<script src="js/animated.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/pages/index.js"></script>-->
    <!-- Demo Js 
    <script src="js/demo.js"></script>-->
	
	<script>
	$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
	});
	</script>
<script>
        var selectedPatterns = [
            <?php 
			$sql=array("DemiseId" => array('$in' => $numbers));
			$selectedPatterns = $demiseCol->find($sql);
            foreach($selectedPatterns as $selectedPattern){
                echo $selectedPattern->DemiseId;
            }
            ?>
        ];
        $(".btn-success").click(function (){
            if($(this).hasClass("btn-success")){
                $(this).removeClass("btn-success");
                $(this).addClass("btn-danger");
            } else{
                $(this).addClass("btn-success");
                $(this).removeClass("btn-danger");
            }
            var id = parseInt($(this).attr('id'));
            if(selectedPatterns.includes(id)){
                id_index = selectedPatterns.indexOf(id);
                if (id_index > -1) {
                    selectedPatterns.splice(id_index, 1);
                }
            } else{
                selectedPatterns.push(id);
            }
        });

        $(".btn-danger").click(function (){
            if($(this).hasClass("btn-danger")){
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
            } else{
                $(this).addClass("btn-danger");
                $(this).removeClass("btn-success");
            }
            var id = parseInt($(this).attr('id'));
            if(selectedPatterns.includes(id)){
                id_index = selectedPatterns.indexOf(id);
                if (id_index > -1) {
                    selectedPatterns.splice(id_index, 1);
                }
            } else{
                selectedPatterns.push(id);
            }
        });
        var urlString = "";
        function searchPatterns(){
            selectedPatterns.forEach(myFunction);
            window.location.href = "demisePattern.php?ids="+urlString;
        }
        function myFunction(item) {
            urlString += item.toString() + ",";
        }
        </script>
        <script>
        am4core.useTheme(am4themes_animated);
        var data = [
        <?php 
		//$sql=array("DemiseId" => array('$in' => $numbers));
		$sql=array("ActiontoleadFinal"=>"Decommission");
		$selectedPatterns = $demiseColORSA->find($sql);
        $properties_array = ["Pre Decom Analysis","Switch Off Application","Purge Application","Rewiring","DataArchival","UserMigration","Purge Users"]; 
        foreach($selectedPatterns as $selectedPattern){
            foreach($properties_array as $property){
                ?>
                { from: "<?php echo trim($selectedPattern->Application); ?>", to: "<?php echo $property; ?>", value: 1 },
                { from: "<?php echo $property; ?>", to: "<?php echo $property." - Yes"; ?>", value: 1 },
				{ from: "<?php echo $property; ?>", to: "<?php echo $property." - No"; ?>", value: 1 },
                { from: "<?php echo $property." - ".$selectedPattern[$property]; ?>", to: "<?php echo $selectedPattern->DemisePattern; ?>", value: 1 },
                <?php
            }
        }
        ?>
        ];
        var chart = am4core.create("demise-Decomm-ORSA", am4charts.SankeyDiagram);
        chart.data = data;
        chart.dataFields.fromName = "from";
        chart.dataFields.toName = "to";
        chart.dataFields.value = "value";
        chart.padding(0, 200, 100, 0);
		chart.nodes.template.nameLabel.label.truncate = false;
		chart.nodes.template.nameLabel.label.wrap = true;
		chart.nodes.template.nameLabel.label.width = 200;
		chart.logo.disabled=true;
        var nodefrom = chart.dataFields.fromName;
        var nodeLink = chart.links.template;
        var bullet = nodeLink.bullets.push(new am4charts.CircleBullet());

        bullet.fillOpacity = 1;
        bullet.circle.radius = 2;
        bullet.locationX = 0.5;

        // create animations
        chart.events.on("ready", function() {
            for (var i = 0; i < chart.links.length; i++) {
                var link = chart.links.getIndex(i);
                var bullet = link.bullets.getIndex(0);
                animateBullet(bullet);
            }
        });

        function animateBullet(bullet) {
            var duration = 3000 * Math.random() + 2000;
            var animation = bullet.animate([{ property: "locationX" , from: 0, to: 1}], duration);
            animation.events.on("animationended", function(event) {
                animateBullet(event.target.object);
            });
        }

        // Configure links
        chart.links.template.colorMode = "gradient";
        //chart.links.template.tooltipText = "{fromName} → {toName}: [bold]{value}[/] Mio units\n{fromName} contribute [bold]{value3} %[/] in {toName} sales: \n{toName} contributes [bold]{value2} %[/] in {fromName} sales";
		chart.links.template.tooltipText = "{fromName} → {toName}";
        var hoverState = chart.links.template.states.create("hover");
        hoverState.properties.fillOpacity = 4.6;

        // Exporting
        chart.exporting.menu = new am4core.ExportMenu();
		chart.exporting.filePrefix = "demise pattern";

        // Configure nodes
        //chart.nodes.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;
        chart.nodes.template.readerTitle = "Click to show/hide or drag to rearrange";
        chart.nodes.template.showSystemTooltip = true;

        // chart.orientation = "vertical";
        </script>

        <script>
        chart.nodes.template.events.on("hit", function(ev) {
                var fromNode = ev.target.dataItem.fromNode.from;
                var toNode = ev.target.dataItem.toNode;
                console.log(ev);
                console.log(ev.target.dataItem.properties.fromName);
                //alert(fromNode);
                //alert("clicked on "+ev.target.from, ev.target);
        }, this);
        </script>
    </body>
</html>
