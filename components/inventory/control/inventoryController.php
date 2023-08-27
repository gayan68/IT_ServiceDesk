<?php
//-------------------------------------Inventory Submitter------------------------------------//
if($_COOKIE['inventory']==md5('Submitter')){
        switch ($_REQUEST['action'])
        {
            case "show" :
                header('Location: index.php?components=inventory&action=show_submit');
            break;
            
            case "show_submit" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssLocation();
                getAssType();
                getAssStatus();
                getFormData();
                include_once  'components/inventory/view/view.php';
            break;
            
            case "edit_asset" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssStatus();
                getAssLocation();
                getAssType();
                getFormData();
                oneAsset();
                include_once  'components/inventory/view/view.php';
            break;
            
            case "ad_query" :
                include_once  'components/inventory/modle/inventoryModule.php';
                print adQuery();
            break;
            
            case "asset_query" :
                include_once  'components/inventory/modle/inventoryModule.php';
                print assetQuery();
            break;
            
            case "create_asset" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(createAsset())
                	header('Location: index.php?components=inventory&action=show_submit&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=show_submit&re=false&message='.$message);
            break;
            
            case "update_asset" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(updateAsset())
                	header('Location: index.php?components=inventory&action=edit_asset&id='.$id.'&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=edit_asset&id='.$id.'&re=false&message='.$message);
            break;
            
            case "update_asset2" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(updateAsset2())
                	header('Location: index.php?components=inventory&action=one_asset&&id='.$id.'&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=one_asset&id='.$id.'&re=false&message='.$message);
            break;
            
            case "map_asset" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(mapAsset())
                	header('Location: index.php?components=inventory&action=show_submit&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=show_submit&re=false&message='.$message);
            break;
            
            case "remove_mapping" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(removeAsset())
                	header('Location: index.php?components=inventory&action=show_submit&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=show_submit&re=false&message='.$message);
            break;
            
            case "delete_mapping" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(deleteMapping())
                	header('Location: index.php?components=inventory&action=one_asset&id='.$ass_id.'&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=one_asset&id='.$ass_id.'&re=false&message='.$message);
            break;
            
            case "list_list" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssStatus();
                getAssLocation();
                getAssetList();
                include_once  'components/inventory/view/list.php';
            break;
            
            case "download_list" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssetList();
              	downloadList();
				require_once ('plugin/PHPExcel-1.8/production/Inventory.php');
            break;
            
            case "one_asset" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssLocation();
                getAssType();
                getAssStatus();
                getAssetDetails();
                include_once  'components/inventory/view/one_asset.php';
            break;
            
            case "emp_mgmt" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getEmpData();
                getDepartments();
                include_once  'components/inventory/view/emp_mgmt.php';
            break;
            
            case "update_emp" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(updateEmpData())
                	header('Location: index.php?components=inventory&action=emp_mgmt&id='.$emp_id.'&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=emp_mgmt&id='.$emp_id.'&re=false&message='.$message);
            break;
        //-----------------------Toner---------------------------------------//
            case "toner_manage" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssLocation();
              	getTonerList();
                include_once  'components/inventory/view/toner_manage.php';
            break;
            
            case "show_edit_toner_name" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssLocation();
              	getTonerList();
              	getOneToner();
                include_once  'components/inventory/view/toner_manage.php';
            break;
            
            case "toner_usage" :
                include_once  'components/inventory/modle/inventoryModule.php';
                getAssLocation();
              	getTonerList();
              	getTonerUtilization();
                include_once  'components/inventory/view/toner_usage.php';
            break;
            
            case "toner_report" :
                include_once  'components/inventory/modle/inventoryModule.php';
                tonerReport();
                include_once  'components/inventory/view/toner_report.php';
            break;
            
            case "add_toner_name" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(addTonerName())
                	header('Location: index.php?components=inventory&action=toner_manage&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=toner_manage&re=false&message='.$message);
            break;
            
            case "edit_toner_name" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(editTonerName())
                	header('Location: index.php?components=inventory&action=toner_manage&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=toner_manage&re=false&message='.$message);
            break;
            
            case "delete_toner_name" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(deleteTonerName())
                	header('Location: index.php?components=inventory&action=toner_manage&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=toner_manage&re=false&message='.$message);
            break;
            
            case "add_toner_inventory" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(addTonerInventory())
                	header('Location: index.php?components=inventory&action=toner_manage&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=toner_manage&re=false&message='.$message);
            break;
            
            case "allocate_toner" :
                include_once  'components/inventory/modle/inventoryModule.php';
                if(allocateToner())
                	header('Location: index.php?components=inventory&action=toner_usage&re=true&message='.$message);
                else
                	header('Location: index.php?components=inventory&action=toner_usage&re=false&message='.$message);
            break;
            
            case "update_toner_price" :
                include_once  'components/inventory/modle/inventoryModule.php';
                print updateTonerPrice();
            break;
        }
 }
?>