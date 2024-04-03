<?php
// require '/var/www/html/vendor/autoload.php';
session_start();

$m = new MongoClient();
$db = $m->allianz;
$collection = $db->jobcard;
$results = $collection->find();
foreach ($results as $result) {
     $appname = $result['appname'];
}
if (isset($_SESSION["Uid"])) {
     $username = $_SESSION["Uid"];
}
$filename = basename($_SERVER['PHP_SELF']);

if (isset($_SESSION['Uid'])) {
     //header('Location:index.php');
} else {
     header('Location:login.php');
}

$id = 1;
?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <title>CAP360 Decommission Analyzer</title>
     <!--old UI-->
     <link href="assets/css/style.css" rel="stylesheet">
     <link href="assets/css/hexa.css" rel="stylesheet">
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
     <!-- Bootstrap Core Css -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


     <style>
          #link {
               color: #FFFFFF;
          }

          .modal {
               overflow: auto !important;
          }

          body {
               overflow-x: hidden;
               /* Hide horizontal scrollbar */
          }

          input[type=text] {
               width: 100%;
               height: auto;
               color: white;
               text-align: center;
               word-wrap: break-word;
               background-color: #342668;
               padding: 12px 20px;
               margin: 3px 0;
               display: inline-block;
               border: 1px solid #ccc;
               border-radius: 4px;
               box-sizing: border-box;
          }

          input[type=button] {
               width: 100%;
               height: auto;
               color: white;
               text-align: center;
               word-wrap: break-word;
               background-color: #342668;
               padding: 12px 20px;
               margin: 3px 0;
               display: inline-block;
               border: 1px solid #ccc;
               border-radius: 4px;
               box-sizing: border-box;
          }

          .verticle {
               width: 100%;
               height: auto;
               color: white;
               text-align: center;
               background-color: #342668;
               padding: 12px 20px;
               margin: 3px 0;
               display: inline-block;
               border: 1px solid #ccc;
               border-radius: 4px;
               box-sizing: border-box;
          }
     </style>
</head>

