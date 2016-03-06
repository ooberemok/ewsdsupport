<div id="leftbar">
<div id="cssmenu">
<ul>
  <li><h3 style="margin:0;padding:0 0 20px 10px;color:green;border-bottom:3px solid gray;">Станції</h3></li>
  <?php
    if(strpos($page,'dailyalarmmp.php') === false){
		for($i=0; $i<count($all_exchanges);$i++){
		?>
		    <li><a href="#" id="<?php echo $all_exchanges[$i]."id" ?>"><?php echo $all_exchanges[$i]; ?></a></li>
	<?php
		}
	}
	else{
		for($i=0; $i<count($powernode_exchanges);$i++){
			?>
		    <li><a href="#" id="<?php echo $powernode_exchanges[$i]."id" ?>"><?php echo $powernode_exchanges[$i]; ?></a></li>	
	<?php
        }	
	}
  ?>
  </ul>
  </div>
</div>