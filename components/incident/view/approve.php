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
if($_COOKIE['incident']==md5('Submitter'))				print '<li><a href="index.php?components=incident&action=show_submit" ><span>Raise an Incident</span></a></li>';
if($_COOKIE['incident']==md5('Approver'))				print '<li><a href="index.php?components=incident&action=show_approve_list" class="current"><span>Approve</span></a></li>';
                      									print '<li><a href="index.php?components=incident&action=list_list&filter=all"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=incident&action=list_report" ><span>Report</span></a></li>';
 ?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9"><h1 class="incident">Incident Management System</h1>
    </div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
<?php
		if($_GET['action']=='show_approve_list')   include_once  'components/incident/view/tpl/approve_list.php';
		if($_GET['action']=='show_approve_inc')   include_once  'components/incident/view/tpl/approve_inc.php';
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
