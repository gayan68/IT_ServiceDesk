<?php
if($_COOKIE['checklist']==md5('Submitter')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                include_once  'components/checklist/modle/checklistModule.php';
                listDevices();
                include_once  'components/checklist/view/dataView.php';
            break;
            
            case "show_checklist" :
                include_once  'components/checklist/modle/checklistModule.php';
	            showCheckList();
	            showApproveComment();
	            include_once  'components/checklist/view/showChecklist.php';
            break;

            case "list_checklist2" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(7,'Submitter');
	            include_once  'components/checklist/view/listChecklist.php';
            break;
            
            case "show_edit" :
                include_once  'components/checklist/modle/checklistModule.php';
	            showCheckList();
	            include_once  'components/checklist/view/editView.php';
            break;
            
            case "addchecklist" :
                include_once  'components/checklist/modle/checklistModule.php';
                include_once  'components/settings/modle/email.php';
                if(addChecklist())
                	header('Location: index.php?components=checklist&action=show&re=true&message='.$message);
                else
                	header('Location: index.php?components=checklist&action=show&re=false&message='.$message);
            break;

            case "updatechecklist" :
                include_once  'components/checklist/modle/checklistModule.php';
                include_once  'components/settings/modle/email.php';
                if(updateChecklist())
                	header('Location: index.php?components=checklist&action=show&re=true&message='.$message);
                else
                	header('Location: index.php?components=checklist&action=show&re=false&message='.$message);
            break;
         }
}else

if($_COOKIE['checklist']==md5('Approver')){
        switch ($_REQUEST['action'])
        {
            case "show" :
				header('Location: index.php?components=checklist&action=list_checklist');
            break;
            
            case "approve" :
                include_once  'components/checklist/modle/checklistModule.php';
                if(approve())
                	header('Location: index.php?components=checklist&action=list_checklist1&re=true&message='.$message);
                else
                	header('Location: index.php?components=checklist&action=list_checklist1&re=false&message='.$message);
            break;
            
            case "reject" :
                include_once  'components/checklist/modle/checklistModule.php';
                if(reject())
                	header('Location: index.php?components=checklist&action=list_checklist1&re=true&message='.$message);
                else
                	header('Location: index.php?components=checklist&action=list_checklist1&re=false&message='.$message);
            break;
            
            case "delete_checklist" :
                include_once  'components/checklist/modle/checklistModule.php';
                if(deleteChecklist())
                	header('Location: index.php?components=checklist&action=list_checklist2&re=true&message='.$message);
                else
                	header('Location: index.php?components=checklist&action=list_checklist2&re=false&message='.$message);
            break;
            
            case "show_checklist" :
                include_once  'components/checklist/modle/checklistModule.php';
	            showCheckList();
	            showApproveComment();
	            include_once  'components/checklist/view/showChecklist.php';
            break;
            
            case "show_approve" :
                include_once  'components/checklist/modle/checklistModule.php';
	            showCheckList();
	            include_once  'components/checklist/view/approveView.php';
            break;

            case "list_checklist" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(0,'other');
		        if($count==1) header('Location: index.php?components=checklist&action=show_approve&id='.$id[0]);
		        else include_once  'components/checklist/view/listChecklist.php';
            break;
            
            case "list_checklist1" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(0,'other');
	            include_once  'components/checklist/view/listChecklist.php';
            break;
            
            case "list_checklist2" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(7,'other');
	            include_once  'components/checklist/view/listChecklist.php';
            break;
            
         }
}else

if($_COOKIE['checklist']==md5('Manager')){
        switch ($_REQUEST['action'])
        {
            case "show" :
				header('Location: index.php?components=checklist&action=list_checklist2');
            break;
            
            case "list_checklist2" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(7,'other');
	            include_once  'components/checklist/view/listChecklist.php';
            break;
         }
}else

if($_COOKIE['checklist']==md5('Auditor')){
        switch ($_REQUEST['action'])
        {
            case "show" :
				header('Location: index.php?components=checklist&action=list_checklist2');
            break;
            
            case "list_checklist2" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listChecklist(7,'other');
	            include_once  'components/checklist/view/listChecklist.php';
            break;
            
         }
}
//---------------------------------------- Default ------------------------------------//
        switch ($_REQUEST['action'])
        {
            //---------------------------REPORTS-----------------------//
            case "list_report" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listYears();
	            include_once  'components/checklist/view/listReport.php';
            break;
            
            case "get_report" :
                include_once  'components/checklist/modle/checklistModule.php';
	            listYears();
	            if($_GET['type']=='device_down') deviceFailure();
	            if($_GET['type']=='cl_missing') missingChecklistt();
	            include_once  'components/checklist/view/listReport.php';
            break;
            
            case "print_report" :
                include_once  'components/checklist/modle/checklistModule.php';
	            companyProfile2();
	            if($_GET['type']=='device_down') deviceFailure();
	            if($_GET['type']=='cl_missing') missingChecklistt();
	            include_once  'components/checklist/view/printReport.php';
            break;
            
            case "print_checklist" :
                include_once  'components/checklist/modle/checklistModule.php';
				companyProfile2();
	            showCheckList();
	            showApproveComment();
	            include_once  'components/checklist/view/printChecklist.php';
	        break;
	        
		}

?>