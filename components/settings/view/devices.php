 <?php
                include_once  'template/header.php';
?>
<!-- MENU END -->

</div>
<!---------Sub Menu----------->
<?php include_once  'components/settings/view/tpl/sub_menu.php';	?>

<!-- CONTENT START -->
    <div class="grid_16" id="content">
    <!--  TITLE START  --> 
    <div class="grid_9">
    <h1 class="user_profile">Device Management</h1>
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
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 10px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
<?php if(!isset($_GET['sub'])){ ?>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Add Devices</div>
		<div class="portlet-content nopadding">
        <form method="post" action="index.php?components=settings&action=device_dev_add" onsubmit="return validateDev1()">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Device Name </td><td><input type="text" name="dname" id="dname" /></td><td width="50px"></td><td style="vertical-align:middle">Device Type </td><td>
			<select name="dtype" id="dtype">
				<option value="">-SELECT-</option>
				<option value="1">Server</option>
				<option value="2">Network Device</option>
				<option value="3">Application</option>
				<option value="4">Other</option>
			</select>
			</td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Primary IP </td><td><input type="text" name="dip1" id="dip1" /></td><td width="50px"></td><td style="vertical-align:middle">Secondary IP </td><td><input type="text" name="dip2" id="dip2" /></td></tr>
          	<tr><td colspan="6" align="center"><input type="submit" value="Create" style="width:100px; height:30px;" /></td></tr>
          </table>
        </form>
		</div>
      </div>
<?php } ?>
<!--  END #PORTLETS --> 	
<?php
if(isset($_GET['sub'])){
	if($_GET['sub']=='edit_dev'){
?>
<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Edit Devices</div>
		<div class="portlet-content nopadding">
        <form method="post" action="index.php?components=settings&action=device_dev_edit" onsubmit="return validateDev1()">
	        <input type="hidden" name="id" value="<?php print $_GET['id']; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Device Name </td><td><input type="text" name="dname" id="dname" value="<?php print $dev3_name; ?>" /></td><td width="50px"></td><td style="vertical-align:middle">Device Type </td><td>
			<select name="dtype" id="dtype">
				<option value="">-SELECT-</option>
				<option value="1" <?php if($dev3_type==1) print 'selected="selected"'; ?>>Server</option>
				<option value="2" <?php if($dev3_type==2) print 'selected="selected"'; ?>>Network Device</option>
				<option value="3" <?php if($dev3_type==3) print 'selected="selected"'; ?>>Application</option>
				<option value="4" <?php if($dev3_type==4) print 'selected="selected"'; ?>>Other</option>
			</select>
			</td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Primary IP </td><td><input type="text" name="dip1" id="dip1" value="<?php print $dev3_ip1; ?>" /></td><td width="50px"></td><td style="vertical-align:middle">Secondary IP </td><td><input type="text" name="dip2" id="dip2" value="<?php print $dev3_ip2; ?>" /></td></tr>
          	<tr><td colspan="6" align="center"><input type="submit" value="Update" style="width:100px; height:30px;" /></td></tr>
          </table>
        </form>
		</div>
      </div>
<?php
	}
}
?>
<!--  END #PORTLETS -->  
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Active Devices</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
<?php
			print '<tr><th width="75px" style="background-color:#BBBBBB"></th><th style="background-color:#BBBBBB">Device Name</th><th style="background-color:#BBBBBB">Primary IP</th><th style="background-color:#BBBBBB">Secondary IP</th><th width="100px" style="background-color:#BBBBBB"></th></tr>';
?>
            </thead>
            <tbody>
       <?php
       	if(sizeof($dev1_id)>0) $k=(array_keys($dev1_id));
		for($i=0;$i<sizeof($dev1_id);$i++){
			if(sizeof($dev1_id[$k[$i]])>0){ 
				print '<tr><th style="background-color:#DDDDDD"></th><th style="background-color:#DDDDDD" colspan="4"><strong>'.$dev_type[$i+1].'</strong></th></tr>';
				for($j=0;$j<sizeof($dev1_id[$k[$i]]);$j++){
					print '<tr><th></th><th>'.$dev1_name[$k[$i]][$j].'</th><th>'.$dev1_ip1[$k[$i]][$j].'</th><th>'.$dev1_ip2[$k[$i]][$j].'</th><th width="60px"><a href="index.php?components=settings&action=device&sub=edit_dev&id='.$dev1_id[$k[$i]][$j].'" ><img title="Edit" src="images/icons/edit.gif" /></a>&nbsp;&nbsp;<a href="#" onclick="device_decommission('.$dev1_id[$k[$i]][$j].')"><img title="Decommission the device. This will not delete any previous data. Also, you can make it active later time." src="images/icons/action_delete.gif" /></a></th></tr>';
				}
			}	
		}
		?>
			</tbody>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
    <!--THIS IS A WIDE PORTLET-->
  
    
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Decommission Devices</div>
		<div class="portlet-content nopadding">
        <form action="" method="post">
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <thead>
<?php
			print '<tr><th width="75px" style="background-color:#BBBBBB"></th><th style="background-color:#BBBBBB">Device Name</th><th style="background-color:#BBBBBB">Primary IP</th><th style="background-color:#BBBBBB">Secondary IP</th><th width="100px" style="background-color:#BBBBBB"></th></tr>';
?>
            </thead>
            <tbody>
       <?php
       	if(sizeof($dev2_id)>0)$k=(array_keys($dev2_id));
		for($i=0;$i<sizeof($dev2_id);$i++){
			if(sizeof($dev2_id[$k[$i]])>0){ 
				print '<tr><th style="background-color:#DDDDDD"></th><th style="background-color:#DDDDDD" colspan="4"><strong>'.$dev_type[$i+1].'</strong></th></tr>';
				for($j=0;$j<sizeof($dev2_id[$k[$i]]);$j++){
					print '<tr><th></th><th>'.$dev2_name[$k[$i]][$j].'</th><th>'.$dev2_ip1[$k[$i]][$j].'</th><th>'.$dev2_ip2[$k[$i]][$j].'</th><th width="60px"><a href="index.php?components=settings&action=device_activate&id='.$dev2_id[$k[$i]][$j].'"><img title="Edit" src="images/icons/action_check.gif" /></a>&nbsp;&nbsp;<a href="#" onclick="device_dev_delete('.$dev2_id[$k[$i]][$j].')"><img title="Delete the Device. All Assosiated Data must be deleted inorder to delete the Device." src="images/icons/action_delete.gif" /></a></th></tr>';
				}
			}	
		}
		?>
			</tbody>
          </table>
        </form>
		</div>
      </div>
   </div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
