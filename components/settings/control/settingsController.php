<?php
if($_COOKIE['type']==md5('appadmin')){
        switch ($_REQUEST['action'])
        {
        //-----------------------General Settings------------------------------//            
            case "settings" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                getGeneralSettings();
                include_once  'components/settings/view/settings.php';
            break;

            case "general_settingsupdate1" :
                include_once  'components/settings/modle/settingsModule.php';
                if(generalSettingsupdate1())
                	header('Location: index.php?components=settings&action=settings&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=settings&re=false&message='.$message);
            break;

            case "general_settingsupdate2" :
                include_once  'components/settings/modle/settingsModule.php';
                if(generalSettingsupdate2())
                	header('Location: index.php?components=settings&action=settings&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=settings&re=false&message='.$message);
            break;
		//-----------------------Module------------------------------//            
            case "module" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                getModule();
                include_once  'components/settings/view/module.php';
            break;
            
            case "general_order_up" :
                include_once  'components/settings/modle/settingsModule.php';
                if(generalOrderUp())
                	header('Location: index.php?components=settings&action=module&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=module&re=false&message='.$message);
            break;
            
            case "general_order_down" :
                include_once  'components/settings/modle/settingsModule.php';
                if(generalOrderDown())
                	header('Location: index.php?components=settings&action=module&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=module&re=false&message='.$message);
            break;
            
            case "general_activate" :
                include_once  'components/settings/modle/settingsModule.php';
                if(generalModuleActivate())
                	header('Location: index.php?components=settings&action=module&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=module&re=false&message='.$message);
            break;
           //-----------------------My Profile------------------------------//
            case "myprofile" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listUser($_COOKIE['user']);
                listEmailSubscription();
                include_once  'components/settings/view/myprofile.php';
            break;
            
            case "userprofile_changepwd2" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileChangePwd())
                	header('Location: index.php?components=settings&action=myprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=myprofile&re=false&message='.$message);
            break;
            
            case "enable_emailalert" :
                include_once  'components/settings/modle/settingsModule.php';
                if(emailSubscription(1))
                	header('Location: index.php?components=settings&action=myprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=myprofile&re=false&message='.$message);
            break;
            
            case "disable_emailalert" :
                include_once  'components/settings/modle/settingsModule.php';
                if(emailSubscription(0))
                	header('Location: index.php?components=settings&action=myprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=myprofile&re=false&message='.$message);
            break;
           //-----------------------User Profiles-----------------------------//
            case "userprofile" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listStandaloneUsers();
                listDomainUsers();
                include_once  'components/settings/view/userprofile.php';
            break;
            
            case "userprofile_createuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileCreateuser())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
			
            case "userprofile_changepwd1" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileChangePwd())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
			
            case "userprofile_edituser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileEdituser())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
			
            case "userprofile_delete" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileDelete())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
			
            case "ad_query" :
                include_once  'components/settings/modle/settingsModule.php';
                print adQuery();
            break;
			
            case "ad_adduser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adAdduser())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
			
            case "ad_deleteuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adDeleteuser())
                	header('Location: index.php?components=settings&action=userprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=userprofile&re=false&message='.$message);
            break;
            
            //------------------Device-----------------------------------//
            case "device" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listDevices();
                include_once  'components/settings/view/devices.php';
            break;
            
            case "device_dev_add" :
                include_once  'components/settings/modle/settingsModule.php';
                if(deviceAdd())
                	header('Location: index.php?components=settings&action=device&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=device&re=false&message='.$message);
            break;
            
            case "device_dev_edit" :
                include_once  'components/settings/modle/settingsModule.php';
                if(deviceEdit())
                	header('Location: index.php?components=settings&action=device&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=device&re=false&message='.$message);
            break;
            
            case "device_decommission" :
                include_once  'components/settings/modle/settingsModule.php';
                if(deviceStatus(0))
                	header('Location: index.php?components=settings&action=device&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=device&re=false&message='.$message);
            break;
            
            case "device_activate" :
                include_once  'components/settings/modle/settingsModule.php';
                if(deviceStatus(1))
                	header('Location: index.php?components=settings&action=device&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=device&re=false&message='.$message);
            break;
            
            case "device_dev_delete" :
                include_once  'components/settings/modle/settingsModule.php';
                if(deviceDelete())
                	header('Location: index.php?components=settings&action=device&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=device&re=false&message='.$message);
            break;
            //------------------Check List-----------------------------------//
            
            case "checklist_general" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listChecklistGeneral();
                include_once  'components/settings/view/checklist.php';
            break;
            
            case "checklist_user" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listChecklistUsers();
                include_once  'components/settings/view/checklist.php';
            break;
            
            case "cl_adduser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adduserAuthorization('checklist'))
                	header('Location: index.php?components=settings&action=checklist_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=checklist_user&re=false&message='.$message);
            break;
            
            case "cl_removeuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(removeuserAuthorization())
                	header('Location: index.php?components=settings&action=checklist_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=checklist_user&re=false&message='.$message);
            break;
            
            case "cl_reopen" :
                include_once  'components/settings/modle/settingsModule.php';
                if(checklistReopen())
                	header('Location: index.php?components=settings&action=checklist_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=checklist_general&re=false&message='.$message);
            break;
            
            case "cl_closetime" :
                include_once  'components/settings/modle/settingsModule.php';
                if(checklistCloseTime())
                	header('Location: index.php?components=settings&action=checklist_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=checklist_general&re=false&message='.$message);
            break;
            
            case "cl_workingdays" :
                include_once  'components/settings/modle/settingsModule.php';
                if(checklistWorkingdays())
                	header('Location: index.php?components=settings&action=checklist_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=checklist_general&re=false&message='.$message);
            break;
            
            
            //--------------------------CMS----------------------------------//
            case "cms_general" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                CMSanaTeam();
                include_once  'components/settings/view/cms.php';
            break;
            
            case "cms_user" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listCMSUsers();
                CMSanaTeam();
                include_once  'components/settings/view/cms.php';
            break;

            case "cms_adduser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adduserAuthorization('cms'))
                	header('Location: index.php?components=settings&action=cms_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=cms_user&re=false&message='.$message);
            break;
            
            case "cms_removeuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(removeuserAuthorization())
                	header('Location: index.php?components=settings&action=cms_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=cms_user&re=false&message='.$message);
            break;
            
            case "cms_addteam" :
                include_once  'components/settings/modle/settingsModule.php';
                if(cmsAddTeam())
                	header('Location: index.php?components=settings&action=cms_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=cms_general&re=false&message='.$message);
            break;
            
            case "cms_editteam" :
                include_once  'components/settings/modle/settingsModule.php';
                if(cmsEditTeam())
                	header('Location: index.php?components=settings&action=cms_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=cms_general&re=false&message='.$message);
            break;
            
            case "cms_deleteteam" :
                include_once  'components/settings/modle/settingsModule.php';
                if(cmsDeleteTeam())
                	header('Location: index.php?components=settings&action=cms_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=cms_general&re=false&message='.$message);
            break;
            //--------------------------Incident----------------------------------//
            case "incident_general" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                incidentGeneral();
                include_once  'components/settings/view/incident.php';
            break;
            
            case "incident_user" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listIncidentUsers();
                include_once  'components/settings/view/incident.php';
            break;
            
            case "inc_adduser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adduserAuthorization('incident'))
                	header('Location: index.php?components=settings&action=incident_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=incident_user&re=false&message='.$message);
            break;
            
            case "inc_removeuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(removeuserAuthorization())
                	header('Location: index.php?components=settings&action=incident_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=incident_user&re=false&message='.$message);
            break;
            
            case "incident_addcategory" :
                include_once  'components/settings/modle/settingsModule.php';
                if(incidentAddcategory())
                	header('Location: index.php?components=settings&action=incident_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=incident_general&re=false&message='.$message);
            break;
            
            case "incident_editcategory" :
                include_once  'components/settings/modle/settingsModule.php';
                if(incidentEditcategory())
                	header('Location: index.php?components=settings&action=incident_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=incident_general&re=false&message='.$message);
            break;
            
            case "inc_delete_category" :
                include_once  'components/settings/modle/settingsModule.php';
                if(incidentDeletecategory())
                	header('Location: index.php?components=settings&action=incident_general&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=incident_general&re=false&message='.$message);
            break;
            
            //--------------------------Inventory----------------------------------//
            case "inventory_user" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listInventoryUsers();
                include_once  'components/settings/view/inventory.php';
            break;
            
            case "inv_adduser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(adduserAuthorization('inventory'))
                	header('Location: index.php?components=settings&action=inventory_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=inventory_user&re=false&message='.$message);
            break;
            
            case "inv_removeuser" :
                include_once  'components/settings/modle/settingsModule.php';
                if(removeuserAuthorization())
                	header('Location: index.php?components=settings&action=inventory_user&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=inventory_user&re=false&message='.$message);
            break;
            //--------------------------Common----------------------------------//
            
            case "alluser_query" :
                include_once  'components/settings/modle/settingsModule.php';
                print adQuery2();
            break;

        }
}else{
        switch ($_REQUEST['action']){
            case "settings" :
                	header('Location: index.php?components=settings&action=myprofile');
            break;
            
            case "myprofile" :
                include_once  'components/settings/modle/settingsModule.php';
                listModuleMenu();
                listUser($_COOKIE['user']);
                listEmailSubscription();
                include_once  'components/settings/view/myprofile.php';
            break;
            
            case "userprofile_changepwd2" :
                include_once  'components/settings/modle/settingsModule.php';
                if(userprofileChangePwd())
                	header('Location: index.php?components=settings&action=myprofile&re=true&message='.$message);
                else
                	header('Location: index.php?components=settings&action=myprofile&re=false&message='.$message);
            break;
        }
}
?>