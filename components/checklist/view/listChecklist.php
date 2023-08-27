<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
</div>
<div class="grid_16">
<!-- TABS START -->
    <div id="tabs">
         <div class="container">
         <?php if($_GET['action']=='list_checklist2'){ $select1=''; $select2='class="current"'; }else{ $select1='class="current"'; $select2=''; } ?>
            <ul>
<?php                    
if($_COOKIE['checklist']==md5('Submiter'))		print '<li><a href="index.php?components=checklist&action=show"><span>Fill Checklist</span></a></li>';
if($_COOKIE['checklist']==md5('Approver'))		print '<li><a href="index.php?components=checklist&action=list_checklist" '.$select1.'><span>Approve Checklist</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_checklist2" '.$select2.'><span>View Checklists</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_report"><span>Reports</span></a></li>';
 ?>
           </ul>
        </div>
    </div>
<!-- TABS END -->   
</div>
<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="checklist">Morning IT Infastructure Check List</h1>
    </div>
    <?php
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='success'; else $color='error';
    		print '<p class="info" id="'.$color.'" style="margin-right:10px"><span class="info_inner">'.$_GET['message'].'</span></p>';
    	}
    ?>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
 <?php if($count[0]==0){ ?>
    <div id="portlets">
</div>
<br />
<table width="100%">
<?php
if($_GET['action']=='list_checklist2'){
	for($i=0;$i<sizeof($id);$i++){
		if($_COOKIE['checklist']==md5('Submiter')){
			if(($cl_status[$i]=='Pending')||($cl_status[$i]=='Rejected')) $action1='show_edit'; else $action1='show_checklist';
		}else{
			if($cl_status[$i]=='Pending') $action1='show_approve'; else $action1='show_checklist';
		}
		print '<tr><td width="20%"></td><td height="35px" align="center"><a style="font-size:12pt; font-weight:bold" href="index.php?components=checklist&action='.$action1.'&id='.$id[$i].'">'.$date[$i].'</a></td><td valign="bottom"><img width="45px" src="images/'.$img[$i].'" /></td><td width="20%"></td></tr>';
	}
}else{
	for($i=0;$i<sizeof($id);$i++){
		print '<tr><td height="35px" align="center"><a style="font-size:12pt; font-weight:bold" href="index.php?components=checklist&action=show_approve&id='.$id[$i].'">'.$date[$i].'</a></td></tr>';
	}
}
?>
</table>
	
 <?php } ?>

    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: <?php print $height; ?>px">
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
