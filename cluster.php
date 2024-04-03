<?php
// require '/var/www/html/vendor/autoload.php';
session_start();

// $m = new MongoDB\Client("mongodb://localhost:27017");
$m = new MongoClient();
$db = $m->allianz;
$collection = $db->cluster;
// $results = [ 'find' => 'cluster'];
$results = $collection->find();
foreach ($results as $result) {
     $cluster = $result['cluster'];
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
     <link href="assets/css/hexacluster.css" rel="stylesheet">
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

<body>
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
                              <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Decommission Cluster
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
     </div>
     </nav>

     <section class="content">
          <div class="row">
               <div class="container-fluid">
                    <section class="menu-list">
                         <?php
                         // $query = new MongoDB\Driver\Query([]);
                         // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                         // $results1 = $manager->executeQuery("allianz.cluster", $query);
                         // $results = $results1 -> toArray();
                         foreach ($results as $result) {
                              $cluster = $result['cluster'];
                         ?>
                              <p class="hexagon item-<?php echo $result['ID']; ?>"><a href="#<?php echo $result['demiseSequence'] ?>" class="label" style="padding: 26px 0;font-size:10px;" data-toggle="modal" data-target="#<?php echo $result['cluster']; ?>"><?php echo "$cluster" ?></a></p>
                         <?php
                         }
                         ?>
                    </section>
                    <?php
                    // $query = new MongoDB\Driver\Query([]);
                    // $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
                    // $results2 = $manager->executeQuery("allianz.cluster", $query);
                    // $resultss = $results2 -> toArray();
                    foreach ($results as $result1) {
                         $cluster = $result1['cluster'];
                    ?>
                         <!-- Modal -->
                         <div style="font-family: 'Cambria';" class="modal fade" id="<?php echo $result1['cluster']; ?>" role="dialog">
                              <div class="modal-dialog modal-lg" style="width:1250px;height:1250px;">
                                   <!-- Modal content-->
                                   <div class="modal-content">
                                        <div class="modal-header" style="background-color:#ffbf00">
                                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                                             <h3 style="text-align:center;font-size:35px;" class="modal-title"><strong> <?php echo "$cluster" ?></strong></h3>
                                        </div>
                                        <div class="modal-body">
                                             <div class="container-fluid">
                                                  <div style="border: 2px solid black;width: 145%;">
                                                       <div class="row" style="margin-top:20px;margin-left:10px;margin-right:5px;">
                                                            <p><img src="clusters/<?php echo $result1['cluster']; ?>.PNG" style="width:100%;"></p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="modal-footer">
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

     <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
     <script src="https://www.amcharts.com/lib/3/serial.js"></script>
     <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
     <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
     <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

     <script>
          $("#pop").on("click", function() {
               $(this).modal();
          });
     </script>
     <script>
          $(document).ready(function() {
               $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
               });
          });
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