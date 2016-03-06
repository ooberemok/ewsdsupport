<?php
$page = __FILE__;
include_once "sys/core/init.ini.php";
include_once "sys/inc/header.php";
@$day = $_REQUEST['days'];
?>

<div id="content-alarmmp">
   <p class="time-info"></p>
  <div id="select-day">
  <form method="post" action="dailyalarmmp.php">
 <input type="radio" name="days" value="mo" id="momp"/><label for="momp">Понеділок </label>
 <input type="radio" name="days" value="tu" id="tump"/><label for="tump">Вівторок </label>
 <input type="radio" name="days" value="we" id="wemp"/><label for="wemp">Середа </label>
 <input type="radio" name="days" value="th" id="thmp"/><label for="thmp">Четвер </label>
 <input type="radio" name="days" value="fr" id="frmp"/><label for="frmp">П'ятниця </label>
 <input type="radio" name="days" value="sa" id="samp"/><label for="samp">Субота</label>
 <input type="radio" name="days" value="su" id="sump"/><label for="sump">Неділя </label><br><br>
 <input type="submit" value="отримати статистику за вибраний день"/>
  </form>
  </div>
<?php
if(isset($day) && strlen($day) > 0){
  if(!isset($_SESSION['daymp'])){
     $_SESSION['daymp'] = $day;
	 echo "<br>DAYMP has been set now. ".$_SESSION['daymp']."<br>"; 
  }
  else if(isset($_SESSION['daymp']) && $_SESSION['daymp'] === $day){
    echo "<br>DAYMP is set: ".$_SESSION['daymp']."<br>"; 
  }
  else if(isset($_SESSION['daymp']) && $_SESSION['daymp'] !== $day){
      $_SESSION['daymp'] = $day;
	  echo "<br>DAYMP is changed: ".$_SESSION['daymp']."<br>"; 
  }
}
else{
    echo "<br>DAYMP is not set. ".$day."<br>"; 
}
echo "<p>Сторінка знаходиться в розробці<p>";
?>  
</div>
<?php
include_once "sys/inc/footer.php";
?>