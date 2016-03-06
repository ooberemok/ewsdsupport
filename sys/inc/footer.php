</div><!--container-->
<div id="footer">
  
    <?php  
          for($i=0;$i<count($nav_items);$i++){
			 
			  ?>
			  	<a href="<?php echo $pages[$i] . '.php' ?>"><?php echo $nav_items[$i]; ?></a>	
<?php				
			  }
		?>
  <div class="linetext"><span style="color:white"><?php echo $title;  ?></span></div>
<p>@<?php echo date("Y"); ?> EWSD Support</p>  
</div>
<script type="text/javascript" src="resources/js/jquery-1.12.0.min.js"></script>
<script type="text/javascript"  src="resources/js/script.js"></script>
<body>
<html>