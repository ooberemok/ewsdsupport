<?php session_start(); ?>
<!DOCTYPE html>
<html lang=ru>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
  <title><?php echo $title; ?></title>
<link rel="icon" href="resources/images/img.ico" type="image/x-icon" />
  <link rel="stylesheet" href="resources/css/style.css" />
  <link rel="stylesheet" href="resources/css/style_print.css" media="print" />

</head>
<body>
  <div id="container">
    
    <div id="nav">
<a href="http://10.5.15.10:8181/index.php" style="text-decoration:none"><h3 style="display:inline;color:black;font-size:20px;padding-right:20px;border-right:2px solid gray">EWSD Support</h3></a>
	 <ul >
      
	    <?php  
          for($i=0;$i<count($nav_items);$i++){
			  ?>
			  	<li><a href="<?php echo $pages[$i] . '.php' ?>"><?php echo $nav_items[$i]; ?></a></li>	
<?php				
		  }
		?>
		
	  </ul> 
	  	  
	  </div>
	<div class="linetext"><span><?php echo $title; ?></span></div>
    
