<?php
// require '/var/www/html/vendor/autoload.php';
// $m = new MongoDB\Client("mongodb://localhost:27017");
$m = new MongoClient();
$db = $m->allianz;
session_start();
if (isset($_SESSION["Uid"])) {
     $username = $_SESSION["Uid"];
}
$filename = basename($_SERVER['PHP_SELF']);
?>
<?php
// $m = new MongoDB\Client("mongodb://localhost:27017");
$m = new MongoClient();
$db = $m->allianz;
$collection = $db->poa1;
$poa = $collection->find();

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
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Portability
                                                       Metrics</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "risk-criticality.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="risk-criticality.php">
                                             <i class="material-icons text-yellow" style="margin-top: 5px;">trending_up</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Risk and
                                                       Criticality</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "poa.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="poa.php">
                                             <i class="material-icons text-pink" style="margin-top: 5px;">swap_calls</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>POA
                                                       Map</strong></span>
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
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Demise
                                                       Pattern</strong></span>
                                        </a>
                                   </li>
                                   </li>

                                   <li class="nav-item">
                                   <li <?php if ($filename == "cluster.php") {
                                             echo 'class="active"';
                                        } ?>>
                                        <a class="nav-link active" href="cluster.php">
                                             <i class="material-icons text-primary" style="margin-top: 5px;">layers</i>
                                             <span class="nav-link-text" style="font-size:16px;color:#3F51B5;margin-top: 5px;"><strong>Decommission
                                                       Cluster</strong></span>
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
                         <div class="col-xl-5">
                              <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Point Of Arrival
                                   By Applications</div>
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
                              <!-- Chart 
             <div class="chart" id="chartdiv" style="height: 4500px;"></div>-->
                              <div class="card-body">
                                   <div class="panel-group" id="accordion">
                                        <div class="dropdown btn-group">
                                             <button class="btn btn-primary dropdown-toggle" style="background-color:#3F51B5;" type="button" data-toggle="dropdown">Choose LOB
                                                  <span class="caret"></span>
                                             </button>
                                             <ul class="dropdown-menu">
                                                  <li class="active"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">ORSA</a></li>
                                                  <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">OO</a>
                                                  </li>
                                                  <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">OA</a>
                                                  </li>
                                                  <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">OT</a>
                                                  </li>
                                                  <li><a data-toggle="collapse" data-parent="#accordion" href="#collapse5">XLOB</a></li>
                                             </ul>
                                        </div>
                                        <!--ORSA start-->

                                        <div id="collapse1" class="collapse" data-parent="#accordion">
                                             <h4 style="color:#3F51B5;margin-left:30px;font-size:18px">ORSA</h4>
                                             <div class="panel-group" id="accordion1">
                                                  <div class="panel">
                                                       <div id="collapse1" class="collapse" data-parent="#accordion1">
                                                            <p>
                                                            <div id="poa-ORSA" style="height:3200px;width:1100px;"></div>
                                                            </p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--ORSA END-->
                                        <!--OO Start-->

                                        <div id="collapse2" class="collapse" data-parent="#accordion">
                                             <h4 style="color:#3F51B5;margin-left:30px;">OO</h4>
                                             <div class="panel-group" id="accordion2">
                                                  <div class="panel">
                                                       <div id="collapse2" class="collapse" data-parent="#accordion2">
                                                            <p>
                                                            <div id="poa-OO" style="height:1300px;width:1100px;"></div>
                                                            </p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--OO END-->

                                        <div id="collapse3" class="collapse" data-parent="#accordion">
                                             <h4 style="color:#3F51B5;margin-left:30px;">OA</h4>
                                             <div class="panel-group" id="accordion3">
                                                  <div class="panel">
                                                       <div id="collapse3" class="collapse" data-parent="#accordion3">
                                                            <p>
                                                            <div id="poa-OA" style="height:690px;width:1100px;"></div>
                                                            </p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--OA END-->
                                        <!--OT start-->

                                        <div id="collapse4" class="collapse" data-parent="#accordion">
                                             <h4 style="color:#3F51B5;margin-left:30px;">OT</h4>
                                             <div class="panel-group" id="accordion4">
                                                  <div class="panel">
                                                       <div id="collapse4" class="collapse" data-parent="#accordion4">
                                                            <p>
                                                            <div id="poa-OT" style="height:3000px;width:1100px;"></div>
                                                            </p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>

                                        <!--OT END-->
                                        <!--XLOB start-->

                                        <div id="collapse5" class="collapse" data-parent="#accordion">
                                             <h4 style="color:#3F51B5;margin-left:30px;">XLOB</h4>
                                             <div class="panel-group" id="accordion5">
                                                  <div class="panel">
                                                       <div id="collapse5" class="collapse" data-parent="#accordion5">
                                                            <p>
                                                            <div id="poa-XLOB" style="height:3000px;width:1100px;"></div>
                                                            </p>
                                                       </div>
                                                  </div>
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

     <script src="https://www.amcharts.com/lib/4/core.js"></script>
     <script src="https://www.amcharts.com/lib/4/charts.js"></script>
     <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
     <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
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
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("poa-ORSA", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [
               <?php
               $sql = array("LOB" => "ORSA");
               $selectedPatterns = $collection->find($sql);
               foreach ($selectedPatterns as $selectedPattern) {
               ?> {
                         from: "<?php echo $selectedPattern['Applications']; ?>",
                         to: "<?php echo $selectedPattern['TargetApplication']; ?>",
                         value: 1
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
          chart.fontSize = 12;

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


          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);
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

     <script>
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("poa-OO", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [
               <?php
               $sql = array("LOB" => "OO");
               $selectedPatterns = $collection->find($sql);
               foreach ($selectedPatterns as $selectedPattern) {
               ?> {
                         from: "<?php echo $selectedPattern['Applications']; ?>",
                         to: "<?php echo $selectedPattern['TargetApplication']; ?>",
                         value: 1
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
          chart.fontSize = 12;

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

          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);
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

     <script>
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("poa-OA", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [
               <?php
               $sql = array("LOB" => "OA");
               $selectedPatterns = $collection->find($sql);
               foreach ($selectedPatterns as $selectedPattern) {
               ?> {
                         from: "<?php echo $selectedPattern['Applications']; ?>",
                         to: "<?php echo $selectedPattern['TargetApplication']; ?>",
                         value: 1
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
          chart.fontSize = 12;

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

          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);
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

     <script>
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("poa-OT", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [
               <?php
               $sql = array("LOB" => "OT");
               $selectedPatterns = $collection->find($sql);
               foreach ($selectedPatterns as $selectedPattern) {
               ?> {
                         from: "<?php echo $selectedPattern['Applications']; ?>",
                         to: "<?php echo $selectedPattern['TargetApplication']; ?>",
                         value: 1
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
          chart.fontSize = 12;

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

          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);
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

     <script>
          // Themes begin
          am4core.useTheme(am4themes_animated);
          // Themes end

          var chart = am4core.create("poa-XLOB", am4charts.SankeyDiagram);
          chart.hiddenState.properties.opacity = 0; // this creates initial fade-in
          chart.logo.disabled = true;
          chart.data = [
               <?php
               $sql = array("LOB" => "XLoB");
               $selectedPatterns = $collection->find($sql);
               foreach ($selectedPatterns as $selectedPattern) {
               ?> {
                         from: "<?php echo $selectedPattern['Applications']; ?>",
                         to: "<?php echo $selectedPattern['TargetApplication']; ?>",
                         value: 1
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
          chart.fontSize = 12;

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

          // create animations
          chart.events.on("ready", function() {
               for (var i = 0; i < chart.links.length; i++) {
                    var link = chart.links.getIndex(i);
                    var bullet = link.bullets.getIndex(0);
                    animateBullet(bullet);
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