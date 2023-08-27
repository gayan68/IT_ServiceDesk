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
  		<form action="index.php?components=inventory&action=update_emp" method="post" onsubmit="return validateEMPUpdate()" >
  		  <input type="hidden" name="emp_id" value="<?php print $_GET['id']; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
				<tr><td width="100px"></td><td><strong>Employee Name</strong></td><td><?php print $emp_name; ?></td></tr>
				<tr><td width="100px"></td><td><strong>Associated Department</strong></td><td>
				<select name="emp_dep" id="emp_dep">
						<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($dep_id);$i++){
						if($emp_department==$dep_id[$i])  $select='selected="selected"'; else $select='';
						print '<option value="'.$dep_id[$i].'" '.$select.'>'.$dep_name[$i].'</option>';
					} ?>
				</select>
				</td></tr>
				<tr><td width="100px"></td><td><strong>Status</strong></td><td>
				<select name="emp_status" id="emp_status">
						<option value="1" <?php if($emp_status==1) print 'selected="selected"'; ?> >Working</option>
						<option value="0" <?php if($emp_status==0) print 'selected="selected"'; ?> >Resigned</option>
				</select>
				</td></tr>
				<tr><td width="100px"></td><td><strong>Resigned Date</strong></td><td><input type="date" name="res_date" id="res_date" value="<?php print $emp_resigned_date; ?>" /></td></tr>
				<tr><td colspan="3" align="center"><input type="submit" value="Update" style="width:100px; height:40px" /></td></tr>
            </thead>
          </table>
   		</form>
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
