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
if($_COOKIE['cmsRequester']==md5('Requester'))			print '<li><a href="index.php?components=cms&action=show_requestcr" class="current"><span>Raise A Change Request</span></a></li>';
if($_COOKIE['cmsAnalysis']==md5('Analysis'))			print '<li><a href="index.php?components=cms&action=show_analyse_list" ><span>Analyse Change Request</span></a></li>';
if($_COOKIE['cmsApprover']==md5('Approver'))			print '<li><a href="index.php?components=cms&action=show_approve_list" ><span>Approve Change Request</span></a></li>';
if($_COOKIE['cmsImplementer']==md5('Implementer'))		print '<li><a href="index.php?components=cms&action=show_implement_list"><span>Implement Change Request</span></a></li>';
                      									print '<li><a href="index.php?components=cms&action=list_list&filter=all"><span>List</span></a></li>';
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
<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> New Change Request</div>
		<div class="portlet-content nopadding">
  <form method="post" action="index.php?components=cms&action=add_request" enctype="multipart/form-data" onsubmit="return validateCMSRequest()" >
  <div id="system_list1_div"><input type="hidden" id="system_list1" name="system_list1" value="" /></div>
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Type Of System</td><td style="vertical-align:middle"><select name="system_type" id="system_type" onchange="changeSystemType()"><option value="">-SELECT-</option><option value="1">New System</option><option value="2">Existing System</option></select></td><td colspan="4"></td>
			<tr><td width="50px"></td><td style="vertical-align:middle"><div id="div1" >Name Of the System</div></td><td>
			<input type="hidden" id="temp" />
			<div id="systemname">
				<select name="system_name" id="system_name" onchange="addSystem()">
					<option value="">-SELECT-</option>
		<?php for($i=0;$i<sizeof($dev_id);$i++)
				print '<option value="'.$dev_id[$i].','.$dev_name[$i].'" >'.$dev_name[$i].'</option>';
		?>
				</select>
			</div>
			</td><td width="50px"></td><td colspan="3"><div id="system_list"></div></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">CR Title</td><td><input type="text" name="cr_title" id="cr_title" /></td><td width="50px"></td><td style="vertical-align:middle">Request Priority</td><td>
				<select name="cr_priority" id="cr_priority">
					<option value="">-SELECT-</option>
					<option value="1">Critical</option>
					<option value="2">High</option>
					<option value="3">Medium</option>
					<option value="4">Low</option>
				</select>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Required Date</td><td><input type="date" name="cr_rq_date" id="app_date" />
			</td><td width="50px"></td><td style="vertical-align:middle">Impact Analysis Team</td><td>
				<select name="ana_team" id="ana_team">
					<option value="">-SELECT-</option>
		<?php for($i=0;$i<sizeof($team_id);$i++)
				print '<option value="'.$team_id[$i].'">'.$team_name[$i].'</option>';
		?>
				</select>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Request Description <br /><textarea name="cr_description" id="cr_description" rows="5" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Business Case <br /><textarea name="cr_bisscase" id="cr_bisscase" rows="5" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Attachements : If you have any aditional attahcments related to this Change Request, Please attache them <br />&nbsp;
			Attachment 1: <input type="file" name="attachment1" id="attachment1">Attachment 2: <input type="file" name="attachment2" id="attachment2"></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5" align="center"><input type="submit" value="Submit Change Request" style="height:40px; width:200px" /></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
      </div>

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
