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
														print '<li><a href="index.php?components=inventory&action=show_submit"><span>Home</span></a></li>';
														print '<li><a href="index.php?components=inventory&action=list_list&filter_type=1&filter_status=1"><span>List</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=one_asset" class="current" ><span>Asset Details</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_manage" ><span>Toner Manage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_usage" ><span>Toner Usage</span></a></li>';
                      									print '<li><a href="index.php?components=inventory&action=toner_report" ><span>Toner Report</span></a></li>';

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
    <h1 class="inventory">Inventory Management System</h1>
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
    <!--THIS IS A WIDE PORTLET-->
<br />
  
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="List Of Assets" /> Asset Details </div>
		<div class="portlet-content nopadding">
  		<form action="index.php?components=inventory&action=update_asset2" method="post" >
		  <?php if(isset($_GET['id'])) print '<input type="hidden" name="id" value="'.$_GET['id'].'" />'; ?>
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
				<tr><td><strong>Asset ID</strong></td><td><?php print $tb1_ass_assetid; ?></td><td width="50px"></td>
				<td><strong>Asset Name</strong></td><td><?php print $tb1_ass_name; ?></td><td width="50px"></td>
				<td><strong>Asset Type</strong></td><td>
				<select name="ass_type" id="ass_type">
					<?php for($i=0;$i<sizeof($ass_type_id);$i++){
						if($tb1_ass_type==$ass_type_id[$i])  $select='selected="selected"'; else $select='';
						print '<option value="'.$ass_type_id[$i].'" '.$select.'>'.$ass_type_name[$i].'</option>';
					} ?>
				</select>
				</td></tr>
				<tr><td><strong>Serial Number</strong></td><td><?php print $tb1_ass_sn; ?></td><td width="50px"></td>
				<td><strong>Asset Location</strong></td><td>
				<select name="ass_location" id="ass_location">
					<?php for($i=0;$i<sizeof($ass_location_id);$i++){
						if($tb1_ass_loc==$ass_location_id[$i])  $select='selected="selected"'; else $select='';
						print '<option value="'.$ass_location_id[$i].'" '.$select.'>'.$ass_location_name[$i].'</option>';
					} ?>
				</select>
				</td><td width="50px"></td>
				<td><strong>Asset Status</strong></td><td>
				<select name="ass_status" id="ass_status">
					<?php for($i=0;$i<sizeof($ast_id);$i++){
						if($tb1_ass_status==$ast_id[$i])  $select='selected="selected"'; else $select='';
						print '<option value="'.$ast_id[$i].'" '.$select.'>'.$ast_status[$i].'</option>';
					} ?>
				</select>
				</td></tr>
				<tr><td>Comment</td><td colspan="7" align="center"><textarea name="asset_comment" style="width:90%"><?php print $tb1_ass_comment; ?></textarea></td></tr>
				<tr><td colspan="8" align="center"> <?php if(isset($_GET['id'])) print '<input type="submit" value="Update" />'; ?></td></tr>
            </thead>
          </table>
          <br><hr>
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
				<tr><th scope="col" style="text-align:center">Purchased</th><th scope="col" style="text-align:center">Sold/Canceled</th><th scope="col" style="text-align:center">Record Added</th></tr>
        		<tr><td scope="col" style="text-align:center"><?php print $tb1_ass_pudate; ?></td><td scope="col" style="text-align:center"><?php print $tb1_ass_sodate; ?></td><td scope="col" style="text-align:center"><?php print $tb1_ass_addeddate; ?></td></tr>
        		<tr><td scope="col"></td><td scope="col"></td><td scope="col" style="text-align:center"><?php print $tb1_ass_addedby; ?></td></tr>
            </thead>
          </table>
   		</form>
		</div>
      </div>
      
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Asset Allocation History </div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
			<tr><th scope="col" >Employee</th><th scope="col">Emp Status</th><th scope="col">Assigned Date</th><th scope="col">Assigned By</th><th scope="col">Removed Date</th><th scope="col">Removed By</th><th></th></tr>
		<?php for($i=0;$i<sizeof($tb2_asi_id);$i++){
		if($tb2_asi_asistatus[$i]==0){ 
			$color1='style="color:silver"';
			$button1='<input type="button" onclick="assetDeleteMapping('."'$tb2_asi_id[$i]','".$_GET['id']."'".')" value="Delete" />';
		}else{
			$color1='';
			$button1='<input type="button" onclick="assetRemoveMapping('.$tb2_asi_id[$i].')" value="Unassign" />';
		}
		if($tb2_emp_empstatus[$i]=='1') $emp_service='Working'; else $emp_service='Resigned'; 
			print '<tr><td scope="col" '.$color1.'>'.$tb2_emp_name[$i].'</td><td scope="col" '.$color1.'><a href="index.php?components=inventory&action=emp_mgmt&id='.$tb2_emp_id[$i].'" title="'.$tb2_emp_resigneddate[$i].'">'.$emp_service.'</a></td><td scope="col" '.$color1.'>'.$tb2_asi_assigneddate[$i].'</td><td scope="col" '.$color1.'>'.$tb2_asi_assignedby[$i].'</td><td scope="col" '.$color1.'>'.$tb2_asi_removeddate[$i].'</td><td scope="col" '.$color1.'>'.$tb2_asi_removedby[$i].'</td><td scope="col" >'.$button1.'</td></tr>';
		} ?>
            </thead>
		</table>
		</div>
      </div>
      </div>      
      <div class="column" id="left" style="height: 30px"> </div>
      <div class="column">  </div>
    <div class="clear"></div>
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
