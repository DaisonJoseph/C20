<?php
		$m = new MongoClient();
		$db = $m->allianz;
		session_start();
		if(isset($_SESSION["Uid"]))
		{
			$username = $_SESSION["Uid"];
		}
            $filename = basename($_SERVER['PHP_SELF']); 
?>
<?php

   // session_start();
	$m = new MongoClient();
	$db = $m->allianz;
	$collection = $db->masterinput;	
//	$input = array("appdecomm" => "Yes");
	$results = $collection->find();
//	$user = $db->user; if (!isset($_SESSION['Uid'])) { header('Location:login.php'); } 
	$results->sort(array('maintainabilityindex' => -1));
	$appcount=0;
	$lowcount=0;
	$medcount=0;
	$highcount=0;
	// calculate percentile
	$i=0;
	$previousValue = -1;
	$previousPercentile = -1;
	foreach ($results as $result)
	{
		$appcount++;
	}
	$total = $appcount;
	foreach ($results as $result)
	{
		$value = $result['maintainabilityindex'];
		$name = $result['appname'];
		if ($previousValue == $value) {
			$percentile = $previousPercentile;
		} 
		else {
			$percentile = 99 - $i*100/$total;
			$previousPercentile = $percentile;
		}
		$previousValue = $value;
		$i++;
		$percentile = round($percentile,2);
		
//		if($name != "ISO Stat (# 4 Components )" and $name != "Lotus Notes (# 4 Components)" and $name != "First Link (# 2 Components )" and  $name != "SPI (# 3 Components )"){
			if ($percentile < 35.0)
			{
				$lowcount++;
			}
			elseif ($percentile > 70.0)
			{
				$highcount++;
			}
			else
			{
				$medcount++;
			}
		//}else{
		
		if ($name == "ISO Stat (# 4 Components )")
		{	if ($percentile < 35.0)
			{
				$lowcount = $lowcount + 3;
			}
			elseif ($percentile > 70.0)
			{
				$highcount = $highcount + 3;
			}
			else
			{
				$medcount = $medcount + 3;
			}
		}
		if ($name == "Lotus Notes (# 4 Components)")
		{
			if ($percentile < 35.0)
			{
				$lowcount = $lowcount + 3;
			}
			elseif ($percentile > 70.0)
			{
				$highcount = $highcount + 3;
			}
			else
			{
				$medcount = $medcount + 3;
			}
		}
		if ($name == "First Link (# 2 Components )")
		{
			if ($percentile < 35.0)
			{
				$lowcount++;
			}
			elseif ($percentile > 70.0)
			{
				$highcount++;
			}
			else
			{
				$medcount++;
			}
		}
		if ($name == "SPI (# 3 Components )")
		{
			if ($percentile < 35.0)
			{
				$lowcount = $lowcount + 2;
			}
			elseif ($percentile > 70.0)
			{
				$highcount = $highcount + 2;
			}
			else
			{
				$medcount = $medcount + 2;
			}
		}
		//}
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"  type="text/javascript" ></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
	#balloon {
  position: absolute;
  top: 500px;
  left: 800px;
  border: 2px solid #ccc;
  background: rgba(255, 255, 255, 0.8);
  padding: 6px;
  font-size: 10px;
  color: #000;
  margin: 20px 0 0 20px;
}
#balloon1 {
  position: absolute;
  top: 500px;
  left: 800px;
  border: 2px solid #ccc;
  background: rgba(255, 255, 255, 0.8);
  padding: 6px;
  font-size: 10px;
  color: #000;
  margin: 20px 0 0 20px;
}
#balloon2 {
  position: absolute;
  top: 500px;
  left: 800px;
  border: 2px solid #ccc;
  background: rgba(255, 255, 255, 0.8);
  padding: 6px;
  font-size: 10px;
  color: #000;
  margin: 20px 0 0 20px;
}
#balloon3 {
  position: absolute;
  top: 500px;
  left: 800px;
  border: 2px solid #ccc;
  background: rgba(255, 255, 255, 0.8);
  padding: 6px;
  font-size: 10px;
  color: #000;
  margin: 20px 0 0 20px;
}
#balloon4 {
  position: absolute;
  top: 500px;
  left: 800px;
  border: 2px solid #ccc;
  background: rgba(255, 255, 255, 0.8);
  padding: 6px;
  font-size: 10px;
  color: #000;
  margin: 20px 0 0 20px;
}
	</style>
