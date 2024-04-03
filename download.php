<?php
	header("Content-type: text/plain");
	
	if(isset($_GET['input']))
	{
		$input = $_GET['input'];
	}	
	
	if ($input == "5r")
	{
		$out = "Application Name,5R Category" ;
		echo $out . "\r\n";
	}
	elseif ($input == "dataarch")
	{
		$out = "Application Name,Data Archival Strategy" ;
		echo $out . "\r\n";
	}
	elseif ($input == "apparch")
	{
		$out = "Application Name,Application Archival Strategy" ;
		echo $out . "\r\n";
	}
	elseif ($input == "risk")
	{
		$out = "Application Name,Risk & Criticality Index" ;
		echo $out . "\r\n";
	}
	elseif ($input == "complexity")
	{
		$out = "Application Name,Technical Complexity Index" ;
		echo $out . "\r\n";
	}
	elseif ($input == "feasibility")
	{
		$out = "Application Name,Technical Feasibility Index" ;
		echo $out . "\r\n";
	}
	elseif ($input == "maintain")
	{
		$out = "Application Name,Maintainability Percentile Score" ;
		echo $out . "\r\n";
	}
	elseif ($input == "outbound")
	{
		$out = "Application Name,SFTP,Database Call,MQ,Web Services,Gateway payment,Google Analytics,Chat Bot,API,Email,Faxination,SMTP,Fax,SMS,Windows Service,Total Count" ;
		echo $out . "\r\n";
	}
	elseif ($input == "inbound")
	{
		$out = "Application Name,SFTP,Database Call,MQ,Web Services,Email,Postal Letter,Google Analytics,Payment Gateway,API,Windows Service,Applications,Total Count" ;
		echo $out . "\r\n";
	}	
	elseif ($input == "appinv")
	{
		$out = "Application Name,Type of Application,Application Category,LOB,Application Owner,Action to Lead,Application Age,Minimum Expected Life,Handles Legal Compliance,Single/Group Of Applications,Interfaces with Application that  handle Regulatory  Compliance,Source Code Archival,Incoming Dependencies,Outgoing Dependencies,Business Criticality,Revenue Impact ,Application Size based on  Lines of code,Application Complexity based  on Process Involved,Current Database Size,Number of Reports generated,Frequency of Reports,Count of Server the Application   Hosted on,Other  Applications using the same server,Any Third party Tools  used,Count of Resources Supporting & Maintaining the Application,Application saves Historical Data,Support Level  to Maintain the Application,Level of documentation available,Ongoing Enhancements,Teams Knowledge on the Application,Technologies used,Number of Users" ;
		echo $out . "\r\n";
	}	
	elseif ($input == "plan")
	{
		$out = "Application Name,Decomm Start,Decomm End" ;
		echo $out . "\r\n";
	}
	elseif ($input == "dependency")
	{
		$out = "From ficohid,From Application,Means,To ficohid,To Application" ;
		echo $out . "\r\n";
	}
	elseif ($input == "poa")
	{
		$out = "Applications,Target Applications" ;
		echo $out . "\r\n";
	}

	
	// require '/var/www/html/vendor/autoload.php';
	// $m = new MongoDB\Client("mongodb://localhost:27017");
     $m = new MongoClient();
	$db = $m->allianz;
	$collection = $db->masterinput;
	$collection1 = $db->Application;
	$collection2 = $db->poa1;
	$collection3 = $db->dependency;
	$collection4 = $db->jobcard;
	$results = $collection->find();
	$results1 = $collection1->find();
	$results2 = $collection2->find();
	$results3 = $collection3->find();
	$results4 = $collection4->find();
