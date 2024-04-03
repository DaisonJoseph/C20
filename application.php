<?php
// require '/var/www/html/vendor/autoload.php';
$m = new MongoClient();
$db = $m->allianz;
session_start();
if (isset($_SESSION["Uid"])) {
     $username = $_SESSION["Uid"];
}
$filename = basename($_SERVER['PHP_SELF']);
?>
<?php
//   session_start();
$m = new MongoClient();
$db = $m->allianz;
$collection = $db->Application;
$results = $collection->find();
//	$user = $db->user; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } 
?>
<!DOCTYPE html>
<html>

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <title>CAP360 Decommission Analyzer</title>
     <!--old UI-->
     <link href="css/style.css" rel="stylesheet">
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
                              <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Applications Master Inventory</div>
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
                                             <!--<span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="images/<?php echo $username ?>.jpg">
                  </span>-->
                                             <div class="media-body  ml-2  d-none d-lg-block">
                                                  <span class="mb-0 text-sm  font-weight-bold" style="text-transform: uppercase"><?php echo $username ?></span>
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
                                   <a href="download.php?input=appinv" class="blue-cascade pull-right" style="display:inline"> Download CSV
                                        <i class="fa fa-download"></i>
                                   </a>
                                   <div class="table-responsive">

                                        <!-- Projects table -->
                                        <table class="table align-items-center table-flush">
                                             <thead class="thead-light">
                                                  <tr>
                                                       <th scope="col">Application Name</th>
                                                       <th scope="col">Type of Application</th>
                                                       <th scope="col">Application Category</th>
                                                       <th scope="col">LOB</th>
                                                       <th scope="col">Application Owner</th>
                                                       <th scope="col">Action to Lead</th>
                                                       <th scope="col">Application Age</th>
                                                       <th scope="col">Minimum Expected Life</th>
                                                       <th scope="col">Handles Legal Compliance</th>
                                                       <th scope="col">Single/Group Of Applications</th>
                                                       <th scope="col">Interfaces with Application that handle Regulatory Compliance</th>
                                                       <th scope="col">Source Code Archival</th>
                                                       <th scope="col">Incoming Dependencies</th>
                                                       <th scope="col">Outgoing Dependencies</th>
                                                       <th scope="col">Business Criticality</th>
                                                       <th scope="col">Revenue Impact</th>
                                                       <th scope="col">Application Size based on Lines of code</th>
                                                       <th scope="col">Application Complexity based on Process Involved</th>
                                                       <th scope="col">Current Database Size</th>
                                                       <th scope="col">Number of Reports generated</th>
                                                       <th scope="col">Frequency of Reports</th>
                                                       <th scope="col">Count of Server the Application Hosted on</th>
                                                       <th scope="col">Other Applications using the same server</th>
                                                       <th scope="col">Any Third party Tools used</th>
                                                       <th scope="col">Count of Resources Supporting & Maintaining the Application</th>
                                                       <th scope="col">Application saves Historical Data</th>
                                                       <th scope="col">Support Level to Maintain the Application</th>
                                                       <th scope="col">Level of documentation available</th>
                                                       <th scope="col">Ongoing Enhancements</th>
                                                       <th scope="col">Teams Knowledge on the Application</th>
                                                       <th scope="col">Technologies used</th>
                                                       <th scope="col">Number of Users</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <?php
                                                  foreach ($results as $result) {
                                                       echo "<tr><td>" . $result['Application Name'] . "</td><td>" . $result['Type of Application'] . "</td><td>" . $result['Application Category'] . "</td><td>" . $result['LOB'] . "</td><td>" . $result['Application Owner'] . "</td><td>" . $result['Action to Lead'] . "</td><td>" . $result['Application Age'] . "</td><td>" . $result['Minimum Expected Life'] . "</td><td>" . $result['Handles Legal Compliance'] . "</td><td>" . $result['Single/Group Of Applications'] . "</td><td>" . $result['Interfaces with Application that  handle Regulatory  Compliance'] . "</td><td>" . $result['Source Code Archival'] . "</td><td>" . $result['Incoming Dependencies'] . "</td><td>" . $result['Outgoing Dependencies'] . "</td><td>" . $result['Business Criticality'] . "</td><td>" . $result['Revenue Impact'] . "</td><td>" . $result['Application Size based on  Lines of code'] . "</td><td>" . $result['Application Complexity based  on Process Involved'] . "</td><td>" . $result['Current Database Size'] . "</td><td>" . $result['Number of Reports generated'] . "</td><td>" . $result['Frequency of Reports'] . "</td><td>" . $result['Count of Server the Application   Hosted on'] . "</td><td>" . $result['Other  Applications using the same server'] . "</td><td>" . $result['Any Third party Tools  used'] . "</td><td>" . $result['Count of Resources Supporting & Maintaining the Application'] . "</td><td>" . $result['Application saves Historical Data'] . "</td><td>" . $result['Support Level  to Maintain the Application'] . "</td><td>" . $result['Level of documentation available'] . "</td><td>" . $result['Ongoing Enhancements'] . "</td><td>" . $result['Teams Knowledge on the Application'] . "</td><td>" . $result['Technologies used'] . "</td><td>" . $result['Number of Users'] . "</td></tr>";
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
     <script src="js/amchart.js"></script>
     <script src="js/chart.js"></script>
     <script src="js/animated.js"></script>
     <script src="https://www.amcharts.com/lib/4/core.js"></script>
     <script src="https://www.amcharts.com/lib/4/charts.js"></script>
     <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
     <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
     <!-- Custom Js -->
     <script src="js/admin.js"></script>
     <script src="js/pages/index.js"></script>

     <!-- Demo Js -->
     <script src="js/demo.js"></script>

     <script>
          $(document).ready(function() {
               $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').toggleClass('active');
                    $(this).toggleClass('active');
               });
          });
     </script>
     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
     <script>
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("chartdiv", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [

               <?php
               foreach ($poa as $selectedpoa) {
               ?>

                    {
                         from: "<?php echo $selectedpoa['Applications']; ?>",
                         to: "<?php echo $selectedpoa['TargetApplication']; ?>",
                         value: 8
                    },

               <?php
               }

               ?>

          ];

          chart.links.template.tooltipText = "{fromName} → {toName} "; //\n Application Size : [bold]{value}

          var hoverState = chart.links.template.states.create("hover");
          hoverState.properties.fillOpacity = 4.6;

          chart.dataFields.fromName = "from";
          chart.dataFields.toName = "to";
          chart.dataFields.value = "value";


          // for right-most label to fit
          chart.paddingRight = 140;

          chart.nodes.template.nameLabel.label.truncate = false;
          chart.nodes.template.nameLabel.label.wrap = true;


          // Exporting
          chart.exporting.menu = new am4core.ExportMenu();
          chart.exporting.filePrefix = "poa";



          var nodeLink = chart.links.template;
          var bullet = nodeLink.bullets.push(new am4charts.CircleBullet());

          bullet.fillOpacity = 1;
          bullet.circle.radius = 5;
          bullet.locationX = 0.5;


          // var bullet1 = nodeLink.bullets.push(new am4charts.CircleBullet());

          // bullet1.fillOpacity = 1;
          // bullet1.circle.radius = 5;
          // bullet1.locationX = 0.5;

          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);

                    // var bullet1 = link1.bullets.getIndex(1);
                    // animateBullet(bullet1);
               }
          })

          function animateBullet(bullet) {
               var duration = 3000 * Math.random() + 2000;
               var animation = bullet.animate([{
                    property: "locationX",
                    from: 0,
                    to: 1
               }], duration)
               animation.events.on("animationended", function(event) {
                    animateBullet(event.target.object);
               })
          }
     </script>
</body>

</html>
</body>

</html>