</head>

<body>
  <!-- Sidenav -->
<nav class="navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <p><h3 style="font-size:20px;color: #00006E"><strong>Decommission Analyzer</strong></h3></p>
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
		  
            <li class="nav-item">
			<li <?php if($filename == "index.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="index.php">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Dashboard</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
			<li <?php if($filename == "projectplan.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="projectplan.php">
				<i class="material-icons text-orange">text_fields</i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Project Plan</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
             <li <?php if($filename == "portability-metrics.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="portability-metrics.php">
				<i class="material-icons text-primary">layers</i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Portability Metrics</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
              <li <?php if($filename == "risk-criticality.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="risk-criticality.php">
				<i class="material-icons text-yellow">trending_up</i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Risk and Criticality</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
              <li <?php if($filename == "technical-feasibility.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="technical-feasibility.php">
				 <i class="ni ni-ui-04 text-red"></i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Technical Feasibility</strong></span>
              </a>
            </li>
			
            <li class="nav-item">
              <li <?php if($filename == "maintainability-map.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="maintainability-map.php">
				<i class="material-icons text-info">perm_media</i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Maintainability Map</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
              <li <?php if($filename == "poa.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="poa.php">
				<i class="material-icons text-pink">swap_calls</i>
                <span class="nav-link-text"style="font-size:16px;color:#3F51B5;"><strong>POA Map</strong></span>
              </a>
			  </li>
            </li>
			
            <li class="nav-item">
              <li <?php if($filename == "jobcard.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="jobcard.php">
                <i class="material-icons text-green">assignment</i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Jobcard</strong></span>
              </a>
			  </li>
            </li>
			
			<li class="nav-item">
              <li <?php if($filename == "application.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="application.php">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Applications</strong></span>
              </a>
			  </li>
            </li>
			
			<li class="nav-item">
              <li <?php if($filename == "demisePattern.php"){ echo 'class="active"';} ?>>
              <a class="nav-link active" href="demisePattern.php">
                <i class="ni ni-sound-wave text-purple"></i>
                <span class="nav-link-text" style="font-size:16px;color:#3F51B5;"><strong>Demise Pattern</strong></span>
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
             <div class="card-body" style="font-size:22px;color:#edeffc;margin-left: -37px;">Maintainability Map By Applications</div>
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
              <div class="card" >
                <div class="card-body" >
					<div class="row">
					  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Applications</small>
						<h2><?php echo $appcount ?></h2>
						<div id="sparklinedash"></div>
					  </div>
					  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>High Maintainable Applications</small>
						<h2><?php echo $highcount ?></h2>
						<div id="sparklinedash2"></div>
					  </div>
					  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Medium Maintainable Applications</small>
						<h2><?php echo $medcount ?></h2>
						<div id="sparklinedash3"></div>
					  </div>
					  <div class="col-lg-3 col-sm-3 col-xs-12 text-center"> <small>Low Maintainable Applications</small>
						<h2><?php echo $lowcount ?></h2>
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
                  <h5 class="h3">Applications With Maintainability</h5>
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
										<div class="panel">
											<!--<div class="panel-heading">
												<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
												LOB:ORSA</a>
												</h4>
											</div>-->
											<div id="collapse1" class="collapse" data-parent="#accordion">
												<h4 style="color:#3F51B5;margin-left:30px;">ORSA</h4>
												<p><div  id="top_x_div" style="height:690px;width:1060px;"></div></p>
												<div id="balloon"></div>
											</div>
										</div>
										<div class="panel">
											<!--<div class="panel-heading">
												<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
												OO</a>
												</h4>
											</div>-->
											<div id="collapse2" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OO</h4>
												<p><div  id="top_x_div1" style="height:690px;width:1060px;"></div></p>
												<div id="balloon1"></div>
											</div>
										</div>
										<div class="panel">
											<!--<div class="panel-heading">
												<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
												OA</a>
												</h4>
											</div>-->
											<div id="collapse3" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OA</h4>
												<p><div  id="top_x_div2" style="height:690px;width:1060px;"></div></p>
												<div id="balloon2"></div>
												</div>
											
										</div>
										<div class="panel">
											<!--<div class="panel-heading">
												<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
												OT</a>
												</h4>
											</div>-->
											<div id="collapse4" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">OT</h4>
												<p><div  id="top_x_div3" style="height:690px;width:1060px;"></div></p>
												<div id="balloon3"></div>
												</div>
											
										</div>
										<div class="panel">
											<!--<div class="panel-heading">
											<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#accordion" href="#collapse5">
											OA</a>
											</h4>
											</div>-->
											<div id="collapse5" class="collapse" data-parent="#accordion">
											<h4 style="color:#3F51B5;margin-left:30px;">XLOB</h4>
												<p><div  id="top_x_div4" style="height:690px;width:1060px;"></div></p>
												<div id="balloon4"></div>
											</div>
										</div>
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
                  <h3 class="mb-0">Maintainability Table</h3>
				  <a href="download.php?input=maintain" class="blue-cascade pull-right" style="display:inline"> Download CSV
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
                    <th scope="col">Maintainability Percentile Score</th>
                  </tr>
                </thead>
                <tbody>
              <?php
								$i=0;
								//$total = $appcount;
								$previousValue = -1;
								$previousPercentile = -1;
								foreach ($results as $result)
								{
		
										$value = $result['maintainabilityindex'];
										if ($previousValue == $value) {
										$percentile = $previousPercentile;
										} else {
										$percentile = 99 - $i*100/$total;
										$previousPercentile = $percentile;
										}
										$previousValue = $value;
										$i++;
										$percentile = round($percentile,2);
										echo "<tr><td>" . $result['appname'] . "</td><td>" . $percentile . "</td></tr>";
								
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

		var chart = AmCharts.makeChart("top_x_div", {
		  "type": "serial",
		  "theme": "light",
		  "colorRanges": [{
			"start": 0,
			"end": 35,
			"color": "#990707",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 35.01,
			"end": 70,
			"color": "#0d8ecf",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 70.01,
			"end": 100,
			"color": "#22aa99",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color",
			"balloon": {
			    "adjustBorderColor": true,
			    "color": "#000000",
			    "cornerRadius": 5,
			    "fillColor": "#FFFFFF",
			    "fillAlpha": 20
			  }
		  }],
		  "dataProvider": [		
			<?php			
				$i=0;
				//$total = $appcount;
				$previousValue = -1;
				$previousPercentile = -1;
				$input1 = array("LOB"=>"ORSA");	
				$results = $collection->find($input1);
				$results->sort(array('maintainabilityindex' => -1));
				$appcount=0;
				foreach ($results as $result)
				{
					$appcount++;
				}
				$total = $appcount;
				foreach ($results as $result)
				{
						$appdocumentation = $result["appdocumentation"];
						$appdocumentationvalue = 1;		
						if ($appdocumentation == "Well Documented") 
						{
							$appdocumentationvalue = 4;		
						}
						elseif ($appdocumentation == "Outdated Documentation") 
						{
							$appdocumentationvalue = 3;
						}
						elseif ($appdocumentation == "Minimal Documentation") 
						{
							$appdocumentationvalue = 2;		
						}
						elseif ($appdocumentation == "No Documentation") 
						{
							$appdocumentationvalue = 1;		
						}
						$apploc = $result["apploc"];
										$appsize = $apploc;
						$appsizevalue = 3;
						if ($appsize == "1") 
						{
							$appsizevalue = 5;
						}
						elseif ($appsize == "2") 
						{
							$appsizevalue = 4;
						}
						elseif ($appsize == "3") 
						{
							$appsizevalue = 3;
						}
						elseif ($appsize == "4") 
						{
							$appsizevalue = 2;
						}
						elseif ($appsize == "5") 
						{
							$appsizevalue = 1;
						}
						elseif ($appsize == "Not Known") 
						{
							$appsizevalue = 3;
						}
						else
						{
							$appsizevalue = 3;
						}	
						
						
						
						$value = $result['maintainabilityindex'];
						$name = $result['appname'];
						if ($previousValue == $value) {
							$percentile = $previousPercentile;
						} 
						else {
							$percentile = 99 - $i*100/$total;
							$previousPercentile = $percentile;
						}
						$previousValue = $value;
						$i++;
						$percentile = round($percentile,2);

						if ($percentile < 35)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($percentile > 70)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{"Application": "' . $result['appname'] . '", 
									 "Maintainability Percentile Score":' . $percentile . ',
									 
									 "appcomplexitylevel":' . $result['appcomplexitylevel'] . ',
									 
									 "cyclomaticcomplexity":' . $result['cyclomaticscore'] . ',
									 
									 "appsizevalue":' . $appsizevalue . ',
									 
									 "appdocumentationvalue":' . $appdocumentationvalue .
									 
								 '},';
						
					}
			?>
		  ],
		  "valueAxes": [{
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0,
			"title": "Maintainability Percentile Score",
			"position": "top"
		  }],
		  "gridAboveGraphs": true,
		  "startDuration": 1,
		  "graphs": [{
			//"balloonText": "[[category]]:<br>Application Complexity Level:[[appcomplexitylevel]]<br>Cyclomatic Complexity:[[cyclomaticcomplexity]]<br>Application Size Value:[[appsizevalue]]<br>Application Documentation:[[appdocumentationvalue]]",
			"labelText": "[[Maintainability Percentile Score]]",
			"fillAlphas": 1,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "Maintainability Percentile Score",
			"colorField": "color"
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
//			"tickPosition": "start",
//			"tickLength": 2,
			"title": "Applications",
			"fontSize": 8
		  },
		  "export": {
			"enabled": true,
			"fileName": "maintainability_map"
		  }

		});
		chart.addListener("rollOverGraphItem", function(event) {
	  var b = document.getElementById("balloon");
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Maintainability Percentile Score" + ": <b>" + event.item.dataContext["Maintainability Percentile Score"]+ "</b><br>" 
					+ "Technical Complexity" + ": <b>" + event.item.dataContext["cyclomaticcomplexity"]+ "</b><br>" 
					+ "Application Complexity Level" + ": <b>" + event.item.dataContext["appcomplexitylevel"] + "</b><br>" 
					+ "Application Size Value" + ": <b>" + event.item.dataContext["appsizevalue"]+ "</b><br>"
					+ "Application Documentation" + ": <b>" + event.item.dataContext["appdocumentationvalue"]+ "</b>";
		b.style.color = event.item.color;
	 });
	 
	 var chart = AmCharts.makeChart("top_x_div1", {
		  "type": "serial",
		  "theme": "light",
		  "colorRanges": [{
			"start": 0,
			"end": 35,
			"color": "#990707",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 35.01,
			"end": 70,
			"color": "#0d8ecf",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 70.01,
			"end": 100,
			"color": "#22aa99",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color",
			"balloon1": {
			    "adjustBorderColor": true,
			    "color": "#000000",
			    "cornerRadius": 5,
			    "fillColor": "#FFFFFF",
			    "fillAlpha": 20
			  }
		  }],
		  "dataProvider": [		
			<?php			
				$i=0;
				//$total = $appcount;
				$previousValue = -1;
				$previousPercentile = -1;
				//$results = $collection->find();
				$input1 = array("LOB"=>"OO");	
				$results = $collection->find($input1);
				$results->sort(array('maintainabilityindex' => -1));
				$appcount=0;
				foreach ($results as $result)
				{
					$appcount++;
				}
				$total = $appcount;
				foreach ($results as $result)
				{
						$appdocumentation = $result["appdocumentation"];
						$appdocumentationvalue = 1;		
						if ($appdocumentation == "Well Documented") 
						{
							$appdocumentationvalue = 4;		
						}
						elseif ($appdocumentation == "Outdated Documentation") 
						{
							$appdocumentationvalue = 3;
						}
						elseif ($appdocumentation == "Minimal Documentation") 
						{
							$appdocumentationvalue = 2;		
						}
						elseif ($appdocumentation == "No Documentation") 
						{
							$appdocumentationvalue = 1;		
						}
						$apploc = $result["apploc"];
										$appsize = $apploc;
						$appsizevalue = 3;
						if ($appsize == "1") 
						{
							$appsizevalue = 5;
						}
						elseif ($appsize == "2") 
						{
							$appsizevalue = 4;
						}
						elseif ($appsize == "3") 
						{
							$appsizevalue = 3;
						}
						elseif ($appsize == "4") 
						{
							$appsizevalue = 2;
						}
						elseif ($appsize == "5") 
						{
							$appsizevalue = 1;
						}
						elseif ($appsize == "Not Known") 
						{
							$appsizevalue = 3;
						}
						else
						{
							$appsizevalue = 3;
						}	
						
						
						
						$value = $result['maintainabilityindex'];
						$name = $result['appname'];
						if ($previousValue == $value) {
							$percentile = $previousPercentile;
						} 
						else {
							$percentile = 99 - $i*100/$total;
							$previousPercentile = $percentile;
						}
						$previousValue = $value;
						$i++;
						$percentile = round($percentile,2);

						if ($percentile < 35)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($percentile > 70)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{"Application": "' . $result['appname'] . '", 
									 "Maintainability Percentile Score":' . $percentile . ',
									 
									 "appcomplexitylevel":' . $result['appcomplexitylevel'] . ',
									 
									 "cyclomaticcomplexity":' . $result['cyclomaticscore'] . ',
									 
									 "appsizevalue":' . $appsizevalue . ',
									 
									 "appdocumentationvalue":' . $appdocumentationvalue .
									 
								 '},';
						
					}
			?>
		  ],
		  "valueAxes": [{
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0,
			"title": "Maintainability Percentile Score",
			"position": "top"
		  }],
		  "gridAboveGraphs": true,
		  "startDuration": 1,
		  "graphs": [{
			//"balloonText": "[[category]]:<br>Application Complexity Level:[[appcomplexitylevel]]<br>Cyclomatic Complexity:[[cyclomaticcomplexity]]<br>Application Size Value:[[appsizevalue]]<br>Application Documentation:[[appdocumentationvalue]]",
			"labelText": "[[Maintainability Percentile Score]]",
			"fillAlphas": 1,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "Maintainability Percentile Score",
			"colorField": "color"
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
//			"tickPosition": "start",
//			"tickLength": 2,
			"title": "Applications",
			"fontSize": 8
		  },
		  "export": {
			"enabled": true,
			"fileName": "maintainability_map"
		  }

		});
		chart.addListener("rollOverGraphItem", function(event) {
	  var b = document.getElementById("balloon1");
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Maintainability Percentile Score" + ": <b>" + event.item.dataContext["Maintainability Percentile Score"]+ "</b><br>" 
					+ "Technical Complexity" + ": <b>" + event.item.dataContext["cyclomaticcomplexity"]+ "</b><br>" 
					+ "Application Complexity Level" + ": <b>" + event.item.dataContext["appcomplexitylevel"] + "</b><br>" 
					+ "Application Size Value" + ": <b>" + event.item.dataContext["appsizevalue"]+ "</b><br>"
					+ "Application Documentation" + ": <b>" + event.item.dataContext["appdocumentationvalue"]+ "</b>";
		b.style.color = event.item.color;
	 });
	 
	 
	 var chart = AmCharts.makeChart("top_x_div2", {
		  "type": "serial",
		  "theme": "light",
		  "colorRanges": [{
			"start": 0,
			"end": 35,
			"color": "#990707",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 35.01,
			"end": 70,
			"color": "#0d8ecf",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 70.01,
			"end": 100,
			"color": "#22aa99",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color",
			"balloon2": {
			    "adjustBorderColor": true,
			    "color": "#000000",
			    "cornerRadius": 5,
			    "fillColor": "#FFFFFF",
			    "fillAlpha": 20
			  }
		  }],
		  "dataProvider": [		
			<?php			
				$i=0;
				//$total = $appcount;
				$previousValue = -1;
				$previousPercentile = -1;
				$input1 = array("LOB"=>"OA");	
				$results = $collection->find($input1);
				$results->sort(array('maintainabilityindex' => -1));
				$appcount=0;
				foreach ($results as $result)
				{
					$appcount++;
				}
				$total = $appcount;
				foreach ($results as $result)
				{
						$appdocumentation = $result["appdocumentation"];
						$appdocumentationvalue = 1;		
						if ($appdocumentation == "Well Documented") 
						{
							$appdocumentationvalue = 4;		
						}
						elseif ($appdocumentation == "Outdated Documentation") 
						{
							$appdocumentationvalue = 3;
						}
						elseif ($appdocumentation == "Minimal Documentation") 
						{
							$appdocumentationvalue = 2;		
						}
						elseif ($appdocumentation == "No Documentation") 
						{
							$appdocumentationvalue = 1;		
						}
						$apploc = $result["apploc"];
										$appsize = $apploc;
						$appsizevalue = 3;
						if ($appsize == "1") 
						{
							$appsizevalue = 5;
						}
						elseif ($appsize == "2") 
						{
							$appsizevalue = 4;
						}
						elseif ($appsize == "3") 
						{
							$appsizevalue = 3;
						}
						elseif ($appsize == "4") 
						{
							$appsizevalue = 2;
						}
						elseif ($appsize == "5") 
						{
							$appsizevalue = 1;
						}
						elseif ($appsize == "Not Known") 
						{
							$appsizevalue = 3;
						}
						else
						{
							$appsizevalue = 3;
						}	
						
						
						
						$value = $result['maintainabilityindex'];
						$name = $result['appname'];
						if ($previousValue == $value) {
							$percentile = $previousPercentile;
						} 
						else {
							$percentile = 99 - $i*100/$total;
							$previousPercentile = $percentile;
						}
						$previousValue = $value;
						$i++;
						$percentile = round($percentile,2);

						if ($percentile < 35)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($percentile > 70)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{"Application": "' . $result['appname'] . '", 
									 "Maintainability Percentile Score":' . $percentile . ',
									 
									 "appcomplexitylevel":' . $result['appcomplexitylevel'] . ',
									 
									 "cyclomaticcomplexity":' . $result['cyclomaticscore'] . ',
									 
									 "appsizevalue":' . $appsizevalue . ',
									 
									 "appdocumentationvalue":' . $appdocumentationvalue .
									 
								 '},';
						
					}
			?>
		  ],
		  "valueAxes": [{
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0,
			"title": "Maintainability Percentile Score",
			"position": "top"
		  }],
		  "gridAboveGraphs": true,
		  "startDuration": 1,
		  "graphs": [{
			//"balloonText": "[[category]]:<br>Application Complexity Level:[[appcomplexitylevel]]<br>Cyclomatic Complexity:[[cyclomaticcomplexity]]<br>Application Size Value:[[appsizevalue]]<br>Application Documentation:[[appdocumentationvalue]]",
			"labelText": "[[Maintainability Percentile Score]]",
			"fillAlphas": 1,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "Maintainability Percentile Score",
			"colorField": "color"
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
//			"tickPosition": "start",
//			"tickLength": 2,
			"title": "Applications",
			"fontSize": 8
		  },
		  "export": {
			"enabled": true,
			"fileName": "maintainability_map"
		  }

		});
		chart.addListener("rollOverGraphItem", function(event) {
	  var b = document.getElementById("balloon2");
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Maintainability Percentile Score" + ": <b>" + event.item.dataContext["Maintainability Percentile Score"]+ "</b><br>" 
					+ "Technical Complexity" + ": <b>" + event.item.dataContext["cyclomaticcomplexity"]+ "</b><br>" 
					+ "Application Complexity Level" + ": <b>" + event.item.dataContext["appcomplexitylevel"] + "</b><br>" 
					+ "Application Size Value" + ": <b>" + event.item.dataContext["appsizevalue"]+ "</b><br>"
					+ "Application Documentation" + ": <b>" + event.item.dataContext["appdocumentationvalue"]+ "</b>";
		b.style.color = event.item.color;
	 });
	 
	 
	 var chart = AmCharts.makeChart("top_x_div3", {
		  "type": "serial",
		  "theme": "light",
		  "colorRanges": [{
			"start": 0,
			"end": 35,
			"color": "#990707",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 35.01,
			"end": 70,
			"color": "#0d8ecf",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 70.01,
			"end": 100,
			"color": "#22aa99",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color",
			"balloon3": {
			    "adjustBorderColor": true,
			    "color": "#000000",
			    "cornerRadius": 5,
			    "fillColor": "#FFFFFF",
			    "fillAlpha": 20
			  }
		  }],
		  "dataProvider": [		
			<?php			
				$i=0;
				//$total = $appcount;
				$previousValue = -1;
				$previousPercentile = -1;
				$input1 = array("LOB"=>"OT");	
				$results = $collection->find($input1);
				$results->sort(array('maintainabilityindex' => -1));
				$appcount=0;
				foreach ($results as $result)
				{
					$appcount++;
				}
				$total = $appcount;
				foreach ($results as $result)
				{
						$appdocumentation = $result["appdocumentation"];
						$appdocumentationvalue = 1;		
						if ($appdocumentation == "Well Documented") 
						{
							$appdocumentationvalue = 4;		
						}
						elseif ($appdocumentation == "Outdated Documentation") 
						{
							$appdocumentationvalue = 3;
						}
						elseif ($appdocumentation == "Minimal Documentation") 
						{
							$appdocumentationvalue = 2;		
						}
						elseif ($appdocumentation == "No Documentation") 
						{
							$appdocumentationvalue = 1;		
						}
						$apploc = $result["apploc"];
										$appsize = $apploc;
						$appsizevalue = 3;
						if ($appsize == "1") 
						{
							$appsizevalue = 5;
						}
						elseif ($appsize == "2") 
						{
							$appsizevalue = 4;
						}
						elseif ($appsize == "3") 
						{
							$appsizevalue = 3;
						}
						elseif ($appsize == "4") 
						{
							$appsizevalue = 2;
						}
						elseif ($appsize == "5") 
						{
							$appsizevalue = 1;
						}
						elseif ($appsize == "Not Known") 
						{
							$appsizevalue = 3;
						}
						else
						{
							$appsizevalue = 3;
						}	
						
						
						
						$value = $result['maintainabilityindex'];
						$name = $result['appname'];
						if ($previousValue == $value) {
							$percentile = $previousPercentile;
						} 
						else {
							$percentile = 99 - $i*100/$total;
							$previousPercentile = $percentile;
						}
						$previousValue = $value;
						$i++;
						$percentile = round($percentile,2);

						if ($percentile < 35)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($percentile > 70)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{"Application": "' . $result['appname'] . '", 
									 "Maintainability Percentile Score":' . $percentile . ',
									 
									 "appcomplexitylevel":' . $result['appcomplexitylevel'] . ',
									 
									 "cyclomaticcomplexity":' . $result['cyclomaticscore'] . ',
									 
									 "appsizevalue":' . $appsizevalue . ',
									 
									 "appdocumentationvalue":' . $appdocumentationvalue .
									 
								 '},';
						
					}
			?>
		  ],
		  "valueAxes": [{
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0,
			"title": "Maintainability Percentile Score",
			"position": "top"
		  }],
		  "gridAboveGraphs": true,
		  "startDuration": 1,
		  "graphs": [{
			//"balloonText": "[[category]]:<br>Application Complexity Level:[[appcomplexitylevel]]<br>Cyclomatic Complexity:[[cyclomaticcomplexity]]<br>Application Size Value:[[appsizevalue]]<br>Application Documentation:[[appdocumentationvalue]]",
			"labelText": "[[Maintainability Percentile Score]]",
			"fillAlphas": 1,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "Maintainability Percentile Score",
			"colorField": "color"
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
//			"tickPosition": "start",
//			"tickLength": 2,
			"title": "Applications",
			"fontSize": 8
		  },
		  "export": {
			"enabled": true,
			"fileName": "maintainability_map"
		  }

		});
		chart.addListener("rollOverGraphItem", function(event) {
	  var b = document.getElementById("balloon3");
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Maintainability Percentile Score" + ": <b>" + event.item.dataContext["Maintainability Percentile Score"]+ "</b><br>" 
					+ "Technical Complexity" + ": <b>" + event.item.dataContext["cyclomaticcomplexity"]+ "</b><br>" 
					+ "Application Complexity Level" + ": <b>" + event.item.dataContext["appcomplexitylevel"] + "</b><br>" 
					+ "Application Size Value" + ": <b>" + event.item.dataContext["appsizevalue"]+ "</b><br>"
					+ "Application Documentation" + ": <b>" + event.item.dataContext["appdocumentationvalue"]+ "</b>";
		b.style.color = event.item.color;
	 });
	 
	 var chart = AmCharts.makeChart("top_x_div4", {
		  "type": "serial",
		  "theme": "light",
		  "colorRanges": [{
			"start": 0,
			"end": 35,
			"color": "#990707",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 35.01,
			"end": 70,
			"color": "#0d8ecf",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color"
		  }, {
			"start": 70.01,
			"end": 100,
			"color": "#22aa99",
			"variation": 0,
			"valueProperty": "Maintainability Percentile Score",
			"colorProperty": "color",
			"balloon4": {
			    "adjustBorderColor": true,
			    "color": "#000000",
			    "cornerRadius": 5,
			    "fillColor": "#FFFFFF",
			    "fillAlpha": 20
			  }
		  }],
		  "dataProvider": [		
			<?php			
				$i=0;
				//$total = $appcount;
				$previousValue = -1;
				$previousPercentile = -1;
				$input1 = array("LOB"=>"XLoB");	
				$results = $collection->find($input1);
				$results->sort(array('maintainabilityindex' => -1));
				$appcount=0;
				foreach ($results as $result)
				{
					$appcount++;
				}
				$total = $appcount;
				foreach ($results as $result)
				{
						$appdocumentation = $result["appdocumentation"];
						$appdocumentationvalue = 1;		
						if ($appdocumentation == "Well Documented") 
						{
							$appdocumentationvalue = 4;		
						}
						elseif ($appdocumentation == "Outdated Documentation") 
						{
							$appdocumentationvalue = 3;
						}
						elseif ($appdocumentation == "Minimal Documentation") 
						{
							$appdocumentationvalue = 2;		
						}
						elseif ($appdocumentation == "No Documentation") 
						{
							$appdocumentationvalue = 1;		
						}
						$apploc = $result["apploc"];
										$appsize = $apploc;
						$appsizevalue = 3;
						if ($appsize == "1") 
						{
							$appsizevalue = 5;
						}
						elseif ($appsize == "2") 
						{
							$appsizevalue = 4;
						}
						elseif ($appsize == "3") 
						{
							$appsizevalue = 3;
						}
						elseif ($appsize == "4") 
						{
							$appsizevalue = 2;
						}
						elseif ($appsize == "5") 
						{
							$appsizevalue = 1;
						}
						elseif ($appsize == "Not Known") 
						{
							$appsizevalue = 3;
						}
						else
						{
							$appsizevalue = 3;
						}	
						
						
						
						$value = $result['maintainabilityindex'];
						$name = $result['appname'];
						if ($previousValue == $value) {
							$percentile = $previousPercentile;
						} 
						else {
							$percentile = 99 - $i*100/$total;
							$previousPercentile = $percentile;
						}
						$previousValue = $value;
						$i++;
						$percentile = round($percentile,2);

						if ($percentile < 35)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($percentile > 70)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{"Application": "' . $result['appname'] . '", 
									 "Maintainability Percentile Score":' . $percentile . ',
									 
									 "appcomplexitylevel":' . $result['appcomplexitylevel'] . ',
									 
									 "cyclomaticcomplexity":' . $result['cyclomaticscore'] . ',
									 
									 "appsizevalue":' . $appsizevalue . ',
									 
									 "appdocumentationvalue":' . $appdocumentationvalue .
									 
								 '},';
						
					}
			?>
		  ],
		  "valueAxes": [{
			"gridColor": "#FFFFFF",
			"gridAlpha": 0.2,
			"dashLength": 0,
			"title": "Maintainability Percentile Score",
			"position": "top"
		  }],
		  "gridAboveGraphs": true,
		  "startDuration": 1,
		  "graphs": [{
			//"balloonText": "[[category]]:<br>Application Complexity Level:[[appcomplexitylevel]]<br>Cyclomatic Complexity:[[cyclomaticcomplexity]]<br>Application Size Value:[[appsizevalue]]<br>Application Documentation:[[appdocumentationvalue]]",
			"labelText": "[[Maintainability Percentile Score]]",
			"fillAlphas": 1,
			"lineAlpha": 0.2,
			"type": "column",
			"valueField": "Maintainability Percentile Score",
			"colorField": "color"
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
//			"tickPosition": "start",
//			"tickLength": 2,
			"title": "Applications",
			"fontSize": 8
		  },
		  "export": {
			"enabled": true,
			"fileName": "maintainability_map"
		  }

		});
		chart.addListener("rollOverGraphItem", function(event) {
	  var b = document.getElementById("balloon4");
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Maintainability Percentile Score" + ": <b>" + event.item.dataContext["Maintainability Percentile Score"]+ "</b><br>" 
					+ "Technical Complexity" + ": <b>" + event.item.dataContext["cyclomaticcomplexity"]+ "</b><br>" 
					+ "Application Complexity Level" + ": <b>" + event.item.dataContext["appcomplexitylevel"] + "</b><br>" 
					+ "Application Size Value" + ": <b>" + event.item.dataContext["appsizevalue"]+ "</b><br>"
					+ "Application Documentation" + ": <b>" + event.item.dataContext["appdocumentationvalue"]+ "</b>";
		b.style.color = event.item.color;
	 });
</script>
</body>
</html>
