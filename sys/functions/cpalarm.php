<?php 
include_once "../class/class.parsearchive.inc.php";
include_once "../class/class.exchangealarmcp.inc.php";
session_start(); 
$day = $_REQUEST['day'];
//echo $day."<br>";

include_once "../config/config.ini.php";

if(isset($_SESSION['parseFile']) && $_SESSION['day'] == $day){
      $_SESSION['parseFile']->displayAlarms();
	  
      //$_SESSION['parseFile']->getExchangesAlarmes()[$exchange]->getAlarmText(); 
      echo json_encode($_SESSION['json_text_alarm']);
}
else if(isset($_SESSION['parseFile']) && $_SESSION['day'] != $day){
      $_SESSION['parseFile'] = null;
	  $_SESSION['day'] = $day;
   $_SESSION['parseFile'] =  new ParseArchive($all_exchanges,$_SESSION['day']);
   $_SESSION['parseFile']->parceFile();
   $_SESSION['parseFile']->displayAlarms();
   $_SESSION['json_text_alarm'] = array();
   foreach($all_exchanges as $exchange){
       array_push($_SESSION['json_text_alarm'],$_SESSION['parseFile']->getExchangesAlarmes()[$exchange]->getAlarmText()); 
   }
   echo json_encode($_SESSION['json_text_alarm']);
}
else if(!isset($_SESSION['parseFile'])){
   //$parseFile = new ParseArchive($all_exchanges,$day);
   $_SESSION['day'] = $day;
   $_SESSION['parseFile'] =  new ParseArchive($all_exchanges,$_SESSION['day']);
   $_SESSION['parseFile']->parceFile();
   $_SESSION['parseFile']->displayAlarms();
   $_SESSION['json_text_alarm'] = array();
   foreach($all_exchanges as $exchange){
       array_push($_SESSION['json_text_alarm'],$_SESSION['parseFile']->getExchangesAlarmes()[$exchange]->getAlarmText()); 
   }
   echo json_encode($_SESSION['json_text_alarm']);
}

?>