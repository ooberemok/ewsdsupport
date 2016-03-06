<?php
$page = __FILE__;
include_once "sys/core/init.ini.php";
include_once "sys/inc/header.php";
$sid = session_id();
?>
<div id="content">
<ul class="options">
  <li><h2>Daily Alarm CP</h2></li>
  <li><h4>статистика аварійних повідомлень за добу для EWSD Classic</h4></li>
  <li><a href="dailyalarmcp.php"><img src="resources/images/ewsd_classic.bmp" width="80px" height="80px"/></a></li>
</ul>
<hr/>
<ul class="options">
  <li><h2>Daily Alarm MP</h2></li>
  <li><h4>статистика аварійних повідомлень за добу для EWSD PowerNode</h4></li>
  <li><a href="dailyalarmmp.php"><img src="resources/images/hie9200.bmp" width="80px" height="80px"/></a></li>
</ul>
<hr/>
<ul class="options">
  <li><h2>TGRP Staistic</h2></li>
  <li><h4>статистики по транковим групам та напрямкам зв'язку </h4></li>
  <li><a href="tgrpstat.php"><img src="resources/images/tgrpstat.jpg" width="80px" height="80px"/></a></li>
</ul>
<hr/>

<?php

?>
</div>
<?php
include_once "sys/inc/footer.php";
?>