<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
            <ul>
<?php                    
if($_COOKIE['cmsRequester']==md5('Requester'))			print '<li><a href="index.php?components=cms&action=show_requestcr" ><span>Raise A Change Request</span></a></li>';
if($_COOKIE['cmsAnalysis']==md5('Analysis'))			print '<li><a href="index.php?components=cms&action=show_analyse_list" ><span>Analyse Change Request</span></a></li>';
if($_COOKIE['cmsApprover']==md5('Approver'))			print '<li><a href="index.php?components=cms&action=show_approve_list" ><span>Approve Change Request</span></a></li>';
if($_COOKIE['cmsImplementer']==md5('Implementer'))		print '<li><a href="index.php?components=cms&action=show_implement_list"><span>Implement Change Request</span></a></li>';
                      									print '<li><a href="index.php?components=cms&action=list_list&filter=all" class="current"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=cms&action=list_report"><span>Reports</span></a></li>';
 ?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9" style="width:100%"><table><tr><td width="500px"><h1 class="cms">Change Management System</h1></td><td width="170px"></td><td>Search : </td>
    <td><input type="text" name="search" id="search" placeholder="Search by CR ID" class="smallInput" /> </td><td style="vertical-align:middle"><a href="#" onclick="Search('cms')" ><img src="images/search.png" /></a></td></table>
    </div><div class="clear"></div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
<?php
		if($_GET['action']=='list_list')   include_once  'components/cms/view/tpl/list_list.php';
		if($_GET['action']=='list_search')   include_once  'components/cms/view/tpl/list_list.php';
		if($_GET['action']=='list_cr')   include_once  'components/cms/view/tpl/list_cr.php';
?>
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 30px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
      <!--THIS IS A PORTLET-->        
 
      <!--THIS IS A PORTLET--> 

                        
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
