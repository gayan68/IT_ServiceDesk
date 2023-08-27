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
                      									print '<li><a href="index.php?components=cms&action=list_list&filter=all" ><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=cms&action=list_report" class="current"><span>Reports</span></a></li>';
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
    <h1 class="cms">Change Management System</h1>
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
	<td><select name="report_type" id="report_type" onchange="getReport('cms')" >
	<option value="">-SELECT-</option>
	<option value="all" <?php if(isset($_GET['type'])) if($_GET['type']=='all') print 'selected="selected"'; ?>>ALL CRs</option>
	<option value="pending" <?php if(isset($_GET['type'])) if($_GET['type']=='pending') print 'selected="selected"'; ?>>Pending CRs</option>
	<option value="rejected" <?php if(isset($_GET['type'])) if($_GET['type']=='rejected') print 'selected="selected"'; ?>>Rejected CRs</option>
	<option value="imp_fail" <?php if(isset($_GET['type'])) if($_GET['type']=='imp_fail') print 'selected="selected"'; ?>>Implementation Failed CRs</option>
	<option value="imp_success" <?php if(isset($_GET['type'])) if($_GET['type']=='imp_success') print 'selected="selected"'; ?>>Successfully Completed CRs</option>
	<option value="top_changes" <?php if(isset($_GET['type'])) if($_GET['type']=='top_changes') print 'selected="selected"'; ?>>Top Changes by Device</option>
	<option value="by_device" <?php if(isset($_GET['type'])) if($_GET['type']=='by_device') print 'selected="selected"'; ?>>CR By Device</option>
	</select>
	</td><td width="10px"></td><td width="120px">Year: </td>
	<td><select name="year" id="year"  <?php if(isset($_GET['year'])){ if($_GET['type']=='by_device'){ ?> onchange="getReport2('cms','all')" <?php }else{ ?> onchange="getReport('cms')" <?php }}else{ ?> onchange="getReport('cms')" <?php } ?>>
	<option value="">-SELECT-</option>
	<option value="all" <?php if(isset($_GET['year'])) if($_GET['year']=='all') print 'selected="selected"'; ?> >ALL</option>
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
		if($_GET['action']=='list_report')   include_once  'components/cms/view/tpl/list_report.php';
		if($_GET['action']=='get_report'){
			if($_GET['type']=='by_device')	include_once  'components/cms/view/tpl/show_report_dev.php'; else
			if($_GET['type']=='top_changes')	include_once  'components/cms/view/tpl/show_report_count_dev.php';	else
				include_once  'components/cms/view/tpl/show_report.php';
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
