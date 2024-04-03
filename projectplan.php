<?php
		require '/var/www/html/vendor/autoload.php';
	$m = new MongoDB\Client("mongodb://localhost:27017");
		$db = $m->allianz;
		session_start();
		if(isset($_SESSION["Uid"]))
		{
			$username = $_SESSION["Uid"];
		}
            $filename = basename($_SERVER['PHP_SELF']); 
?>
<?php
	$m = new MongoDB\Client("mongodb://localhost:27017");
	$db = $m->allianz;
	$collection = $db->jobcard;	
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
             <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Decommission Plan</div>
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
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">Applications Decommission Plan</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart" id="chart_div">
                
              </div>
            </div>
          </div>
        </div>
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
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Application Name</th>
                    <th scope="col">Decommission Start Date</th>
                    <th scope="col">Decommission End Date</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
								$results = $collection->find();
								foreach ($results as $result)
								{
										$date1 = $result['startDate'];
										$date2 = $result['endDate'];
										echo "<tr><td>" . $result['appname'] . "</td><td>" . $date1 . "</td><td>" . $date2 . "</td></tr>";
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
	$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
        $(this).toggleClass('active');
    });
	});
	</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);
function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Cummulated Applications'],
          ['Q1 2022',  11],
          ['Q2 2022',  15],
          ['Q3 2022',  20],
		  ['Q4 2022',  36],
          ['Q1 2023',  42]
        ]);

        var options = {
          hAxis: {titleTextStyle: {color: '#333'}},
          vAxis: { minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>
</body>

</html>
