<?php
                include_once  'template/headerQuery.php';
                listModule();
                companyProfile();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php print $se_appname_template; ?></title>
<link rel="stylesheet" type="text/css" href="css/960.css" />
<link rel="stylesheet" type="text/css" href="css/reset.css" />
<link rel="stylesheet" type="text/css" href="css/text.css" />
<link rel="stylesheet" type="text/css" href="css/blue.css" />
<link rel="stylesheet" type="text/css" href="css/wapp.css" />
<link type="text/css" href="css/smoothness/ui.css" rel="stylesheet" />  
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/blend/jquery.blend.js"></script>
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.sortable.js"></script>    
    <script type="text/javascript" src="js/ui.dialog.js"></script>
    <script type="text/javascript" src="js/ui.datepicker.js"></script>
    <script type="text/javascript" src="js/effects.js"></script>
    <script type="text/javascript" src="js/flot/jquery.flot.pack.js"></script>
    <!--[if IE]>
    <script language="javascript" type="text/javascript" src="js/flot/excanvas.pack.js"></script>
    <![endif]-->
	<!--[if IE 6]>
	<link rel="stylesheet" type="text/css" href="css/iefix.css" />
	<script src="js/pngfix.js"></script>
    <script>
        DD_belatedPNG.fix('#menu ul li a span span');
    </script>        
    <![endif]-->
    <script id="source" language="javascript" type="text/javascript" src="js/graphs.js"></script>
    <script type="text/javascript" src="js/plname.js"></script>
    <script type="text/javascript" src="js/wapp.js"></script>
</head>

<body>
<div id="loading1" style="display:none"><img src="images/loading.gif" style="width:25px" /></div>
<!-- WRAPPER START -->
<div class="container_16" id="wrapper">	
<!-- HIDDEN COLOR CHANGER -->      
      <div style="position:relative;">
      	<div id="colorchanger">
        	<a href="index.php?components=dashboard&action=checkupdate_now"><span class="redtheme" >Check Updates</span></a>
        <?php
        if($_GET['components']=='dashboard'){
        	for($u=0;$u<sizeof($up_id);$u++){
        		print '<a href="#" ><span onclick="updateNow('.$up_uid[$u].')" class="bluetheme">'.$up_uid[$u].'</span><br /><span onclick="window.open('."'".'http://www.wappcloud.com/APPCENTER/releasenote/'.$up_note[$u].".html'".','."'".'_blank'."'".')">'.$up_note[$u].'</span></a>';
        	}
        }
        ?>
        </div>
      </div>
  	<!--LOGO-->
	<div class="grid_8" id="logo"><?php print $se_appname_template; ?></div>
    <div class="grid_8">
<!-- USER TOOLS START -->
      <div id="user_tools"><span><a href="#" class="mail">(1)</a> Welcome <a href="#"><?php print ucfirst($_COOKIE['name']); ?></a>  
		  |  <a class="dropdown" href="#">Updates</a>  |  <a href="index.php?components=authenticate&action=logout">
		  Logout</a></span></div>
    </div>
<!-- USER TOOLS END -->    
<div class="grid_16" id="header">
<!-- MENU START -->
<div id="menu" >
	<ul class="group" id="menu_group_main" style="margin: 12px 0px 0px <?php print $left_margin;?>px;">
	<?php if($_REQUEST['components']=='dashboard') $select='class="main current"'; else $select=''; ?>
		<li class="item first" id="one"><a href="index.php" <?php print $select; ?> ><span class="outer"><span class="inner dashboard">Dashboard</span></span></a></li>
	<?php
		$menu_id=array('two','three','four','five','six','seven','eight','nine');
		for($j=0;$j<sizeof($module_id);$j++){
			if($_REQUEST['components']==$module_component[$j]) $select='class="main current"'; else $select='';
			print '<li class="item '.$module_location[$j].'" id="'.$menu_id[$j].'"><a href="index.php?components='.$module_component[$j].'&action='.$module_action[$j].'" '.$select.' ><span class="outer"><span class="inner '.$menu_id[$module_id[$j]-1].'">'.$module_name[$j].'</span></span></a></li>';
		}
	?>
	<!--
	  	<li class="item middle" id="seven"><a href="index.php?components=settings&action=general" <?php print $select7; ?> ><span class="outer"><span class="inner seven">Settings</span></span></a></li>        	
		<li class="item last" id="eight"><a href="index.php?components=authenticate&action=logout" class="main" ><span class="outer"><span class="inner eight">Exit</span></span></a></li>        
    -->
    </ul>
</div>
<!-- MENU END -->
			