<?php
class ExchangeAlarmMp implements Serializable{
  
  private $exchange_name;
  
  public static $alarm_types = array("CRIT","MAJ","WOR");
  
  //array to store number of alarm types 
  private $alarms = array();
  
  //array to store    
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
		  case "WOR": $this->alarms['WAR'] += 1;
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