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
if($_COOKIE['checklist']==md5('Submiter'))		print '<li><a href="index.php?components=checklist&action=show"><span>Fill Checklist</span></a></li>';
if($_COOKIE['checklist']==md5('Approver'))		print '<li><a href="index.php?components=checklist&action=list_checklist"><span>Approve Checklist</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_checklist2"><span>View Checklists</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_report" class="current"><span>Reports</span></a></li>';
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
<table width="100%">
	<tr><td width="50px"></td><td  width="100px">
	Report Type: <select name="report_type" id="report_type" onchange="getReport('checklist')" >
	<option value="">-SELECT-</option>
	<option value="device_down">Device Failures</option>
	<option value="cl_missing">Missing Checklists</option>
	</select>
	</td><td width="10px"></td><td width="120px">
	Year: <select name="year" id="year" onchange="getReport('checklist')" >
	<option value="">-SELECT-</option>
	<?php
		for($i=0;$i<sizeof($years);$i++){
			print '<option value="'.$years[$i].'">'.$years[$i].'</option>';
		}
	
	?>
	</select>
	</td><td width="100px"></td></tr>
</table>
 
<!-- #PORTLETS START -->
<?php
	if($_GET['action']=='get_report'){
		if($_GET['type']=='device_down') include_once  'components/checklist/view/tpl/device_failures.php';
		if($_GET['type']=='cl_missing') include_once  'components/checklist/view/tpl/cl_missing.php';
	}
	if(isset($_GET['type']))
	print '<br /><table width="100%"><tr><td width="100%" style="text-align:center"><a target="_blank" href="index.php?components=checklist&action=print_report&type='.$_GET['type'].'&year='.$_GET['year'].'" ><img border="0" src="images/print.jpg" /></a></td></tr></table>';
?>
<!--  END #PORTLETS -->

<br />
	

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
