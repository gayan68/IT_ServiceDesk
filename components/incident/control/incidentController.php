<?php
//-------------------------------------Incident Submitter------------------------------------//
if($_COOKIE['incident']==md5('Submitter')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=incident&action=show_submit');
            break;
            
            case "show_submit" :
                include_once  'components/incident/modle/incidentModule.php';
                getFormData();
                include_once  'components/incident/view/view.php';
            break;
            
            case "add_incident" :
                include_once  'components/incident/modle/incidentModule.php';
                include_once  'components/settings/modle/email.php';
                if(addIncident())
                	header('Location: index.php?components=incident&action=show_submit&re=true&message='.$message);
                else
                	header('Location: index.php?components=incident&action=show_submit&re=false&message='.$message);
            break;
        }
}

//-------------------------------------Incident Approver------------------------------------//
if($_COOKIE['incident']==md5('Approver')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=incident&action=show_approve_list');
            break;
            
            case "show_approve_list" :
                include_once  'components/incident/modle/incidentModule.php';
                listIncidents('pending');
                include_once  'components/incident/view/approve.php';
            break;
            
            case "show_approve_inc" :
                include_once  'components/incident/modle/incidentModule.php';
                getIncident();
                include_once  'components/incident/view/approve.php';
            break;
            
            case "approve" :
                include_once  'components/incident/modle/incidentModule.php';
                include_once  'components/settings/modle/email.php';
                if(approveIncident('approve'))
                	header('Location: index.php?components=incident&action=show_approve_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=incident&action=show_approve_list&re=false&message='.$message);
            break;
            
            case "reject" :
                include_once  'components/incident/modle/incidentModule.php';
                include_once  'components/settings/modle/email.php';
                if(approveIncident('reject'))
                	header('Location: index.php?components=incident&action=show_approve_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=incident&action=show_approve_list&re=false&message='.$message);
            break;
            
            case "delete_incident" :
                include_once  'components/incident/modle/incidentModule.php';
                if(deleteIncident())
                	header('Location: index.php?components=incident&action=list_list&filter=all&re=true&message='.$message);
                else
                	header('Location: index.php?components=incident&action=list_list&filter=all&re=false&message='.$message);
            break;
        }
}

//---------------------------------------- Default ------------------------------------//
        switch ($_REQUEST['action'])
        {
            case "list_list" :
                include_once  'components/incident/modle/incidentModule.php';
                listIncidents($_GET['filter']);
                include_once  'components/incident/view/list.php';
            break;
            
            case "list_search" :
                include_once  'components/cms/modle/cmsModule.php';
                listSearch();
                include_once  'components/cms/view/list.php';
            break;
            
            case "list_inc" :
                include_once  'components/incident/modle/incidentModule.php';
                getIncident();
                include_once  'components/incident/view/list.php';
            break;
            
            case "print_incident" :
                include_once  'components/incident/modle/incidentModule.php';
                companyProfile2();
                getIncident();
                include_once  'components/incident/view/printIncident.php';
            break;
            
            case "list_report" :
                include_once  'components/incident/modle/incidentModule.php';
	            listYears();
                include_once  'components/incident/view/report.php';
            break;
            
            case "get_report" :
                include_once  'components/incident/modle/incidentModule.php';
	            listYears();
	            if($_GET['type']=='all') incidentStaus('all');
	            if($_GET['type']=='pending') incidentStaus('pending');
	            if($_GET['type']=='approved') incidentStaus('approved');
	            if($_GET['type']=='rejected') incidentStaus('rejected');
	            if($_GET['type']=='top_incidents') reportDeviceBase();
	            if($_GET['type']=='relation_inc') getRelation($_GET['id'],true);
	            if($_GET['type']=='by_device'){ getFormData(); 
	            reportOneDevice($_GET['filter']); }
                include_once  'components/incident/view/report.php';
            break;
        }
?>