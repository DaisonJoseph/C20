<?php
// require '/var/www/html/vendor/autoload.php';
session_start();

// $m = new MongoDB\Client("mongodb://localhost:27017");
$m = new MongoClient();
$db = $m->allianz;
$user = $db->user;
$collection = $db->masterinput;
$collection1 = $db->inboundinterfaces;
$collection2 = $db->outboundinterfaces;
$collection3 = $db->masterinputORSA;
$collection4 = $db->masterinputOO;
$collection5 = $db->masterinputOA;
$collection6 = $db->masterinputOT;
$collection7 = $db->masterinputXLOB;

// $filter = [];
// $options = ['sort' => ['appname' => 1]];
$results1 = $collection1->find()->sort(array('appname' => 1));

// $filter = [];
// $options = ['sort' => ['appname' => 1]];
$results2 = $collection2->find()->sort(array('appname' => 1));

if (isset($_SESSION["Uid"])) {
     $username = $_SESSION["Uid"];
}
$filename = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['Uid'])) {
     //header('Location:index.php');
} else {
     header('Location:login.php');
}
// $filter = [];
// $options = ['sort' => ['portabilityindex' => 1]];
$results = $collection->find()->sort(array('portabilityindex' => 1));
// $results = $collection->find($filter, $options);
// $results->sort(array('portabilityindex' => -1));
$lowcount = 0;
$medcount = 0;
$highcount = 0;
foreach ($results as $result) {

     $score = $result['portabilityindex'];
     if ($score > 0 & $score < 0.4) {
          $lowcount++;
     } elseif ($score > 0.8 & $score <= 1) {
          $highcount++;
     } else {
          $medcount++;
     }
     $name = $result['appname'];
     if ($name == "ISO Stat (# 4 Components )") {
          if ($score > 0 & $score < 0.4) {
               $lowcount = $lowcount + 3;
          } elseif ($score > 0.8 & $score <= 1) {
               $highcount = $highcount + 3;
          } else {
               $medcount = $medcount + 3;
          }
     }
     if ($name == "Lotus Notes (# 4 Components)") {
          if ($score > 0 & $score < 0.4) {
               $lowcount = $lowcount + 3;
          } elseif ($score > 0.8 & $score <= 1) {
               $highcount = $highcount + 3;
          } else {
               $medcount = $medcount + 3;
          }
     }
     if ($name == "First Link (# 2 Components )") {
          if ($score > 0 & $score < 0.4) {
               $lowcount++;
          } elseif ($score > 0.8 & $score <= 1) {
               $highcount++;
          } else {
               $medcount++;
          }
     }
     if ($name == "SPI (# 3 Components )") {
          if ($score > 0 & $score < 0.4) {
               $lowcount = $lowcount + 2;
          } elseif ($score > 0.8 & $score <= 1) {
               $highcount = $highcount + 2;
          } else {
               $medcount = $medcount + 2;
          }
     }
}
$appcount = $lowcount + $medcount + $highcount;
?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>CAP360 Decommission Analyzer</title>
     <!--old UI-->
     <link href="assets/css/style.css" rel="stylesheet">
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
     <!-- Waves Effect Css -->
     <link href="assets/plugins/node-waves/waves.css" rel="stylesheet" />
     <!-- Animation Css -->
     <link href="assets/plugins/animate-css/animate.css" rel="stylesheet" />

     <!-- Morris Chart Css-->
     <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<style>
     #balloon {
          position: absolute;
          top: 680px;
          left: 830px;
          border: 2px solid #ccc;
          background: rgba(255, 255, 255, 0.8);
          padding: 6px;
          font-size: 10px;
          color: #000;
          margin: 20px 0 0 20px;
     }

     #balloon1 {
          position: absolute;
          top: 680px;
          left: 830px;
          border: 2px solid #ccc;
          background: rgba(255, 255, 255, 0.8);
          padding: 6px;
          font-size: 10px;
          color: #000;
          margin: 20px 0 0 20px;
     }

     #balloon2 {
          position: absolute;
          top: 680px;
          left: 830px;
          border: 2px solid #ccc;
          background: rgba(255, 255, 255, 0.8);
          padding: 6px;
          font-size: 10px;
          color: #000;
          margin: 20px 0 0 20px;
     }

     #balloon3 {
          position: absolute;
          top: 680px;
          left: 830px;
          border: 2px solid #ccc;
          background: rgba(255, 255, 255, 0.8);
          padding: 6px;
          font-size: 10px;
          color: #000;
          margin: 20px 0 0 20px;
     }

     #balloon4 {
          position: absolute;
          top: 680px;
          left: 830px;
          border: 2px solid #ccc;
          background: rgba(255, 255, 255, 0.8);
          padding: 6px;
          font-size: 10px;
          color: #000;
          margin: 20px 0 0 20px;
     }
