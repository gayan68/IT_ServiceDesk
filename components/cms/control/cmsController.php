<?php
//-------------------------------------CR Implementer------------------------------------//
if($_COOKIE['cmsImplementer']==md5('Implementer')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=cms&action=show_implement_list');
            break;

            case "show_implement_list" :
                include_once  'components/cms/modle/cmsModule.php';
                listCr(4);
                include_once  'components/cms/view/implementerView.php';
            break;
            
            case "show_implement_cr" :
                include_once  'components/cms/modle/cmsModule.php';
                getCr();
                getAna();
                getApprove();
                include_once  'components/cms/view/implementerView.php';
            break;
            
            case "add_implement" :
                include_once  'components/cms/modle/cmsModule.php';
                include_once  'components/settings/modle/email.php';
                if(addImplement())
                	header('Location: index.php?components=cms&action=show_implement_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=cms&action=show_implement_list&re=false&message='.$message);
            break;
		}
}

//-------------------------------------CR Approver------------------------------------//
if($_COOKIE['cmsApprover']==md5('Approver')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=cms&action=show_approve_list');
            break;

            case "show_approve_list" :
                include_once  'components/cms/modle/cmsModule.php';
                listCr(2);
                include_once  'components/cms/view/approverView.php';
            break;
            
            case "show_approve_cr" :
                include_once  'components/cms/modle/cmsModule.php';
                getCr();
                getAna();
                include_once  'components/cms/view/approverView.php';
            break;
            
            case "approve" :
                include_once  'components/cms/modle/cmsModule.php';
                include_once  'components/settings/modle/email.php';
                if(approveCMS('approve'))
                	header('Location: index.php?components=cms&action=show_approve_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=cms&action=show_approve_list&re=false&message='.$message);
            break;
            
            case "reject" :
                include_once  'components/cms/modle/cmsModule.php';
                include_once  'components/settings/modle/email.php';
                if(approveCMS('reject'))
                	header('Location: index.php?components=cms&action=show_approve_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=cms&action=show_approve_list&re=false&message='.$message);
            break;
		}
}

//-------------------------------------CR Analyser------------------------------------//
if($_COOKIE['cmsAnalysis']==md5('Analysis')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=cms&action=show_analyse_list');
            break;

            case "show_analyse_list" :
                include_once  'components/cms/modle/cmsModule.php';
                listAna();
                include_once  'components/cms/view/analysisView.php';
            break;
            
            case "show_analyse_cr" :
                include_once  'components/cms/modle/cmsModule.php';
                getCr();
                getImplementer();
                include_once  'components/cms/view/analysisView.php';
            break;
            
            case "add_analyze" :
                include_once  'components/cms/modle/cmsModule.php';
                include_once  'components/settings/modle/email.php';
                if(addAnalyze())
                	header('Location: index.php?components=cms&action=show_analyse_list&re=true&message='.$message);
                else
                	header('Location: index.php?components=cms&action=show_analyse_list&re=false&message='.$message);
            break;
		}
}

//-------------------------------------CR Requester------------------------------------//
if($_COOKIE['cmsRequester']==md5('Requester')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=cms&action=show_requestcr');
            break;

            case "show_requestcr" :
                include_once  'components/cms/modle/cmsModule.php';
                getCRFormData();
                include_once  'components/cms/view/requesterView.php';
            break;
            
            case "add_request" :
                include_once  'components/cms/modle/cmsModule.php';
                include_once  'components/settings/modle/email.php';
                if(addRequest())
                	header('Location: index.php?components=cms&action=show_requestcr&re=true&message='.$message);
                else
			header('Location: index.php?components=cms&action=show_requestcr&re=false&message='.$message);
            break;
		}
}

//---------------------------------------- Default ------------------------------------//
        switch ($_REQUEST['action'])
        {
            
            case "list_list" :
                include_once  'components/cms/modle/cmsModule.php';
                listAll();
                include_once  'components/cms/view/list.php';
            break;
            
            case "list_search" :
                include_once  'components/cms/modle/cmsModule.php';
                listSearch();
                include_once  'components/cms/view/list.php';
            break;
            
            case "list_cr" :
                include_once  'components/cms/modle/cmsModule.php';
                getCr();
                getAna();
                getApprove();
                getImp();
                $deleteAllow=deleteAllow($_GET['id']);
                include_once  'components/cms/view/list.php';
            break;
            
            case "print_cms" :
                include_once  'components/cms/modle/cmsModule.php';
	            companyProfile2();
                getCr();
                getAna();
                getApprove();
                getImp();
                include_once  'components/cms/view/printCMS.php';
            break;
            
            case "delete_cms" :
                include_once  'components/cms/modle/cmsModule.php';
                if(deleteCMS())
                	header('Location: index.php?components=cms&action=list_list&filter=all&re=true&message='.$message);
                else
                	header('Location: index.php?components=cms&action=list_list&filter=all&re=false&message='.$message);
            break;
            
            case "list_report" :
                include_once  'components/cms/modle/cmsModule.php';
	            listYears();
                include_once  'components/cms/view/report.php';
            break;
            
            case "get_report" :
                include_once  'components/cms/modle/cmsModule.php';
	            listYears();
	            if($_GET['type']=='all') cmsStaus('all');
	            if($_GET['type']=='pending') cmsStaus('pending');
	            if($_GET['type']=='rejected') cmsStaus(3);
	            if($_GET['type']=='imp_fail') cmsStaus(5);
	            if($_GET['type']=='imp_success') cmsStaus(6);
	            if($_GET['type']=='top_changes') reportDeviceBase();
	            if($_GET['type']=='by_device'){ getCRFormData(); 
	            reportOneDevice($_GET['filter']); }
                include_once  'components/cms/view/report.php';
            break;
		}

?>