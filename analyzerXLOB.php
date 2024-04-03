<?php
require '/var/www/html/vendor/autoload.php';
	$m = new MongoDB\Client("mongodb://localhost:27017");
	$db = $m->allianz;

	$collection = $db->masterinputXLOB;	
	$results = $collection->find();
	foreach($results as $result)
	{
		$appname = $result["appname"];
		$categoryid = $result["categoryid"];
		$Category = $result["Category"];
		$subcategory = $result["subcategory"];
		$region = $result["region"];
		$deputyowner = $result["deputyowner"];
		$itiscost = $result["itiscost"];
		$rtbcost = $result["rtbcost"];
		$appactive = $result["appactive"];
		$singleorgroup = $result["singleorgroup"];
		$apptype = $result["apptype"];
		$appage = $result["appage"];
		$apploc = $result["apploc"];
		$appexpectedlife = $result["appexpectedlife"];
		$appredundant = $result["appredundant"];
		$appdecommissioned = $result["appdecommissioned"];
		$appmodernized = $result["appmodernized"];
		$appcriticality = $result["appcriticality"];
		$apprevenueimpact = $result["apprevenueimpact"];
		$apptechnologystack = $result["apptechnologystack"];
		$applegal = $result["applegal"];
		$appinterface = $result["appinterface"];
		$appdependencies = $result["appdependencies"];
		$appretirementmethod = $result["appretirementmethod"];
		$appsourcecodearchivalpolicy = $result["appsourcecodearchivalpolicy"];
		$appenhancement = $result["appenhancement"];
		$appmaintainancechanges = $result["appmaintainancechanges"];
		$appdocumentation = $result["appdocumentation"];
		$appknowledge = $result["appknowledge"];
		$appsupportlevel = $result["appsupportlevel"];
		$appftecount = $result["appftecount"];
		$appinboundinterfaces = $result["appinboundinterfaces"];
		$appoutboundinterfaces = $result["appoutboundinterfaces"];
		$appdatagateway = $result["appdatagateway"];
		$appcomplexitylevel = $result["appcomplexitylevel"];
		$appreportfrequency = $result["appreportfrequency"];
		$appnoofservers = $result["appnoofservers"];
		$appbyservers = $result["appbyservers"];
		$appthirdpartytools = $result["appthirdpartytools"];
		$applegaltoolvendors = $result["applegaltoolvendors"];
		$appdatabasesize = $result["appdatabasesize"];
		$appprearchived = $result["appprearchived"];
		$appdatapurgepolicy = $result["appdatapurgepolicy"];
		$apphistoricaldata = $result["apphistoricaldata"];
		$appslaslab = $result["appslaslab"];
		$applegalentities = $result["applegalentities"];
		$appfilename = $result["appfilename"];
		$appcomments = $result["appcomments"];
		$appenddate = $result["appenddate"];
		$appstartdate = $result["appstartdate"];
		$appactualstartdate = $result["appactualstartdate"];
		$appactualenddate = $result["appactualenddate"];
		$appstatus = $result["appstatus"];
		$appstrategy = $result["appstrategy"];
		$appissues = $result["appissues"];
		$applasar = $result["applasar"];
		$apptechnologycomplexity = $result["apptechnologycomplexity"];
		$applinuxserver = $result["applinuxserver"];
		$appmiddleware = $result["appmiddleware"];
		$appstorageoffline = $result["appstorageoffline"];
		$appstorageonline = $result["appstorageonline"];
		$appsysbase = $result["appsysbase"];
		$appunixsserver = $result["appunixsserver"];
		$appsolaris = $result["appsolaris"];
		$appmainframe = $result["appmainframe"];
		$apptechclassified = $result["apptechclassified"];
		$appeliminationoption = $result["appeliminationoption"];
		$appoutgoing = $result["appoutgoing"];
		$appincoming = $result["appincoming"];
		$appusers = $result["appusers"];

		echo "<br> appname - " . $appname;
		echo "<br> Expected life - ". $appexpectedlife;
		//if($appcriticality == "Low"){$appcriticality=2;}
	 	if ($appexpectedlife == "< 1 Year") 
		{
			$appexpectedlifevalue = 1;
		}
		elseif ($appexpectedlife == "1-2 Years") 
		{
			$appexpectedlifevalue = 2;
		}
		elseif ($appexpectedlife == "3-5 Years") 
		{
			$appexpectedlifevalue = 3;
		}
		elseif ($appexpectedlife == ">5 Years") 
		{
			$appexpectedlifevalue = 4;
		}
		elseif ($appexpectedlife == "6-10 Years") 
		{
			$appexpectedlifevalue = 5;
		}
		elseif ($appexpectedlife == "Not Known") 
		{
			$appexpectedlifevalue = 3;
		}
		else
		{
			$appexpectedlifevalue = 3;
		}
		
		$appredundantvalue = 0;
		if ($appredundant == "Yes") 
		{
			$appredundantvalue = 1;
		}
		
		$appagevalue = 3;
		echo "<br> appage - " . $appage;
		if ($appage == "< 2 Years") 
		{
			$appagevalue = 1;
		}
		elseif ($appage == "3-5 Years") 
		{
			$appagevalue = 2;
		}
	elseif ($appage == "6-10 Years" or $appage == "< 10 Years" ) 
		{
			$appagevalue = 3;
		}
		elseif ($appage == "11-20 Years") 
		{
			$appagevalue = 4;
		}
		elseif ($appage == "> 20 Years") 
		{
			$appagevalue = 5;
		}
		elseif ($appage == "Not Known") 
		{
			$appagevalue = 3;
		}
		else
		{
			$appagevalue = 3;
		}
		
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
		
		$applegalvalue = 1;
		if (($applegal == "No")  or ($applegal == "Not Known") )
		{
			$applegalvalue = 0;
		}
		

		$appftevalue = 3;
		$appstability = 1;
		
		if ($appftecount == "<1 FTE") 
		{
			$appftevalue = 1;
			$appstability = 5;
		}
		elseif ($appftecount == "1 - 2 FTE") 
		{
			$appftevalue = 2;
			$appstability = 4;
		}
		elseif ($appftecount == "3 - 5 FTE") 
		{
			$appftevalue = 3;
			$appstability = 3;
		}
		elseif ($appftecount == "6 - 10 FTE") 
		{
			$appftevalue = 4;
			$appstability = 2;
		}
		elseif($appftecount == "6 FTE"){
			$appftevalue = 4;
			$appstability = 2;			
		}
		elseif ($appftecount == "> 10 FTE") 
		{
			$appftevalue = 5;
			$appstability = 1;
		}
		elseif ($appftecount == "Not Known") 
		{
			$appftevalue = 0.1;
			$appstability = 1;
		}
		else
		{
			$appftevalue = 0.1;
			$appstability = 1;
		}
		
		
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
		
		
		$appknowledgevalue = 1;		
		if ($appknowledge == "Has operational & business knowledge") 
		{
			$appknowledgevalue = 4;		
		}
		elseif ($appknowledge == "Has only business knowledge") 
		{
			$appknowledgevalue = 3;
		}
		elseif ($appknowledge == "Has only operational knowledge") 
		{
			$appknowledgevalue = 2;		
		}
		elseif ($appknowledge == "Has only basic information") 
		{
			$appknowledgevalue = 1;		
		}
		
		$appdocumentationenough = "No";
		$appunderstandability = 0;
		if (($appdocumentationvalue > 3) or ($appknowledgevalue > 3 )) 
		{
			$appdocumentationenough = "Yes";
			$appunderstandability = ($appdocumentationvalue + (2 * $appknowledgevalue)) / 5 ;			
		}
		
		
		$appdatagatewayvalue = 1;
		if (($appdatagateway == "No") or ($appdatagateway == "" )) 
		{
			$appdatagatewayvalue = 0;
			$appdocumentationenough = "Yes";
			$appunderstandability = ($appdocumentationvalue + (2 * $appknowledgevalue)) / 5 ;			
		}
		
		$appexternalconnectivityvalue = "1";
		if (($appinterface == "No") or ($appinterface == "Not Known") or ($appinterface == "NA") or ($appinterface == "Decommissioned")) 
		{
			$appexternalconnectivityvalue = "0";			
		}
		

		$cyclomaticcomplexity = round(((5 * $appagevalue + $apptechnologycomplexity + $appcomplexitylevel) / 7),2);
		
		echo '<br> value of appagevalue  ' . $appagevalue;
		echo '<br> value of complexity level ' . $appcomplexitylevel;
		echo '<br> value of complexity complexity ' . $cyclomaticcomplexity;
		echo '<br> value of app size value ' . $appsizevalue;
		echo '<br> value of technology compleixty value ' . $apptechnologycomplexity;
		$processlevelcomplexitylog = 5.2 * log($appcomplexitylevel)  + 0.23 * $cyclomaticcomplexity + 16.2 * log($appsizevalue);
		
		echo '<br> testing appdocumentationvalue ' . $appdocumentationvalue;
		echo '<br> testing appcomplexitylevel ' . $appcomplexitylevel;
		echo '<br> testing cyclomaticcomplexity ' . $cyclomaticcomplexity;
		echo '<br> testing appsizevalue ' . $appsizevalue;
		echo '<br> value of appcriticality  ' . $appcriticality;
		
		$maintainabilityindex = round(171 - $processlevelcomplexitylog + 50 * (sin(sqrt(2.4* $appdocumentationvalue))),2);
		
		$languagecomplexityscore = (((2 * $apptechnologycomplexity) + (2 * $appcomplexitylevel) +  (3 * $appsizevalue)) / 7);

		$riskcriticalityindex = ((2*LOG(1.1*$apprevenueimpact,2)+2*LOG10(1.1*$appcriticality)+2*LOG(1+$appdatagatewayvalue,2))/10 + (LOG10(1+$applegalvalue)/2)  + (LOG10(1+$appexternalconnectivityvalue)/2)) ;
				
		if ($riskcriticalityindex > 1)
		{
			$riskcriticalityindex = 1;
		}
		$riskcriticalityscore = round($riskcriticalityindex,2);		
		
		
		$m = new MongoDB\Client("mongodb://127.0.0.1/");
		$db = $m->allianz;
		$collection1 = $db->inboundinterfaces;
		$collection2 = $db->outboundinterfaces;
		
		$input = array("appname"=>$appname);
		$result = $collection1->findOne($input);
		$result1 = $collection2->findOne($input);
		

		$sftp = $result['sftp'];
		$ftp = $result['ftp'];
		$dbaccess = $result['dbaccess'];
		$flatfiles = $result['flatfiles'];
		$messaging = $result['messaging'];
		$external = $result['manual'];
		$total = $result['total'];
		
		$inboundinterfaces = (($ftp+$flatfiles)/3) + $dbaccess/2  + $sftp + ($external /6) + ($messaging/5) ;
		
		$sftp1 = $result1['sftp'];
		$ftp1 = $result1['ftp'];
		$dbaccess1 = $result1['dbaccess'];
		$flatfiles1 = $result1['flatfiles'];
		$messaging1 = $result1['messaging'];
		$external1 = $result1['manual'];
		$total1 = $result1['total'];
		echo '<br> value of total1  ' . $total1;
		if ($total == null)
		{
			$total = 0;
		}
		if ($total1 == null)
		{
			$total1 = 0;
		}
		
		$outboundinterfaces = (($ftp1+$flatfiles1)/3) + $dbaccess1/2  + $sftp1 + ($external1 /6) + ($messaging1/5) ;
		$interfacesscrore = round((($inboundinterfaces + $outboundinterfaces) / 1.5),2);
		
		$portabilityindexscore = (2*(1/(2*$cyclomaticcomplexity+2*1/$maintainabilityindex+1/5*(($appsizevalue)+0)+(2*$total1)+(3*$appcriticality)+0.667*$appstability+4*($interfacesscrore)+(2 * $languagecomplexityscore))*10));
		
		$portabilityindexscore = round($portabilityindexscore,4);
		if ($portabilityindexscore > 1)
		{
			$portabilityindexscore = 1;
		}
		$languagecomplexityscore = round($languagecomplexityscore,2);
		echo '<br> value of languagecomplexityscore  ' . $languagecomplexityscore;
		$output = array(
			'$set'=>array(
				"riskcriticalityscore"=>$riskcriticalityscore,
				"stabilityscore"=>($appstability/5),
				"outbounds"=>$total1,
				"inbounds"=>$total,
				"portabilityindex"=>$portabilityindexscore,
				"maintainabilityindex"=>$maintainabilityindex,
				"cyclomaticscore"=>($cyclomaticcomplexity/5),
				"appsizevalue"=>$appsizevalue,
				"stability"=>$appstability,
				"languagecomplexityscore"=>($languagecomplexityscore/5),
				"interfacesscore"=> $interfacesscrore
			)
		);
		$m = new MongoDB\Driver\Manager();
		$bulk = new MongoDB\Driver\BulkWrite;
		$bulk->update(
				$input,
				$output
				);
		$m->executeBulkWrite('allianz.masterinputXLOB', $bulk);
		//$collection->update($input,$output);
		
		echo '<br>---------------------------------------------------------------------------';
		echo '<br> Value of P Details ';
		echo '<br> app name ' . $appname ;
		echo '<br> inbounds ' . $total;
		echo '<br> outbounds ' . $total1;
		echo '<br> app size value ' . $appsizevalue;
		echo '<br> cyclomatic complexity '  . $cyclomaticcomplexity;
		echo '<br> Maintainability Index '  . $maintainabilityindex;
		echo '<br> Criticality Index '  . $appcriticality;
		echo '<br> Revenue Index '  . $apprevenueimpact;
		echo '<br> Stability Index '  . $appstability;
		echo '<br> Language Complexity Index '  . $languagecomplexityscore;
		echo '<br> Risk Complexity Index '  . $riskcriticalityscore;
		echo '<br> Interfaces Score Index '  . $interfacesscrore;
		echo '<br> Portability Score Index '  . $portabilityindexscore;
		echo '<br>---------------------------------------------------------------------------';
			
	}
?>