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
if($_COOKIE['incident']==md5('Submitter'))				print '<li><a href="index.php?components=incident&action=show_submit" class="current"><span>Raise an Incident</span></a></li>';
if($_COOKIE['incident']==md5('Approver'))				print '<li><a href="index.php?components=incident&action=show_approve_list" ><span>Approve</span></a></li>';
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
<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Incident Submission Form</div>
		<div class="portlet-content nopadding">
  <form method="post" action="index.php?components=incident&action=add_incident" enctype="multipart/form-data" onsubmit="return validateIncidentForm()" >
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Affected System</td><td style="vertical-align:middle">
				<select name="system" id="system">
					<option value="">-SELECT-</option>
		<?php for($i=0;$i<sizeof($dev_id);$i++)
				print '<option value="'.$dev_id[$i].'">'.$dev_name[$i].'</option>';
		?>
					<option value="99999">Other</option>
				</select>
			</td><td width="50px"></td><td style="vertical-align:middle"><div id="div1">Impact Severity</div></td><td>
				<select name="severity" id="severity">
					<option value="">-SELECT-</option>
					<option value="1">Critical</option>
					<option value="2">High</option>
					<option value="3">Medium</option>
					<option value="4">Low</option>
				</select>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Incident Category</td><td style="vertical-align:middle">
				<select name="category" id="category">
					<option value="">-SELECT-</option>
		<?php for($i=0;$i<sizeof($cat_id);$i++)
				print '<option value="'.$cat_id[$i].'">'.$cat_name[$i].'</option>';
		?>
				</select>
			</td><td width="50px"></td><td style="vertical-align:middle">Occured Date</td><td style="vertical-align:middle">
				<input type="date" name="occured_date" id="app_date" />			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Title</td><td colspan="4"><input type="text" name="title" id="title" style="width:100%" /></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Impact Description <br /><textarea name="description" id="description" rows="6" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5" align="center"><input type="submit" value="Submit Incident Report" style="height:40px; width:200px" /></td><td width="50px"></td></tr>
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