</style>

<body>
     <!-- Sidenav -->
     <nav class="navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main" style="padding: -0.325rem 1.5rem;">
          <?php //include 'sidebar.php' 
          ?>
          <div class="scrollbar-inner">
               <!-- Brand -->
               <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                         <p>
                              <h3 style="font-size:20px;color: #00006E"><strong>Decommission Analyzer</strong></h3>
                         </p>
                    </a>
               </div>
               <div class="sidebar-wrapper" id="sidebar-wrapper">
                    <div class="navbar-inner">
                         <!-- Collapse -->
                         <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                              <!-- Nav items -->
                              <ul class="navbar-nav">

                                   <li class="nav-item">
                                   <li <?php if ($filename == "index.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="index.php">
                                             <i class="ni ni-tv-2 text-primary"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Dashboard</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "portability-metrics.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="portability-metrics.php">
                                             <i class="material-icons text-primary" style="margin-top: 5px;">layers</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Portability Metrics</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "risk-criticality.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="risk-criticality.php">
                                             <i class="material-icons text-yellow" style="margin-top: 5px;">trending_up</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Risk and Criticality</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "poa.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="poa.php">
                                             <i class="material-icons text-pink" style="margin-top: 5px;">swap_calls</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>POA Map</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "application.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="application.php">
                                             <i class="ni ni-bullet-list-67 text-default" style="margin-top: 5px;"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Applications</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "jobcard.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="jobcard.php">
                                             <i class="material-icons text-green" style="margin-top: 5px;">assignment</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Jobcard</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "demisePattern.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="demisePattern.php">
                                             <i class="ni ni-sound-wave text-purple" style="margin-top: 5px;"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Demise Pattern</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "cluster.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="cluster.php">
                                             <i class="material-icons text-primary" style="margin-top: 5px;">layers</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Decommission Cluster</strong></span>
                                        </a>
                                   </li>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
     </nav>

     <!-- Main content -->
     <div class="main-content" id="panel">
          <!-- Topnav -->
          <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
               <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Portability Metrics By Applications</div>
                         <!-- Navbar links -->
                         <ul class="align-items-center  ml-md-auto ">
                              <li class="nav-item d-xl-none"></li>
                              <!-- Sidenav toggler -->

                              </li>
                              <li class="nav-item d-sm-none">
                                   <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                        <i class="ni ni-zoom-split-in"></i>
                                   </a>
                              </li>
                         </ul>
                         <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                              <img src="images/allianz3.png" alt="ficoh" style="height:50px;width:210px">
                              <li class="nav-item dropdown">
                                   <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="media align-items-center">
                                             <!--<span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="images/<?php echo $username ?>.jpg">
                  </span>-->
                                             <div class="media-body  ml-2  d-none d-lg-block">
                                                  <span class="mb-0 text-sm  " style="text-transform: uppercase"><?php echo $username ?></span>
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
                                   <div class="card">
                                        <div class="card-body">
                                             <div class="row">
                                                  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Applications</small>
                                                       <h2> <?php echo $appcount ?></h2>
                                                       <div id="sparklinedash"></div>
                                                  </div>
                                                  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>High Portable Applications</small>
                                                       <h2> <?php echo $highcount ?></h2>
                                                       <div id="sparklinedash2"></div>
                                                  </div>
                                                  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Medium Portable Applications</small>
                                                       <h2> <?php echo $medcount ?></h2>
                                                       <div id="sparklinedash3"></div>
                                                  </div>
                                                  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Low Portable Applications</small>
                                                       <h2> <?php echo $lowcount ?></h2>
                                                       <div id="sparklinedash4"></div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <!-- Page content -->
          <div class="container-fluid mt--6">
               <div class="row">
                    <div class="col-xl-12">
                         <div class="card">
                              <div class="card-header bg-transparent">
                                   <div class="row">
                                        <div class="col">
                                             <h5 class="h3">Applications With Portability Score</h5>
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
                                                                 <!--<li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse14">Out of scope</a></li>-->
                                                                 <li><a data-toggle="collapse" data-parent="#accordion1" href="#collapse15">All</a></li>
                                                            </ul>
                                                       </div>

                                                       <div class="panel">
                                                            <div id="collapse11" class="collapse" data-parent="#accordion1">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Decomm-ORSA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse12" class="collapse" data-parent="#accordion1">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Remains-ORSA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse13" class="collapse" data-parent="#accordion1">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Integrate-ORSA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <!--<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion1">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="portability-chart-NA-ORSA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>-->
                                                       <div class="panel">
                                                            <div id="collapse15" class="collapse" data-parent="#accordion1">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
                                                                 <p>
                                                                 <div id="portability-chart-ORSA" style="height:690px;width:1060px;"></div>
                                                                 </p>
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
                                                                 <!--<li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse14">Out of scope</a></li>-->
                                                                 <li><a data-toggle="collapse" data-parent="#accordion2" href="#collapse15">All</a></li>
                                                            </ul>
                                                       </div>

                                                       <div class="panel">
                                                            <div id="collapse11" class="collapse" data-parent="#accordion2">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Decomm-OO" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse12" class="collapse" data-parent="#accordion2">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Remains-OO" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse13" class="collapse" data-parent="#accordion2">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Integrate-OO" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <!--<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion2">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="portability-chart-NA-OO" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>-->
                                                       <div class="panel">
                                                            <div id="collapse15" class="collapse" data-parent="#accordion2">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
                                                                 <p>
                                                                 <div id="portability-chart-OO" style="height:690px;width:1060px;"></div>
                                                                 </p>
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
                                                                 <!--<li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse14">Out of scope</a></li>-->
                                                                 <li><a data-toggle="collapse" data-parent="#accordion3" href="#collapse15">All</a></li>
                                                            </ul>
                                                       </div>

                                                       <div class="panel">
                                                            <div id="collapse11" class="collapse" data-parent="#accordion3">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Decomm-OA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse12" class="collapse" data-parent="#accordion3">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Remains-OA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse13" class="collapse" data-parent="#accordion3">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Integrate-OA" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <!--<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion3">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="portability-chart-NA-OA" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>-->
                                                       <div class="panel">
                                                            <div id="collapse15" class="collapse" data-parent="#accordion3">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
                                                                 <p>
                                                                 <div id="portability-chart-OA" style="height:690px;width:1060px;"></div>
                                                                 </p>
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
                                                                 <!--<li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse14">Out of scope</a></li>-->
                                                                 <li><a data-toggle="collapse" data-parent="#accordion4" href="#collapse15">All</a></li>
                                                            </ul>
                                                       </div>

                                                       <div class="panel">
                                                            <div id="collapse11" class="collapse" data-parent="#accordion4">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Decomm-OT" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse12" class="collapse" data-parent="#accordion4">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Remains-OT" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse13" class="collapse" data-parent="#accordion4">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Integrate-OT" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <!--<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion4">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="portability-chart-NA-OT" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>-->
                                                       <div class="panel">
                                                            <div id="collapse15" class="collapse" data-parent="#accordion4">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
                                                                 <p>
                                                                 <div id="portability-chart-OT" style="height:690px;width:1060px;"></div>
                                                                 </p>
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
                                                                 <!--<li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse14">Out of scope</a></li>-->
                                                                 <li><a data-toggle="collapse" data-parent="#accordion5" href="#collapse15">All</a></li>
                                                            </ul>
                                                       </div>

                                                       <div class="panel">
                                                            <div id="collapse11" class="collapse" data-parent="#accordion5">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Decommission</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Decomm-XLOB" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse12" class="collapse" data-parent="#accordion5">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Remains</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Remains-XLOB" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <div class="panel">
                                                            <div id="collapse13" class="collapse" data-parent="#accordion5">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Integrate</h4>
                                                                 <p>
                                                                 <div id="portability-chart-Integrate-XLOB" style="height:690px;width:1060px;"></div>
                                                                 </p>
                                                            </div>
                                                       </div>
                                                       <!--<div class="panel">
									<div id="collapse14" class="collapse" data-parent="#accordion5">
										<h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">Out of scope</h4>
										<p><div  id="portability-chart-NA-XLOB" style="height:690px;width:1060px;"></div></p>
									</div>
								</div>-->
                                                       <div class="panel">
                                                            <div id="collapse15" class="collapse" data-parent="#accordion5">
                                                                 <h4 style="color:#3F51B5;margin-left:50px;font-size:14px;">All</h4>
                                                                 <p>
                                                                 <div id="portability-chart-XLOB" style="height:690px;width:1060px;"></div>
                                                                 </p>
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
               <div class="row">
                    <div class="col-xl-6">
                         <div class="card">
                              <div class="card-header border-0">
                                   <div class="row align-items-center">
                                        <div class="col">
                                             <h3 class="mb-0">Inbound Interfaces</h3>
                                             <a href="download.php?input=inbound" class="blue-cascade pull-right" style="display:inline"> Download CSV
                                                  <i class="fa fa-download"></i>
                                             </a>
                                        </div>
                                   </div>
                              </div>
                              <div class="table-responsive">
                                   <!-- Projects table -->
                                   <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                             <tr>
                                                  <th scope="col">Application Name</th>
                                                  <th scope="col">SFTP</th>
                                                  <th scope="col">Database Call</th>
                                                  <th scope="col">MQ</th>
                                                  <th scope="col">Web Services</th>
                                                  <th scope="col">Email</th>
                                                  <th scope="col">Postal Letter</th>
                                                  <th scope="col">Google Analytics</th>
                                                  <th scope="col">Payment Gateway</th>
                                                  <th scope="col">API</th>
                                                  <th scope="col">Windows Service</th>
                                                  <th scope="col">Applications</th>
                                                  <th scope="col">Total Count</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             foreach ($results1 as $result1) {

                                                  $name = $result1['appname'];
                                                  $input = array("appname" => $name);
                                                  $interfaces = $collection1->find($input);
                                                  foreach ($interfaces as $interface) {
                                                       echo "<tr><td>" . $result1['appname'] . "</td><td>" . $interface['SFTP'] . "</td><td>" . $interface['Database Call'] . "</td><td>" . $interface['MQ'] . "</td><td>" . $interface['Web Services'] . "</td><td>" . $result1['Email'] . "</td><td>" . $result1['Postal Letter'] . "</td><td>" . $result1['Google Analytics'] . "</td><td>" . $result1['Payment Gateway'] . "</td><td>" . $result1['API'] . "</td><td>" . $interface['Windows Service'] . "</td><td>" . $interface['Applications'] . "</td><td>" . $interface['Total Count'] . "</td></tr>";
                                                  }
                                             }
                                             ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
                    <div class="col-xl-6">
                         <div class="card">
                              <div class="card-header border-0">
                                   <div class="row align-items-center">
                                        <div class="col">
                                             <h3 class="mb-0">Outbound Interfaces</h3>
                                             <a href="download.php?input=outbound" class="blue-cascade pull-right" style="display:inline"> Download CSV
                                                  <i class="fa fa-download"></i>
                                             </a>
                                        </div>
                                   </div>
                              </div>
                              <div class="table-responsive">
                                   <!-- Projects table -->
                                   <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                             <tr>
                                                  <th scope="col">Application Name</th>
                                                  <th scope="col">SFTP</th>
                                                  <th scope="col">Database Call</th>
                                                  <th scope="col">MQ</th>
                                                  <th scope="col">Web Services</th>
                                                  <th scope="col">Gateway payment</th>
                                                  <th scope="col">Google Analytics</th>
                                                  <th scope="col">Chat Bot</th>
                                                  <th scope="col">API</th>
                                                  <th scope="col">Email</th>
                                                  <th scope="col">Faxination</th>
                                                  <th scope="col">SMTP</th>
                                                  <th scope="col">Fax</th>
                                                  <th scope="col">SMS</th>
                                                  <th scope="col">Windows Service</th>
                                                  <th scope="col">Total Count</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                             <?php
                                             foreach ($results2 as $result2) {
                                                  $name = $result2['appname'];
                                                  $input = array("appname" => $name);
                                                  $interfaces = $collection2->find($input);
                                                  foreach ($interfaces as $interface) {
                                                       echo "<tr><td>" . $result2['appname'] . "</td><td>" . $interface['SFTP'] . "</td><td>" . $interface['Database Call'] . "</td><td>" . $interface['MQ'] . "</td><td>" . $interface['Web Services'] . "</td><td>" . $interface['Gateway payment'] . "</td><td>" . $interface['Google Analytics'] . "</td><td>" . $interface['Chat Bot'] . "</td><td>" . $result2['API'] . "</td><td>" . $result2['Email'] . "</td><td>" . $result2['Faxination'] . "</td><td>" . $result2['SMTP'] . "</td><td>" . $result2['Fax'] . "</td><td>" . $result2['SMS'] . "</td><td>" . $result2['Windows Service'] . "</td><td>" . $interface['Total Count'] . "</td></tr>";
                                                  }
                                             }
                                             ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     </div>
     </div>
     <!-- Argon Scripts -->
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
     <script src="assets/js/amchart.js"></script>
     <script src="assets/js/chart.js"></script>
     <script src="assets/js/animated.js"></script>


     <script>
          $(document).ready(function() {
               $('#sidebarCollapse').on('click', function() {
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
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-ORSA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("LOB" => "ORSA");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputORSA", $query);
                    // $results = $results1->toArray();
                    $results = $collection3->find(array("LOB" => "ORSA"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }
                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });

          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Decomm-ORSA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php

                    // $filter = array("ActiontoleadFinal" => "Decommission");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputORSA", $query);
                    // $results = $results1->toArray();
                    $results = $collection3->find(array("ActiontoleadFinal" => "Decommission"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
                              "Application": "' . $result['appname'] . '",
                              "Portability Index":' . $result['portabilityindex'] . ',
                              "technical":' . $result['cyclomaticscore'] . ',							   
                              "maintainabilityindex":' . $result['maintainabilityindex'] . ',
                              "appsizevalue":' . $result['appsizevalue'] . ',
                              "outbound":' . $result['outbounds'] . ',	
                              "inbound":' . $result['inbounds'] . ',						    
                              "appcriticality":' . $result['appcriticality'] . ',
                              "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
                              "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Remains-ORSA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php

                    // $filter = array("ActiontoleadFinal" => "Remains");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputORSA", $query);
                    // $results = $results1->toArray();
                    //$results = $collection->find($filter, $options);
                    $results = $collection3->find(array("ActiontoleadFinal" => "Remains"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
                              "Application": "' . $result['appname'] . '",
                              "Portability Index":' . $result['portabilityindex'] . ',
                              "technical":' . $result['cyclomaticscore'] . ',							   
                              "maintainabilityindex":' . $result['maintainabilityindex'] . ',
                              "appsizevalue":' . $result['appsizevalue'] . ',
                              "outbound":' . $result['outbounds'] . ',	
                              "inbound":' . $result['inbounds'] . ',						    
                              "appcriticality":' . $result['appcriticality'] . ',
                              "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
                              "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Integrate-ORSA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Integrate");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputORSA", $query);
                    // $results = $results1->toArray();
                    $results = $collection3->find(array("ActiontoleadFinal" => "Integrate"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-NA-ORSA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php

                    // $filter = array("ActiontoleadFinal" => "Out of scope");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputORSA", $query);
                    // $results = $results1->toArray();
                    $results = $collection3->find(array("ActiontoleadFinal" => "Out of scope"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          var chart = AmCharts.makeChart("portability-chart-OO", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("LOB" => "OO");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOO", $query);
                    // $results = $results1->toArray();
                    $results = $collection4->find(array("LOB" => "OO"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }
                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon1": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon1");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Decomm-OO", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Decommission");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOO", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Decommission");
					$results = $collection4->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection4->find(array("ActiontoleadFinal" => "Decommission"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon1": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon1");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Remains-OO", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Remains");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOO", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Remains");
					$results = $collection4->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection4->find(array("ActiontoleadFinal" => "Remains"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon1": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon1");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Integrate-OO", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Integrate");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOO", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Integrate");
					$results = $collection4->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection4->find(array("ActiontoleadFinal" => "Integrate"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon1": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon1");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-NA-OO", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Out of scope");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOO", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Out of scope");
					$results = $collection4->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection4->find(array("ActiontoleadFinal" => "Out of scope"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon1": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon1");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          var chart = AmCharts.makeChart("portability-chart-OA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    /*$input1 = array("LOB"=>"OA");	
				$results = $collection->find($input1);
				$results->sort(array('portabilityindex' => -1));*/
                    // $filter = array("LOB" => "OA");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOA", $query);
                    // $results = $results1->toArray();
                    $results = $collection5->find(array("LOB" => "OA"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }
                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon2": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon2");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Decomm-OA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Decommission");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOA", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Decommission");
					$results = $collection5->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection5->find(array("ActiontoleadFinal" => "Decommission"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon2": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon2");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Remains-OA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Remains");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOA", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Remains");
					$results = $collection5->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection5->find(array("ActiontoleadFinal" => "Remains"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon2": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon2");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Integrate-OA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Integrate");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOA", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Integrate");
					$results = $collection5->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection5->find(array("ActiontoleadFinal" => "Integrate"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon2": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon2");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-NA-OA", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Out of scope");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOA", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Out of scope");
					$results = $collection5->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection5->find(array("ActiontoleadFinal" => "Out of scope"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon2": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon2");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          var chart = AmCharts.makeChart("portability-chart-OT", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    /*$input1 = array("LOB"=>"OT");	
				$results = $collection->find($input1);
				$results->sort(array('portabilityindex' => -1));*/
                    // $filter = array("LOB" => "OT");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOT", $query);
                    // $results = $results1->toArray();
                    $results = $collection6->find(array("LOB" => "OT"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }
                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon3": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon3");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Decomm-OT", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Decommission");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOT", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Decommission");
					$results = $collection6->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection6->find(array("ActiontoleadFinal" => "Decommission"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon3": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon3");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Remains-OT", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Remains");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOT", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Remains");
					$results = $collection6->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection6->find(array("ActiontoleadFinal" => "Remains"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon3": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon3");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Integrate-OT", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Integrate");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOT", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Integrate");
					$results = $collection6->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection6->find(array("ActiontoleadFinal" => "Integrate"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon3": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon3");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-NA-OT", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Out of scope");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputOT", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Out of scope");
					$results = $collection6->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection6->find(array("ActiontoleadFinal" => "Out of scope"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon3": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon3");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          var chart = AmCharts.makeChart("portability-chart-XLOB", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    /*$input1 = array("LOB"=>"XLoB");	
				$results = $collection->find($input1);
				$results->sort(array('portabilityindex' => -1));*/
                    // $filter = array("LOB" => "XLoB");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputXLOB", $query);
                    // $results = $results1->toArray();
                    $results = $collection7->find(array("LOB" => "XLoB"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }
                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon4": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });


          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon4");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Decomm-XLOB", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Decommission");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputXLOB", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Decommission");
					$results = $collection7->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection7->find(array("ActiontoleadFinal" => "Decommission"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon4": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon4");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Remains-XLOB", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Remains");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputXLOB", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Remains");
					$results = $collection7->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection7->find(array("ActiontoleadFinal" => "Remains"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon4": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon4");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-Integrate-XLOB", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Integrate");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputXLOB", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Integrate");
					$results = $collection7->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection7->find(array("ActiontoleadFinal" => "Integrate"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon4": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon4");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
     <script>
          AmCharts.addInitHandler(function(chart) {

               var dataProvider = chart.dataProvider;
               var colorRanges = chart.colorRanges;

               // Based on https://www.sitepoint.com/javascript-generate-lighter-darker-color/
               function ColorLuminance(hex, lum) {

                    // validate hex string
                    hex = String(hex).replace(/[^0-9a-f]/gi, '');
                    if (hex.length < 6) {
                         hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
                    }
                    lum = lum || 0;

                    // convert to decimal and change luminosity
                    var rgb = "#",
                         c, i;
                    for (i = 0; i < 3; i++) {
                         c = parseInt(hex.substr(i * 2, 2), 16);
                         c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
                         rgb += ("00" + c).substr(c.length);
                    }

                    return rgb;
               }

               if (colorRanges) {

                    var item;
                    var range;
                    var valueProperty;
                    var value;
                    var average;
                    var variation;
                    for (var i = 0, iLen = dataProvider.length; i < iLen; i++) {

                         item = dataProvider[i];

                         for (var x = 0, xLen = colorRanges.length; x < xLen; x++) {

                              range = colorRanges[x];
                              valueProperty = range.valueProperty;
                              value = item[valueProperty];

                              if (value >= range.start && value <= range.end) {
                                   average = (range.start - range.end) / 2;

                                   if (value <= average)
                                        variation = (range.variation * -1) / value * average;
                                   else if (value > average)
                                        variation = range.variation / value * average;

                                   item[range.colorProperty] = ColorLuminance(range.color, variation.toFixed(2));
                              }
                         }
                    }
               }

          }, ["serial"]);

          var chart = AmCharts.makeChart("portability-chart-NA-XLOB", {
               "type": "serial",
               "theme": "light",
               "colorRanges": [{
                    "start": 0,
                    "end": 0.4,
                    "color": "#990707",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.401,
                    "end": 0.8,
                    "color": "#0d8ecf",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }, {
                    "start": 0.801,
                    "end": 1,
                    "color": "#22aa99",
                    "variation": 0,
                    "valueProperty": "Portability Index",
                    "colorProperty": "color"
               }],
               "dataProvider": [
                    <?php
                    // $filter = array("ActiontoleadFinal" => "Out of scope");
                    // $options = ['sort' => array('portabilityindex' => -1)];
                    // $query = new MongoDB\Driver\Query($filter, $options);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results1 = $manager->executeQuery("allianz.masterinputXLOB", $query);
                    // $results = $results1->toArray();
                    /*$input11 = array("ActiontoleadFinal"=>"Out of scope");
					$results = $collection7->find($input11);
					$results->sort(array('portabilityindex' => -1));*/
                    $results = $collection7->find(array("ActiontoleadFinal" => "Out of scope"))->sort(array('portabilityindex' => -1));
                    foreach ($results as $result) {

                         $score = $result['portabilityindex'];
                         if ($score > 0 & $score < 0.651) {
                              $color = ',"rgb(153, 7, 7)"],';
                         } elseif ($score > 0.851 & $score < 1) {
                              $color = ',"rgb(34, 170, 153)"],';
                         } else {
                              $color = ',"rgb(13, 142, 207)"],';
                         }
                         echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] . ',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] . ',
							    "appsizevalue":' . $result['appsizevalue'] . ',
							    "outbound":' . $result['outbounds'] . ',	
							    "inbound":' . $result['inbounds'] . ',						    
							    "appcriticality":' . $result['appcriticality'] . ',
							    "languagecomplexityscore":' . $result['languagecomplexityscore'] . ',
							    "Stability":' . $result['stabilityscore'] .
                              '},';
                    }

                    ?>
               ],
               "valueAxes": [{
                    "gridColor": "#FFFFFF",
                    "gridAlpha": 0.2,
                    "dashLength": 0,
                    "title": "Portability Index",
                    "position": "top"
               }],
               "gridAboveGraphs": true,
               "startDuration": 1,
               "graphs": [{
                    // "balloonText": "[[Application]]:<br/>Portability Index:[[Portability Index]]<br/>Cyclomatic Complexity:[[cyclomatic]]<br/>Maintainability Index:[[maintainabilityindex]]<br/>Application Size:[[appsizevalue]]<br/>Outbound Interfaces:[[outbound]]<br/>Inbound Interfaces:[[inbound]]<br/>Application Criticality:[[appcriticality]]<br/>Language Comlexity:[[languagecomplexityscore]]<br/>Stability:[[Stability]]<br/> ",
                    "labelText": "[[Portability Index]]",
                    "fillAlphas": 0.8,
                    "lineAlpha": 0.2,
                    "type": "column",
                    "valueField": "Portability Index",
                    "colorField": "color",
                    "balloon4": {
                         "adjustBorderColor": true,
                         "color": "#000000",
                         "cornerRadius": 5,
                         "fillColor": "#FFFFFF",
                         "fillAlpha": 20
                    }
               }],
               "chartCursor": {
                    "categoryBalloonEnabled": true,
                    "cursorAlpha": 0,
                    "zoomable": false
               },
               "categoryField": "Application",
               "rotate": true,
               "categoryAxis": {
                    "gridPosition": "start",
                    "labelRotation": 25,
                    "gridAlpha": 0,
                    "title": "Applications",
                    "fontSize": 8
               },
               "export": {
                    "enabled": true,
                    "fileName": "portability_metrics"
               }

          });
          chart.addListener("rollOverGraphItem", function(event) {
               var b = document.getElementById("balloon4");
               b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" +
                    "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"] + "</b><br>" +
                    "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" +
                    "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"] + "</b><br>" +
                    "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" +
                    "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" +
                    "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" +
                    "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" +
                    "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>" +
                    "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
               //console.log('event.item.category= ', event.item);
               //b.style.display = "block";
               b.style.color = event.item.color;
          });
     </script>
</body>

</html>