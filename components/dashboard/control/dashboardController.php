<?php

        switch ($_REQUEST['action'])
        {
            case "home" :
                include_once  'components/dashboard/modle/dashboardModule.php';
                setInitialVar();
                if(isset($_COOKIE['checklist'])){
                	if($_COOKIE['checklist']==md5('Submitter')) checklistSubmiter();
                	if($_COOKIE['checklist']==md5('Approver')) checklistApprover();
                }
                getDashboardEvent();
                chartData();
                include_once  'components/dashboard/view/view.php';
            break;
            
            case "acknowledge" :
                include_once  'components/dashboard/modle/dashboardModule.php';
                if(acknowledge())
                	header('Location: index.php?components=dashboard&action=home');
                else
                	header('Location: index.php?components=dashboard&action=home');
            break;
            
            case "cl_reopen" :
                include_once  'components/settings/modle/settingsModule.php';
                if(checklistReopen())
                	header('Location: index.php?components=dashboard&action=home');
                else
                	header('Location: index.php?components=dashboard&action=home');
            break;

            default:
                print '<p><srtong>Bad Request</strong></p>';
            break;
        }
     
?>