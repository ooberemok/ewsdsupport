<?php
/*
* Create associative array of ExchangeAlarmCp objects. Array populated with exchanges array from config.
* Parse a selaentry file and calculate alarms for every exchange (ExchangeAlarmCp object) 
*/
class ParseArchive implements Serializable{
  //path to the selaentry file
  private $archive;
  private $processed_period="";
  //array to keep the ExchangeAlarmCp instantiated objects. Array populated with exchanges array from config 
  private $exchanges_alarms = array();
   
  public function __construct($all_exchanges,$day){
      $this->archive = $_SERVER['DOCUMENT_ROOT']."/resources/files/alarmcp/archive.".$day;
	  foreach($all_exchanges as $exchange){
       $this->exchanges_alarms[$exchange] = new ExchangeAlarmCp($exchange);
   }
  }
  public function getExchangesAlarmes(){
      return $this->exchanges_alarms;
  }
  public function parceFile(){
      try{
	    $handle = @fopen($this->archive,"r");
	  }
	  catch(Exception $e){
	      echo "NO SUCH FILE! ".$e->getMessage();
	  }
	  $event_start = false;
	  $event_end = false;
	  $event = array();
	  //counter to read only first occurrence of string with word "accepted"
	  $count_accepted = 0;
	  if($handle){
	    while(($line = fgets($handle))!== false){
		    //determine start date parameter of selaentry
			
            if((strpos($line,"ACCEPTED") !== false ) && $count_accepted === 0){
			    $fromDate = substr($line,0,8);
				$this->setProcessedPeriod($fromDate);
				$count_accepted++;
			}            
  			  
			if(strpos($line,"HEADER:") === 0){
			    $event_start = true;
			}
			if($event_start && strpos($line,"END TEXT") === 0){
			    $event_end = true;
			
			}
			if($event_start && !$event_end){
			    $line = trim($line);
				if(strlen($line)>1){
			        array_push($event,$line);
				}
			}
			if($event_start && $event_end){
			    $this->parseEvent($event);
				$event = array();
				$event_start = false;
				$event_end = false;
			}
			
		}
		fclose($handle);
	  }
  }
  private function setProcessedPeriod($fromDate){
     if(strlen($fromDate)==8){
	     
         $line_start = " з 07:00 " . $fromDate . " ";
		 $ts_tillDate = strtotime($fromDate) + 24*60*60;
		 $tillDate = date('y-m-d',$ts_tillDate);
		 $this->processed_period =  $line_start . "до 07:00 ".$tillDate ;
		 
	 }
  }
  public function getProcessedPeriod(){
      return $this->processed_period;
  }
  private function parseEvent($event){
     $exchange_name = explode("/",$event[1])[0];
     if(count($event)>4){
	     if(strpos($event[4],"MASKNO:") === false)
	       $line = $event[4];
	     else 
	       $line = $event[5];
		 if(strpos($line,"*** ")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("CRIT");
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("CRIT",$this->getText($event));   
		 }
		 if(strpos($line,"**  ")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("MAJ");
           $this->exchanges_alarms[$exchange_name]->setAlarmText("MAJ",$this->getText($event)); 		   
		 }
		 if(strpos($line,"*** CENTRAL UNIT")=== 0 || strpos($line,"**  CENTRAL UNIT")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("CU"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("CU",$this->getText($event)); 
		 }
		 if(strpos($line,"*** SN")=== 0 || strpos($line,"**  SN")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("SN"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("SN",$this->getText($event)); 
		 }
		 if(strpos($line,"*** MB")=== 0 || strpos($line,"**  MB")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("MB"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("MB",$this->getText($event)); 
		 }
		 /*CCNC alarm
		 if(strpos($line,"*** ")=== 0 || strpos($line,"**  ")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("CCNC"); 
		 }
		  CLOCK
		 if(strpos($line,"*** ")=== 0 || strpos($line,"**  ")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("CLOCK"); 
		 }*/
		 if(strpos($line,"*** DLU")=== 0 || strpos($line,"**  DLU")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("DLU"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("DLU",$this->getText($event)); 
		 }
		 if(strpos($line,"*** EXTERNAL ALARM EXCHANGE")=== 0 || strpos($line,"**  EXTERNAL ALARM EXCHANGE")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("EALEXCH");
           $this->exchanges_alarms[$exchange_name]->setAlarmText("EALEXCH",$this->getText($event)); 		   
		 }
		 if(strpos($line,"*** EXTERNAL ALARM DLU")=== 0 || strpos($line,"**  EXTERNAL ALARM DLU")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("EALDLU"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("EALDLU",$this->getText($event)); 
		 }
		 /*RECOVERY*/
		 if(strpos($line,"SSP     RECOVERY INFORMATION")=== 0 || strpos($line,"*** SYSTEM  - RECOVERY ALARM") === 0 ){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("RECOV");
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("RECOV",$this->getText($event)); 		   
		 }
		
		 if(strpos($line,"PLAUSIBILITY CHECK FAILURE")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("SWSG"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("SWSG",$this->getText($event)); 
		 }
		 if(strpos($line,"AUDIT ERROR DISPLAY")=== 0){
		   $this->exchanges_alarms[$exchange_name]->setAlarms("AUDIT"); 
		   $this->exchanges_alarms[$exchange_name]->setAlarmText("AUDIT",$this->getText($event)); 
		 }
		 	 
	 }
  }
  private function getText($event){
      $alarm_text = "";
	  foreach($event as $item){
	      $alarm_text .= $item."#";
	  }
	  
	  return $alarm_text;
  }
  public function displayAlarms(){
      //if($this->getProcessedPeriod() != ""){
	    echo "<p>Період часу за який зібрана статистика:".$this->getProcessedPeriod()."</p>";
	  //}
      echo "<table><tr><th>Exchange</th>";
	  foreach(ExchangeAlarmCp::$alarm_types as $val){
	    echo "<th>" . $val . "</th>";  
	  }
	  echo "</tr>";
	  echo "<caption>EWSD Daily Report (without SSNC and MP)</caption>";
      foreach($this->exchanges_alarms as $key => $value){
	      echo "<tr><td class='exchange'>".$key. "</td><td id='".$key."-CRIT"."'>". $value->getAlarms()["CRIT"]."</td><td id='".$key."-MAJ"."'>".$value->getAlarms()["MAJ"]."</td><td id='".$key."-CU"."'>".
		       $value->getAlarms()["CU"]."</td><td id='".$key."-SN"."'>".$value->getAlarms()["SN"]."</td><td id='".$key."-MB"."'>".$value->getAlarms()["MB"]."</td><td id='".$key."-CCNC"."'>".
			   $value->getAlarms()["CCNC"]."</td><td id='".$key."-CLOCK"."'>".$value->getAlarms()["CLOCK"]."</td><td id='".$key."-DLU"."'>".$value->getAlarms()["DLU"]."</td><td id='".$key."-EALEXCH"."'>".
			   $value->getAlarms()["EALEXCH"]."</td><td id='".$key."-EALDLU"."'>".$value->getAlarms()["EALDLU"]."</td><td id='".$key."-RECOV"."'>".
			   $value->getAlarms()["RECOV"]."</td><td id='".$key."-OVRLD"."'>".$value->getAlarms()["OVRLD"]."</td><td id='".$key."-SWSG"."'>".$value->getAlarms()["SWSG"]."</td><td id='".$key."-AUDIT"."'>".
			   $value->getAlarms()["AUDIT"]."</td></tr>";
	  }
	  echo "</table>";
	  /*foreach($this->exchanges_alarms as $key => $value){
	     if($key == "NIKO")
	         echo $key. " - " . $value->getAlarmText()["CRIT"];
	  }*/
	  
  }
  public function serialize(){
        return serialize([
            $this->archive,
            $this->exchanges_alarms,
			$this->processed_period
        ]);
   }
   public function unserialize($data){
        list(
            $this->archive,
            $this->exchanges_alarms,
			$this->processed_period
        ) = unserialize($data);
   }
}
?>