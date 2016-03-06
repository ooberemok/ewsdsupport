<?php
class ExchangeAlarmCp implements Serializable{
  private $exchange_name;
  public static $alarm_types = array("CRIT","MAJ","CU","SN","MB","CCNC",
                                     "CLOCK","DLU","EALEXCH","EALDLU",
									 "RECOV","OVRLD","SWSG","AUDIT");
  
  private $alarms = array();
  
  
  private $exch_alarm_text = array();
  
  public function __construct($name){
      //setExchangeName($name);
	  $this->exchange_name = $name;
      foreach(self::$alarm_types as $key){
	    
	    //initialize $alarms array
		$this->alarms[$key] = 0;
		
		//initialize $exch_alarm_text array
		$this->exch_alarm_text[$key] = "";
	  }
	  
  }
  private function setExchangeName($name){
     $this->exchange_name = $name;
  }
  public function getExchangeName(){
       return $this->exchange_name;
  }
  
   public function setAlarmText($alarm,$text){
      
      $this->exch_alarm_text[$alarm] .= $text.'_'.$alarm.'_';
  }
  
  public function getAlarmText(){
      return $this->exch_alarm_text;
  }
  
  public function getAlarms(){
      return $this->alarms;
  }
  public function setAlarms($type){
      switch($type){
	      case "CRIT": $this->alarms['CRIT'] += 1;
		  break;
		  case "MAJ": $this->alarms['MAJ'] += 1;
		  break;
		  case "CU": $this->alarms['CU'] += 1;
		  break;
		  case "SN": $this->alarms['SN'] += 1;
		  break;
		  case "MB": $this->alarms['MB'] += 1;
		  break;
		  case "CCNC": $this->alarms['CCNC'] += 1;
		  break;
		  case "CLOCK": $this->alarms['CLOCK'] += 1;
		  break;
		  case "DLU": $this->alarms['DLU'] += 1;
		  break;
		  case "EALEXCH": $this->alarms['EALEXCH'] += 1;
		  break;
		  case "EALDLU": $this->alarms['EALDLU'] += 1;
		  break;
		  case "RECOV": $this->alarms['RECOV'] += 1;
		  break;
		  case "OVRLD": $this->alarms['OVRLD'] += 1;
		  break;
		  case "SWSG": $this->alarms['SWSG'] += 1;
		  break;
		  case "AUDIT": $this->alarms['AUDIT'] += 1;
		  break;
		  default:
		  break;
	  }
	  
  }
 
  
  public function serialize(){
        return serialize([
            $this->exchange_name,
            $this->alarms,
			$this->exch_alarm_text
			
        ]);
   }
   public function unserialize($data){
        list(
            $this->archive,
            $this->alarms,
			$this->exch_alarm_text
			
        ) = unserialize($data);
   }
  
}

?>