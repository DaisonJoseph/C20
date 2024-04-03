<?php
	// require '/var/www/html/vendor/autoload.php';
	session_start();
	
	// $m = new MongoDB\Client("mongodb://localhost:27017");
	$m = new MongoClient();
	$db = $m->allianz;
	$user = $db->user;
	session_start();
		//$collection = $db->user;
		//$result = $collection->find();
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
  <!-- Argon Scripts -->
  <!-- Core -->

  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
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
              <div class="card">
                <!-- Card body -->
                <div class="card-body" >
					<div id="chartdiv1"></div>
					<h5 class="h3 mb-0" style="font-family: Open Sans;font-size:14px;text-align:center;margin-left: -90px;">9 Applications were scoped out</h5>
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
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">HIGHLIGHTS</h5>
                </div>
              </div>
            </div>
            <div class="card-body" style="height:300px;">
              <ul class="custom-white">
				<li style="font-size:14px">Data Gathering Session Planning & Setting up meetings</li>
				<li style="font-size:14px">Data Gathering Sessions with Application SME</li>
				<li style="font-size:14px" >Application data coverage at 98%</li>			
				<li style="font-size:14px">Data Collated & Compiled in Baseline Inventory</li>
				<li style="font-size:14px" >Portability Index</li>
				<li style="font-size:14px" >Risk and Criticality Index</li>
				<li style="font-size:14px" >Point of Arrival Analysis</li>
				<li style="font-size:14px" >Dependency Analysis</li>
				<li style="font-size:14px" >Demise Pattern</li>
			  </ul>
              </div>
            </div>
          </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">ASSUMPTIONS</h5>
                </div>
              </div>
            </div>
			<div class="card-body" style="height:300px;">
				<ul class="custom-white">
					<li style="font-size:14px">The current decommissioning sequence is based on inputs received from interviews in June 2020. Any major change to applications post the given interview ,will impact the decommissioning roadmap & plan accordingly.</li>
					<li style="font-size:14px">Sequence and Demise pattern for Applications which do not have source code are on basis of Inputs provided during interviews & dependencies information only</li>
					<li style="font-size:14px">Decommissioning sequence for certain applications with action to lead as "Decommission" needs discussion with Allianz Italy as the dependent applications either have action to lead as "Integrate" or "Remains”</li>
					<li style="font-size:14px">Action to Lead changed for 12 Applications</li>
				</ul>
			</div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">OVERALL PROJECT STATUS</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart" id="chartdiv">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">APPLICATION INTERVIEW DATA GATHERING STATUS</h5>
                </div>
              </div>
            </div>
			<div class="card-body">
              <!-- Chart -->
              <div class="chart" id="piechart2">
				  
				  </div>
			  </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row">
                <div class="col">
                  <h5 class="h3 mb-0">APPLICATION CATEGORIZATION BASED ON  ACTION TO LEAD</h5>
                </div>
              </div>
            </div>
			<div class="card-body" >
              <!-- Chart -->
              <div class="chart" id="piechart3">
				  
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
  <script>
  

// Themes begin
am4core.useTheme(am4themes_animated);

// Themes end

// Create chart instance
var chart = am4core.create("chartdiv1", am4charts.XYChart);
chart.logo.disabled = true;
// Add data
chart.data = [{
  "year": "2020",
  "Completed": 123
  }];

chart.legend = new am4charts.Legend();
chart.legend.position = "right";

chart.colors.list = [
  am4core.color("#3F51B5"),
  am4core.color("teal"),
  am4core.color("#009b80"),
  am4core.color("#018e76"),
  //am4core.color("#FFC7"),
];

// Create axes
var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "year";
categoryAxis.renderer.grid.template.opacity = 0;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;
valueAxis.renderer.grid.template.opacity = 0;
valueAxis.renderer.ticks.template.strokeOpacity = 0.5;
valueAxis.renderer.ticks.template.stroke = am4core.color("#495C43");
valueAxis.renderer.ticks.template.length = 10;
valueAxis.renderer.line.strokeOpacity = 0.5;
valueAxis.renderer.baseGrid.disabled = true;
valueAxis.renderer.minGridDistance = 40;
valueAxis.title.text = "Number of Applications ready for Analysis";

// Create series
function createSeries(field, name) {
  var series = chart.series.push(new am4charts.ColumnSeries());
  series.dataFields.valueX = field;
  series.dataFields.categoryY = "year";
  series.stacked = true;
  series.name = name;
  
  var labelBullet = series.bullets.push(new am4charts.LabelBullet());
  labelBullet.locationX = 5;
  labelBullet.label.text = "{valueX}";
  labelBullet.label.fill = am4core.color("#fff");
}

