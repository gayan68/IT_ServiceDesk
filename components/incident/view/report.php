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
if($_COOKIE['incident']==md5('Submitter'))				print '<li><a href="index.php?components=incident&action=show_submit"><span>Raise an Incident</span></a></li>';
if($_COOKIE['incident']==md5('Approver'))				print '<li><a href="index.php?components=incident&action=show_approve_list" ><span>Approve</span></a></li>';
                      									print '<li><a href="index.php?components=incident&action=list_list&filter=all" ><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=incident&action=list_report" class="current"><span>Report</span></a></li>';
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
    <h1 class="incident">Incident Management System</h1>
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
	<tr><td width="50px"></td><td  width="100px">Report Type: </td>
	<td><select name="report_type" id="report_type" onchange="getReport('incident')" >
	<option value="">-SELECT-</option>
	<option value="all" <?php if(isset($_GET['type'])) if($_GET['type']=='all') print 'selected="selected"'; ?>>ALL Incidents</option>
	<option value="pending" <?php if(isset($_GET['type'])) if($_GET['type']=='pending') print 'selected="selected"'; ?>>Pending Incidents</option>
	<option value="approved" <?php if(isset($_GET['type'])) if($_GET['type']=='approved') print 'selected="selected"'; ?>>Approved Incidents</option>
	<option value="rejected" <?php if(isset($_GET['type'])) if($_GET['type']=='rejected') print 'selected="selected"'; ?>>Rejected Incidents</option>
	<option value="top_incidents" <?php if(isset($_GET['type'])) if($_GET['type']=='top_incidents') print 'selected="selected"'; ?>>Top Incidents by Device</option>
	<option value="by_device" <?php if(isset($_GET['type'])) if($_GET['type']=='by_device') print 'selected="selected"'; ?>>Incidents By Device</option>
	</select>
	</td><td width="10px"></td><td width="120px">Year: </td>
	<td><select name="year" id="year" onchange="getReport('incident')" >
	<option value="">-SELECT-</option>
	<?php
		for($i=0;$i<sizeof($years);$i++){
			$select0='';
			if(isset($_GET['year'])) if($_GET['year']==$years[$i]) $select0='selected="selected"';
			print '<option value="'.$years[$i].'" '.$select0.'>'.$years[$i].'</option>';
		}
	
	?>
	</select>
	</td><td width="100px"></td></tr>
</table>
 

<?php
		if($_GET['action']=='list_report')   include_once  'components/incident/view/tpl/list_report.php';
		if($_GET['action']=='get_report'){
			if($_GET['type']=='by_device')	include_once  'components/incident/view/tpl/show_report_dev.php'; else
			if($_GET['type']=='top_incidents')	include_once  'components/incident/view/tpl/show_report_count_dev.php';	else
			if($_GET['type']=='relation_inc')   include_once  'components/incident/view/tpl/show_report_relation.php'; else
				include_once  'components/incident/view/tpl/show_report.php';
		}
		
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