//	$results->sort(array('4rcategory' => 1));	

	
	
	if ($input == "5r")
	{
		foreach ($results as $result){
			$out = $result['appname'] . "," . $result['4rcategory'];
			echo $out . "\r\n";
		}
	}
	elseif ($input == "dataarch")
	{
		foreach ($results as $result){
			if($result['appdecomm'] == "Yes"){
				$out = $result['appname'] . "," . $result['dataarch'];
				echo $out . "\r\n";
			}
		}
	}	
	elseif ($input == "appinv")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_Application.csv");
		foreach ($results1 as $result1){
			$out = '"'.($result1['Application Name']).'"'. "," . '"'.($result1['Type of Application']).'"'. "," . '"'.($result1['Application Category']).'"'. "," . '"'.($result1['LOB']).'"'. "," . '"'.($result1['Application Owner']).'"'. "," . '"'.($result1['Action to Lead']).'"'. "," . '"'.($result1['Application Age']).'"'. "," . '"'.($result1['Minimum Expected Life']).'"'. "," . '"'.($result1['Handles Legal Compliance']).'"'. "," . '"'.($result1['Single/Group Of Applications']).'"'. "," . '"'.($result1['Interfaces with Application that  handle Regulatory  Compliance']).'"'. "," . '"'.($result1['Source Code Archival']).'"'. "," . '"'.($result1['Incoming Dependencies']).'"'. "," . '"'.($result1['Outgoing Dependencies']).'"'. "," . '"'.($result1['Business Criticality']).'"'. "," . '"'.($result1['Revenue Impact']).'"'. "," . '"'.($result1['Application Size based on  Lines of code']).'"'. "," . '"'.($result1['Application Complexity based  on Process Involved']).'"'. "," . '"'.($result1['Current Database Size']).'"'. "," . '"'.($result1['Number of Reports generated']).'"'. "," . '"'.($result1['Frequency of Reports']).'"'. "," . '"'.($result1['Count of Server the Application   Hosted on']).'"'. "," . '"'.($result1['Other  Applications using the same server']).'"'. "," . '"'.($result1['Any Third party Tools  used']).'"'. "," . '"'.($result1['Count of Resources Supporting & Maintaining the Application']).'"'. "," . '"'.($result1['Application saves Historical Data']).'"'. "," . '"'.($result1['Support Level  to Maintain the Application']).'"'. "," . '"'.($result1['Level of documentation available']).'"'. "," . '"'.($result1['Ongoing Enhancements']).'"'. "," . '"'.($result1['Teams Knowledge on the Application']).'"'. "," . '"'.($result1['Technologies used']).'"'. "," .'"'.($result1['Number of Users']). '"';
			echo $out . "\r\n";
		}
	}
	elseif ($input == "apparch")
	{
		
		foreach ($results as $result){
			if($result['appdecomm'] == "Yes"){
				$out = $result['appname'] . "," . $result['apparch'];
				echo $out . "\r\n";
			}
		}
	}
	elseif ($input == "risk")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_risk-criticality.csv");
		// $filter = [];
		// $options = ['sort' => ['appname' => 1]];
		// $results = $collection->find($filter,$options);
          $results = $collection->find()->sort(array("appname" => 1));
		foreach ($results as $result){
				$out = $result['appname'] . "," . $result['riskcriticalityscore'];
				echo $out . "\r\n";
		}
	}
	elseif ($input == "feasibility")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_technical-feasibility.csv");
		foreach ($results as $result){
				$out = $result['appname'] . "," . (1-$result['languagecomplexityscore']);
				echo $out . "\r\n";
		}
	}
	elseif ($input == "poa")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_poa.csv");
		foreach ($results2 as $result2){
				$out =  $result2['Applications'] . "," . $result2['TargetApplication'];
				echo $out . "\r\n";
		}
	}
	elseif ($input == "dependency")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_dependency_master.csv");
		foreach ($results3 as $result3){
				$out = $result3['From_FICOH_id'] . "," . $result3['From_Application']."," . $result3['Means'] . "," . $result3['To_FICOH_id'].",". $result3['To_Application'];
				echo $out . "\r\n";
		}
	}
	elseif ($input == "maintain")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_maintainability.csv");
		$results = $collection->find()->sort(array('maintainabilityindex' => -1));
		// $results->;

		$i=0;
		$total = 0;
		$appcount = 0;
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
			if ($previousValue == $value) {
			$percentile = $previousPercentile;
			} else {
			$percentile = round((99 - $i*100/$total),2);
			$previousPercentile = $percentile;
			}
			$previousValue = $value;
			$i++;
			$out = $result['appname'] . "," . $percentile;
			echo $out . "\r\n";
		}
	}
	elseif ($input == "outbound")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_outbound.csv");
		$collection1 = $db->outboundinterfaces;
		// $filter = [];
		// $options = ['sort' => ['appname' => 1]];
		// $results = $collection1->find($filter,$options);		
		$results = $collection1->find();
		foreach ($results as $result)
		{
			$name = $result['appname'];
			$input = array("appname"=>$name);	
			$interfaces = $collection1->find($input);
			foreach ($interfaces as $interface)
			{
				$out = $result['appname'] . "," . $interface['SFTP'] . "," . $interface['Database Call'] . "," . $interface['MQ'] . "," . $interface['Web Services'] . "," . $interface['Gateway payment'] . "," . $interface['Google Analytics'] . "," . $interface['Chat Bot'] . "," . $interface['API'] . "," . $interface['Email'] . "," . $interface['Faxination'] . "," . $interface['SMTP'] . "," . $interface['Fax'] . "," . $interface['SMS'] . "," . $interface['Windows Service'] . "," . $interface['total'];
				echo $out . "\r\n";
			}
		}
	}
	elseif ($input == "inbound")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_inbound.csv");
		$collection1 = $db->inboundinterfaces;
		// $filter = [];
		// $options = ['sort' => ['appname' => 1]];
		// $results = $collection1->find($filter,$options);		
		$results = $collection1->find();
		foreach ($results as $result)
		{
			$name = $result['appname'];
			$input = array("appname"=>$name);	
			$interfaces = $collection1->find($input);
			foreach ($interfaces as $interface)
			{
				$out = $result['appname'] . "," . $interface['SFTP'] . "," . $interface['Database Call'] . "," . $interface['MQ'] . "," . $interface['Web Services'] . "," . $interface['Email'] . "," . $interface['Postal Letter'] . "," . $interface['Google Analytics'] . "," . $interface['Payment Gateway'] . "," . $interface['API'] . "," . $interface['Windows Service'] . "," . $interface['Applications'] . "," . $interface['total'];
				echo $out . "\r\n";
			}
		}
	}
	elseif ($input == "plan")
	{
		header("Content-Disposition: attachment; filename=Decomm_Analyzer_projectplan.csv");
		foreach ($results4 as $result4){
				$date1 = $result['startDate'];
				$date2 = $result['endDate'];
				$out = $result4['appname'] . "," . $result4['startDate'] . "," . $result4['endDate'];
				echo $out . "\r\n";
		}
	}
