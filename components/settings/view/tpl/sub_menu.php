<?php
$submenu0=$submenu1=$submenu2=$submenu3=$submenu4=$submenu7=$submenu8='';
$submenu5='class="more"';
$submenu6='class="more2"';
$submenu7='class="more3"';
        switch ($_REQUEST['action'])
        {
            case "myprofile" :
            	$submenu0='class="current"';
            break;
            case "settings" :
            	$submenu1='class="current"';
            break;
            case "module" :
            	$submenu2='class="current"';
            break;
            case "userprofile" :
            	$submenu3='class="current"';
            break;
            case "device" :
            	$submenu4='class="current"';
            break;
            case "checklist_general" :
            	$submenu5='class="current more"';
            break;
            case "checklist_user" :
            	$submenu5='class="current more"';
            break;
            case "cms_general" :
            	$submenu6='class="current more2"';
            break;
            case "cms_user" :
            	$submenu6='class="current more2"';
            break;
            case "incident_general" :
            	$submenu7='class="current more3"';
            break;
            case "incident_user" :
            	$submenu7='class="current more3"';
            break;
            case "inventory_user" :
            	$submenu8='class="current more3"';
            break;
         }

?>

<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
            <?php
            if($_COOKIE['type']==md5('appadmin')){
                      print '<li><a href="index.php?components=settings&action=myprofile" '.$submenu0.'><span>My Profile</span></a></li>';
                      print '<li><a href="index.php?components=settings&action=settings" '.$submenu1.'><span>General Settings</span></a></li>';
                      print '<li><a href="index.php?components=settings&action=module" '.$submenu2.'><span>Module Activator</span></a></li>';
                      print '<li><a href="index.php?components=settings&action=userprofile" '.$submenu3.'><span>User Profiles</span></a></li>';
                      print '<li><a href="index.php?components=settings&action=device" '.$submenu4.'><span>Devices</span></a></li>';
                      if($sub_status['checklist']==1) print '<li><a href="#" '.$submenu5.'><span>Checklist</span></a></li>';
                      if($sub_status['cms']==1) print '<li><a href="#" '.$submenu6.'><span>CMS</span></a></li>';
                      if($sub_status['incident']==1) print '<li><a href="#" '.$submenu7.'><span>Incident</span></a></li>';
                      if($sub_status['inventory']==1) print '<li><a href="index.php?components=settings&action=inventory_user" '.$submenu8.'><span>Inventory</span></a></li>';
             }else
             		print '<li><a href="index.php?components=settings&action=myprofile" class="current"><span>My Profile</span></a></li>';

			?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- HIDDEN SUBMENU START -->
<div class="grid_16" id="hidden_submenu">
	  <ul class="more_menu">
		<li><a href="index.php?components=settings&action=checklist_general">Checklist General Settings</a></li>
      </ul>
	  <ul class="more_menu">
		<li><a href="index.php?components=settings&action=checklist_user">Checklist Manage Users </a></li>
      </ul>
  </div>
<!-- HIDDEN SUBMENU END -->  
<!-- HIDDEN SUBMENU2 START -->
<div class="grid_16" id="hidden_submenu2">
	  <ul class="more2_menu2">
		<li><a href="index.php?components=settings&action=cms_general">CMS General Settings</a></li>
      </ul>
	  <ul class="more2_menu2">
		<li><a href="index.php?components=settings&action=cms_user">CMS Manage Users </a></li>
      </ul>
  </div>
<!-- HIDDEN SUBMENU END --> 
<!-- HIDDEN SUBMENU2 START -->
<div class="grid_16" id="hidden_submenu3">
	  <ul class="more3_menu3">
		<li><a href="index.php?components=settings&action=incident_general">Incident General Settings</a></li>
      </ul>
	  <ul class="more3_menu3">
		<li><a href="index.php?components=settings&action=incident_user">Incident Manage Users </a></li>
      </ul>
  </div>
<!-- HIDDEN SUBMENU END -->  
