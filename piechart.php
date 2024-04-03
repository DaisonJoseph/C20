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
			$m = new MongoClient("mongodb://localhost:27017");
			$db = $m->allianz;
			$collection3 = $db->masterinputORSA;
				$input1 = array("LOB"=>"ORSA");	
				$results = $collection->find($input1);
				$results->sort(array('portabilityindex' => -1));
				foreach ($results as $result){
					
						$score = $result['portabilityindex'];
						if ($score > 0 & $score < 0.651)
						{
							$color = ',"rgb(153, 7, 7)"],';
						}
						elseif ($score > 0.851 & $score < 1)
						{
							$color = ',"rgb(34, 170, 153)"],';
						}
						else
						{
							$color = ',"rgb(13, 142, 207)"],';
						}
						echo '{ 
								"Application": "' . $result['appname'] . '",
							    "Portability Index":' . $result['portabilityindex'] . ',
							    "technical":' . $result['cyclomaticscore'] .',							   
							    "maintainabilityindex":' . $result['maintainabilityindex'] .',
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
	  b.innerHTML = "Application " + ": <b>" + event.item.dataContext["Application"] + "</b><br>" 
					+ "Portability Index " + ": <b>" + event.item.dataContext["Portability Index"]+ "</b><br>" 
					+ "Technical Complexity " + ": <b>" + event.item.dataContext["technical"] + "</b><br>" 
					+ "Maintainability Index " + ": <b>" + event.item.dataContext["maintainabilityindex"]+ "</b><br>" 
					+ "Application Size " + ": <b>" + event.item.dataContext["appsizevalue"] + "</b><br>" 
					+ "Outbound Interfaces " + ": <b>" + event.item.dataContext["outbound"] + "</b><br>" 
					+ "Inbound Interfaces " + ": <b>" + event.item.dataContext["inbound"] + "</b><br>" 
					+ "Application Criticality " + ": <b>" + event.item.dataContext["appcriticality"] + "</b><br>" 
					+ "Language Complexity " + ": <b>" + event.item.dataContext["languagecomplexityscore"] + "</b><br>"
					+ "Stability " + ": <b>" + event.item.dataContext["Stability"] + "</b>";
	  //console.log('event.item.category= ', event.item);
	  //b.style.display = "block";
	  b.style.color = event.item.color;
	 });
		</script>