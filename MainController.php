<?php
//session_start();
if(isset($_COOKIE['user'])){
        switch ($_REQUEST['components'])
        {
            case "authenticate" :
                include_once  'components/authenticate/authenticate.php';
            break;
            case "dashboard" :
                include_once  'components/dashboard/dashboard.php';
            break;
            case "checklist" :
                include_once  'components/checklist/checklist.php';
            break;
            case "cms" :
                include_once  'components/cms/cms.php';
            break;
            case "incident" :
                include_once  'components/incident/incident.php';
            break;
            case "inventory" :
                include_once  'components/inventory/inventory.php';
            break;
            case "settings" :
                include_once  'components/settings/settings.php';
            break;
             default:
                header('Location: index.php?components=dashboard&action=home');
            break;
        }
}else{
	if(isset($_REQUEST['components'])){
		if($_REQUEST['components']=='authenticate')
			include_once  'components/authenticate/authenticate.php';
		else{
			setcookie('redirect',"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]",time()+300);
	        header('Location: index.php?components=authenticate&action=show');
	   }
    }else{
        header('Location: index.php?components=authenticate&action=show');
    }
}
?>