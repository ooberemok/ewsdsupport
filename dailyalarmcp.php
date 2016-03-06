<?php
$page = __FILE__;
include_once "sys/core/init.ini.php";
include_once "sys/inc/header.php";
//include_once "sys/inc/leftbar.php";
?>

<div id="content-alarmcp">
  <?php echo $title."<br>"; ?>
  <p class="time-info"></p>
  <div id="select-day">
  <input type="button" value="Понеділок" id="mo"/>
  <input type="button" value="Вівторок" id="tu"/>
  <input type="button" value="Середа" id="we"/>
  <input type="button" value="Четвер" id="th"/>
  <input type="button" value="П'ятниця" id="fr"/>
  <input type="button" value="Субота" id="sa"/>
  <input type="button" value="Неділя" id="su"/>
  </div>
  <p id="time" style="display:inline;color:#666;font-size:16px"></p>
  <div id="view">
  
  </div>
  <div id="alarms">
  </div>
 <!--?php
 /* 
   
 */
 ?-->
</div>
<?php
include_once "sys/inc/footer.php";
?>