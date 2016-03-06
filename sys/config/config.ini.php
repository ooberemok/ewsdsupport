<?php
$all_exchanges = array('AMTSK','CHEOP','CHERK','CHRS','D725','DNPP','IKV','IKA2','ISCKH','IVAF','IVFOP','KHER','KRIV',
'LUTS','LUTSK','MTSKH','NIKO','OD34','RIVNE','ROVN','TERN','TRNUK','ZAPOR');
$powernode_exchanges = array('AMTSK','MTSKH','OD34');
$nav_items = array('Home','DailyAlarmCP','DailyAlarmMP','TGRP Stat','Contacts','Help');
$pages = array('index','dailyalarmcp','dailyalarmmp','tgrpstat','contacts','help');
/*Define CONSTANTS*/
//DR - DOCOOMENT_ROOT
define('DR',$_SERVER['DOCUMENT_ROOT']);
//OS DELIMITER  
define('DELIMITER','/');
//Application root 
define('AR',DR."/");
//Path to the resources folder (containes files, css, js, images)
define('RESOURCES',AR.'/resources');
//Path to the sys folder (contains class, inc, functions, core, config folders)
define('SYS',AR.'/sys');
?>