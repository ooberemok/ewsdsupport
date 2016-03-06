<?php
include_once 'SYS'.'/config/config.ini.php';
//$tmp = explode("\\",$page);
//$page = $tmp[count($tmp)-1];
/*$page variable is declared in main pages (index.php, dailyalarmcp.php, dailyalarmmp.php, tgrpstat.php, contacts.php, help.php)
* switch block - determines page title according to the current page   
*/
switch($page){
	
	case (strpos($page,'index.php') !== false):
			$title = "EWSD Support";
			break;
	case (strpos($page,'dailyalarmcp.php') !== false):
			$title = "EWSD Support DailyAlarm CP";
			break;
	case (strpos($page,'dailyalarmmp.php') !== false):
		    $title = "EWSD Support DailyAlarm MP";
			break;
	case (strpos($page,'tgrpstat.php') !== false):
			$title = "EWSD Support TGRP Stat";
			break;
	case (strpos($page,'contacts.php') !== false):
			$title = "EWSD Support Contacts";
			break;
	case (strpos($page,'help.php') !== false):
			$title = "EWSD Support Help";
			break;
}

/*autoload of classes*/
spl_autoload_register(function ($class){
    $filename = SYS."/class/class." . $class . ".inc.php";
	if ( file_exists($filename) )
	{
		include_once $filename;
		
	}
	else{
	    echo "File " . $filename . " does not exist <br>" ;
	}
}); 

?>