<body onload="setStyles()">
     <nav class="navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
          <div class="scrollbar-inner">
               <!-- Brand -->
               <div class="sidenav-header  align-items-center">
                    <a class="navbar-brand" href="javascript:void(0)">
                         <p>
                              <h3 style="font-size:20px;color: #00006E;margin-top: 14px;"><strong>Decommission Analyzer</strong></h3>
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
                                             <i class="ni ni-tv-2 text-primary" style="font-size:16px;"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-left: 10px;"><strong>Dashboard</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "portability-metrics.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="portability-metrics.php">
                                             <i class="material-icons text-primary" style="font-size:16px;margin-top: 20px;">layers</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Portability Metrics</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "risk-criticality.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="risk-criticality.php">
                                             <i class="material-icons text-yellow" style="font-size:16px;margin-top: 20px;">trending_up</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Risk and Criticality</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "poa.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="poa.php">
                                             <i class="material-icons text-pink" style="font-size:16px;margin-top: 20px;">swap_calls</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>POA Map</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "application.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="application.php">
                                             <i class="ni ni-bullet-list-67 text-default" style="font-size:16px;margin-top: 20px;"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Applications</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "jobcard.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="jobcard.php">
                                             <i class="material-icons text-green" style="font-size:16px;margin-top: 20px;">assignment</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Jobcard</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "demisePattern.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="demisePattern.php">
                                             <i class="ni ni-sound-wave text-purple" style="font-size:16px;margin-top: 20px;"></i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Demise Pattern</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "cluster.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="cluster.php">
                                             <i class="material-icons text-primary" style="font-size:16px;margin-top: 20px;">layers</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 20px;margin-left: 10px;"><strong>Decommission Cluster</strong></span>
                                        </a>
                                   </li>
                                   </li>
                              </ul>
                         </div>
                    </div>
               </div>
               <?php //include 'sidebar.php' 
               ?>
     </nav>

     <!-- Main content -->
     <div class="main-content" id="panel">
          <!-- Topnav -->
          <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
               <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                         <div class="col-xl-5">
                              <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Job Card
                                   <div class="card-body mb-0 text-sm" style="text-transform: uppercase;color:#edeffc;margin-left: 1125px;font-weight:700;font-family: Open Sans, sans-serif;">
                                        <h6 role="button" data-toggle="dropdown" style="margin-top: -25px;color:white;">
                                             <strong><?php echo $username ?></strong>
                                        </h6>
                                        <span class="dropdown-menu" style="margin-left: 1070px;margin-top: -30px;">
                                             <a href="login.php" class="dropdown-item">
                                                  <i class="ni ni-user-run"></i>
                                                  <span>Logout</span>
                                             </a>
                                        </span>
                                   </div>
                              </div>
                              <img src="images/allianz3.png" alt="ficoh" style="height:50px;width:180px;margin-left: 900px;margin-top: -130px;">
                         </div>
                    </div>
               </div>
          </nav>

          <section class="content">
               <div class="row">
                    <div class="container-fluid">
                         <section class="menu-list">
                              <?php
                              /*$filter = array();
					$options = array();*/
                              // $query = new MongoDB\Driver\Query([]);
                              // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                              // $results1 = $manager->executeQuery("allianz.jobcard", $query);
                              // $results = $results1->toArray();
                              //print_r($results);
                              // $results 
                              foreach ($results as $result) {
                                   $appname = $result['appname'];
                              ?>
                                   <p class="hexagon item-<?php echo $result['ID']; ?>"><a href="#<?php echo $result['ID'] ?>" class="label" style="padding: 26px 0;font-size:10px;" data-toggle="modal" data-target="#<?php echo $result['ID']; ?>"><?php echo "$appname" ?></a></p>
                              <?php
                              }
                              ?>
                         </section>
                         <?php
                         // $query = new MongoDB\Driver\Query([]);
                         // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                         // $results2 = $manager->executeQuery("allianz.jobcard", $query);
                         // $resultss = $results2->toArray();
                         foreach ($results as $result1) {
                              $appname = $result1['appname'];
                         ?>
                              <!-- Modal -->
                              <div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result1['ID']; ?>" role="dialog">
                                   <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                             <div class="modal-header" style="background-color:#ffbf00">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h3 style="text-align:center;font-size:35px;" class="modal-title"><strong>Application Name - <?php echo "$appname" ?></strong></h3>
                                             </div>
                                             <div class="modal-body">
                                                  <div class="container-fluid">
                                                       <div style="border: 2px solid black;width:100%;">
                                                            <div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
                                                                 <div class="col-sm-3">
                                                                      <div style="text-align:center;"><strong>Application Type</strong></div>
                                                                      <div style="margin-bottom:15px"><input type="text" value="<?php echo $result1['applicationtype']; ?>" /></div>
                                                                      <div style="text-align:center;"><strong>Line Of Business</strong></div>
                                                                      <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['LOB'] ?>" /></div>
                                                                      <div style="text-align:center;"><strong>Application Owner</strong></div>
                                                                      <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['ApplicationOwner'] ?>" /></div>
                                                                      <div style="text-align:center;"><strong>Currently Active</strong></div>
                                                                      <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['ApplicationCurrentlyActive'] ?>" /></div>
                                                                      <div style="text-align:center;"><strong>Age Of Application</strong></div>
                                                                      <div style="margin-bottom:25px"><input type="text" readonly value="<?php echo $result1['ApplicationAge'] ?>" /></div>
                                                                      <div style="text-align:center;margin-bottom:10px"><strong>Total No. of Days to Decommission(Indicative)</strong></div>
                                                                      <h2 style="margin-top:7px;margin-bottom:25px; margin-left:60px;font-family: 'Cambria', serif;font-size:30px;color:black;"><?php echo $result1['noofDays'] ?> </h2>
                                                                      <div style="text-align:center;"><strong>Resource Required</strong></div>
                                                                      <!--<h3 style="text-align:center;font-family: 'Cambria', serif;color:black;"><span style="font-size:12px;">Approx.</span>$<?php echo $result1['Cost'] ?> </h3>-->
                                                                      <div class="row">
                                                                           <div class="col-sm-2">
                                                                                <h3 style="text-align:center;font-family: 'Cambria', serif;color:black;margin-left:65px;margin-bottom:25px;margin-top: 8px;"><?php echo $result1['Cost'] ?> </h3>
                                                                           </div>
                                                                           <div class="col-sm-10">
                                                                                <img style="margin-left:90px;margin-bottom:25px;margin-top: 8px;" src="images/men.png" alt="image">
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                                 <div class="col-sm-9 ">
                                                                      <div style="text-align:center;"><strong>Decommission Pattern</strong></div>
                                                                      <div>
                                                                           <textarea class="verticle" rows="1"><?php echo $result1['demisePattern'] ?></textarea>
                                                                      </div>
                                                                      <div style="text-align:center;"><strong>Application Description</strong></div>
                                                                      <div>
                                                                           <textarea class="verticle" rows="1"><?php echo $result1['description'] ?></textarea>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>Point Of Arrival</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['pointOfArrival'] ?>" /></div>
                                                                                <!--<div>
															<textarea class="verticle" rows="1" ><?php //echo $result['pointOfArrival']
                                                                                                                   ?></textarea>
														</div>-->
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>POA Ready</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['poaReady'] ?>" /></div>
                                                                           </div>
                                                                           <!--<div  class="col-sm-4">
													<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php //echo $result['endDate']
                                                                                                                             ?>" /></div>
												</div>-->
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>Demise Start Date</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['startDate'] ?>" /></div>
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['endDate'] ?>" /></div>
                                                                           </div>
                                                                           <!--<div  class="col-sm-4">
														<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
														<div style="margin-bottom:15px"><input type="text" value="<?php echo $result['endDate'] ?>" /></div>
												</div>-->
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:15px;"><strong>Decommission Pattern Detail</strong></div>
                                                                                <table id="myTable" class="table table-striped">
                                                                                     <tbody>
                                                                                          <!--<tr style="padding:4px !important;">
																<td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;">Data for Compliance </td>
																<td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataforCompliance_<?php echo $result1['ID'] ?>"> <?php echo $result1['DataforCompliance'] ?></td>
															</tr>
															<tr>
																<td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Gap Analysis </td>
																<td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="GapAnalysis_<?php echo $result1['ID'] ?>"> <?php echo $result1['GapAnalysis'] ?></td>
															</tr>
															<tr>
																<td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Migration </td>
																<td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataMigration_<?php echo $result1['ID'] ?>"><?php echo $result1['DataMigration'] ?></td>
															</tr>-->
                                                                                          <tr>
                                                                                               <td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Data Archival </td>
                                                                                               <td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="DataArchival_<?php echo $result1['ID'] ?>"> <?php echo $result1['DataArchival'] ?></td>
                                                                                          </tr>
                                                                                          <!--<tr>
																td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> Big Bang </td>
																<td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="BigBang_<?php //echo $result1['ID']
                                                                                                                                                                ?>"> <?php //echo $result1->BigBang
                                                                                                                                                                     ?></td>
															</tr>
															<tr>
																<td style="background-color:#342668;color:#FFFFFF;padding:4px !important;text-align:center;"> User Migration </td>
																<td style="text-align:center;color:#FFFFFF;padding:4px !important;" id="UserMigration_<?php echo $result1['ID'] ?>"> <?php echo $result1['UserMigration'] ?></td>
															</tr>-->
                                                                                     </tbody>
                                                                                </table>
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;"><strong>Decommission Sequence</strong></div>
                                                                                <div class="circle1" style="margin-bottom:10px;font-size: 30px;"><?php echo $result1['demiseSequence'] ?></div>
                                                                                <!--<div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
													<div style="margin-bottom:25px"><input type="text"  value="<?php echo $result['support'] ?>"/></div>-->
                                                                           </div>
                                                                      </div>
                                                                      <div class="row">
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>Level Of Documentation</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['LevelOfDocumentation'] ?>" /></div>
                                                                           </div>
                                                                           <div class="col-sm-6">
                                                                                <div style="text-align:center;margin-bottom:10px;"><strong>Support</strong></div>
                                                                                <div style="margin-bottom:15px"><input type="text" readonly value="<?php echo $result1['Support'] ?>" /></div>
                                                                           </div>
                                                                           <!--<div  class="col-sm-4">
													<div style="text-align:center;margin-bottom:10px;"><strong>Demise End Date</strong></div>
													<div style="margin-bottom:15px"><input type="text" value="<?php echo $result1['endDate'] ?>" /></div>
												</div>-->
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="modal-footer">
                                                  <!--<a class="left carousel-control" href="#<?php //echo $result['demiseSequence']
                                                                                               ?>" role="button" data-slide="prev">-->
                                                  <!--<span class="glyphicon glyphicon-chevron-left" id="<?php //echo $result['demiseSequence']
                                                                                                         ?> - 1" onclick="slideIt('toLeft');"></span>-->
                                                  <!--</a>
								 <a class="right carousel-control" href="#<?php //echo $result['demiseSequence']
                                                                                     ?>" role="button" data-slide="next">-->
                                                  <!--<span class="glyphicon glyphicon-chevron-right" id="<?php //echo $result['demiseSequence']
                                                                                                              ?> + 1" onclick="slideIt('toRight');"></span>-->
                                                  <!--</a>-->

                                                  <!--<button type="button" class="glyphicon glyphicon-chevron-left data-toggle="modal" data-target="#<?php //echo $result['ID']; 
                                                                                                                                                      ?>" id="<?php //echo $result['demiseSequence']  - 1; 
                                                                                                                                                                ?>"></button>-->
                                                  <!--<a href="sample.php?file=<?php //echo $result["ID"]
                                                                                ?>.pdf">Download the Job Card</a>-->
                                                  <button class="btn" style="background-color:#3F51B5;margin-right:160px;">
                                                       <a id="link" href="jobcards/sample.php?file=<?php echo $result1['appname'] ?>.pdf" class="pull-left"> Download Jobcard
                                                            <i class="fa fa-download"></i>
                                                       </a>
                                                  </button>
                                                  <button type="button" style="margin-right:150px;" class="glyphicon glyphicon-chevron-left btn btn-default" <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result1['ID'] - 1; ?>"></button>
                                                  <button type="button" style="margin-right:250px;" class="glyphicon glyphicon-chevron-right btn btn-default " <a href="#" class="label" data-dismiss="modal" data-toggle="modal" data-target="#<?php echo $result1['ID'] + 1; ?>"></button>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                              <!--Modal close-->
                         <?php
                         }
                         ?>
                    </div>
               </div>
          </section>




          <!-- Argon Scripts -->
          <!-- Core -->
          <script src="assets/vendor/jquery/dist/jquery.min.js"></script>
          <script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
          <script src="assets/vendor/js-cookie/js.cookie.js"></script>
          <script src="assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
          <script src="assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
          <!-- Optional JS 
  <script src="assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
          <script src="assets/js/argon.js?v=1.2.0"></script>
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


          <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
          <script src="https://www.amcharts.com/lib/3/serial.js"></script>
          <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
          <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
          <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

          <script>
               $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                         $('#sidebar').toggleClass('active');
                         $(this).toggleClass('active');
                    });
               });
          </script>
          <script>
               function setStyles() {
                    setDecomissionPattern();

               }

               function setDecomissionPattern() {
                    <?php
                    /*$query = new MongoDB\Driver\Query([]);
	$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
	$results3 = $manager->executeQuery("allianz.jobcard", $query);
	$resultsss = $results3 -> toArray();*/
                    foreach ($resultss as $result1) {
                    ?>
                         var DataforCompliance_<?php echo $result1['ID'] ?> = '<?php echo $result1['DataforCompliance']; ?>';

                         /*if(DataforCompliance_<?php echo $result1['ID'] ?> == "Yes")
	   {
		 	
		   document.getElementById('DataforCompliance_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('DataforCompliance_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
	   }*/

                         /*var GapAnalysis_<?php echo $result1['ID'] ?> = '<?php echo $result1['GapAnalysis']; ?>';
	   if(GapAnalysis_<?php echo $result1['ID'] ?> == "yes")
	   {
		   
		   document.getElementById('GapAnalysis_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
	   }
	   else
	   {
		  document.getElementById('GapAnalysis_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
	   }*/

                         /* var DataMigration_<?php echo $result1['ID'] ?> = '<?php echo $result1['DataMigration']; ?>';
	   if(DataMigration_<?php echo $result1['ID'] ?> == 'Yes')
	   {
		   
		   document.getElementById('DataMigration_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('DataMigration_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
	   }*/

                         var DataArchival_<?php echo $result1['ID'] ?> = '<?php echo $result1['DataArchival']; ?>';
                         if (DataArchival_<?php echo $result1['ID'] ?> == 'Yes') {

                              document.getElementById('DataArchival_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
                         }
                         if (DataArchival_<?php echo $result1['ID'] ?> == 'TBD') {
                              document.getElementById('DataArchival_<?php echo $result1['ID'] ?>').style.backgroundColor = "orange";
                         } else {
                              document.getElementById('DataArchival_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
                         }

                         /*var BigBang_<?php echo $result1['ID'] ?> = '<?php echo $result1['BigBang']; ?>';
	   if(BigBang_<?php echo $result1['ID'] ?> == 'Yes')
	   {
		   
		   document.getElementById('BigBang_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('BigBang_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
	   }
	   
	   var UserMigration_<?php echo $result1['ID'] ?> = '<?php echo $result1['UserMigration']; ?>';
	   if(UserMigration_<?php echo $result1['ID'] ?> == 'Yes')
	   {
		   
		   document.getElementById('UserMigration_<?php echo $result1['ID'] ?>').style.backgroundColor = "green";
	   }
	   else
	   {
		   document.getElementById('UserMigration_<?php echo $result1['ID'] ?>').style.backgroundColor = "red";
	   }*/
                    <?php
                    }
                    ?>

               }
          </script>

          <script>
               $(".hexagon")
                    .mouseenter(function() {
                         $(this).addClass('active');
                    })
                    .mouseleave(function() {
                         $(this).removeClass('active');
                    });
          </script>

</body>

</html>