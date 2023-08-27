<?php
        switch ($_REQUEST['action'])
        {
            case "show" :
                include_once  'components/authenticate/modle/authenticateModule.php';
                companyProfile();
                include_once  'components/authenticate/view/login.php';
            break;
            
            case "login" :
                include_once  'components/authenticate/modle/authenticateModule.php';
                if(login()){
                	if(isset($_COOKIE['redirect'])){
                		$redirect=$_COOKIE['redirect'];
                		setcookie('redirect',"",time()-300);
                		header('Location: '.$redirect);
                	}else{
	                	header('Location: index.php?components=dashboard&action=home');
	               	}
                }else{
	                header('Location: index.php?components=authenticate&action=show&message='.$message);
                }
            break;
            
            case "logout" :
                include_once  'components/authenticate/modle/authenticateModule.php';
                logout();
                header('Location: index.php?components=authenticate&action=show');
            break;
                
            default:
                print '<p><srtong>Bad Request</strong></p>';
            break;
        }
?>