createSeries("Completed", "Completed");

</script>
<script>
	 // Themes begin
	am4core.useTheme(am4themes_animated);
	// Themes end

	// Create chart instance
	var chart = am4core.create("chartdiv", am4charts.RadarChart);
	chart.width = am4core.percent(90);
	chart.height = am4core.percent(90);
	
	chart.logo.disabled = true;
    chart.data = [{
	  "category": "Percentage Completed",
	  "value": 100
	  //"full": 100
	}];
    
	chart.startAngle = -90;
	chart.endAngle = 180;
	chart.innerRadius = am4core.percent(70);
	
	// Set number format
	chart.numberFormatter.numberFormat = "#.#'%'";
	
	chart.colors.list = [
  am4core.color("#3F51B5")
 
];

	// Create axes
	var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis("fill", function(event){
  event.target.fill = chart.colors.getIndex(event.target.dataItem.index);
}));
	categoryAxis.dataFields.category = "category";
	
	categoryAxis.renderer.grid.template.location = 0;
	categoryAxis.renderer.grid.template.strokeOpacity = 0;
	categoryAxis.renderer.labels.template.horizontalCenter = "right";
	categoryAxis.renderer.labels.template.fontWeight = 500;
	/* categoryAxis.renderer.labels.template.adapter.add(); */
	categoryAxis.renderer.minGridDistance = 5;

	var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
	valueAxis.renderer.grid.template.strokeOpacity = 0;
	valueAxis.min = 0;
	valueAxis.max = 100;
	valueAxis.strictMinMax = true;
	
	// Create series
	 var series1 = chart.series.push(new am4charts.RadarColumnSeries());
	series1.dataFields.valueX = "full";
	series1.dataFields.categoryY = "category";
	series1.clustered = false;
	series1.columns.template.fill = new am4core.InterfaceColorSet().getFor("alternativeBackground");
	series1.columns.template.fillOpacity = 0.08;
	series1.columns.template.cornerRadiusTopLeft = 20;
	series1.columns.template.strokeWidth = 0;
	series1.columns.template.radarColumn.cornerRadius = 20; 
	
	var series2 = chart.series.push(new am4charts.RadarColumnSeries());
	series2.dataFields.valueX = "value";
	series2.dataFields.categoryY = "category";
	series2.clustered = false;
	series2.columns.template.strokeWidth = 0;
	series2.columns.template.tooltipText = "{category}: [bold]{value}[/]";
	series2.columns.template.radarColumn.cornerRadius = 20;

	/* series2.columns.template.adapter.add("fill", function(fill, target) {
	  return chart.colors.getIndex(target.dataItem.index);
	}); */
	// Add cursor
	
	chart.colors.getIndex(event.target.dataItem.index);

	chart.cursor = new am4charts.RadarCursor();
	
    </script>
	<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("piechart2", am4charts.PieChart);
chart.logo.disabled = true;
chart.width = am4core.percent(90);
chart.height = am4core.percent(90);
//chart.numberFormatter.numberFormat = "#.##";
// Add data
chart.data = [ {
  "country": "Data gathered from the Interviews",
  "litres": 100
}, /*{
  "country": "Data Pending",
  "litres": 0
},*/ 
];

// Add and configure Series

var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.labels.template.maxWidth = 90;
pieSeries.labels.template.wrap = true;
pieSeries.labels.template.fontSize = 11;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

chart.hiddenState.properties.radius = am4core.percent(0);


}); // end am4core.ready()
</script>
	 
<script src="core.js"></script>


<!-- Chart code -->
<script>
am4core.ready(function() {

// Themes begin

am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("piechart3", am4charts.PieChart);
chart.logo.disabled = true;
chart.width = am4core.percent(110);
chart.height = am4core.percent(100);
// Add data
chart.data = [ {
  "country": "Decommission",
  "litres": 62.87
},{
  "country": "Integrate",
  "litres": 13.63
}, {
  "country": "Remains",
  "litres": 16.66
}, {
  "country": "Out Of Scope",
  "litres": 5.30
}
];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.labels.template.maxWidth = 100;
pieSeries.labels.template.wrap = true;
pieSeries.labels.template.fontSize = 11;
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

chart.hiddenState.properties.radius = am4core.percent(0);


}); // end am4core.ready()
</script>
</body>

</html>
