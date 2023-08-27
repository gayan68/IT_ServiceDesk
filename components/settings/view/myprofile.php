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
    <h1 class="user_profile">General Settings</h1>
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
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />My Profile</div>
		<div class="portlet-content nopadding"><br />
        <form action="index.php?components=settings&action=userprofile_changepwd2&userid=<?php print $user_id; ?>" method="post" onsubmit="return validateChangePwd()" >
          <table width="100%" >
            <tbody>
				<tr><td width="150px"></td><td width="70px"><strong>Your Name</strong></td><td width="10px"></td><td><?php print $user_name; ?></td><td width="150px"></td></tr>
				<tr><td></td><td><strong>Username</strong></td><td></td><td><?php print $user_username; ?></td><td></td></tr>
				<tr><td colspan="5"><br />	<hr /></td></tr>
				<tr height="30px"><td></td><td>Change Password</td><td></td><td width="150px"><input type="password"  name="u_pass" id="u_pass1" /></td><td></td></tr>
				<tr height="30px"><td></td><td>Confirm Password</td><td></td><td width="150px"><input type="password" id="u_pass2" /></td><td></td></tr>
				<tr><td></td>	<td colspan="3" align="center"><input type="submit" value="Change Password" style="height:40px; width:130px;" /></td><td></td></tr>
	        </tbody>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Email Alert Subscriptions</div>
		<div class="portlet-content nopadding" align="center"><br />
        <form action="index.php?components=settings&action=userprofile_changepwd2&userid=<?php print $user_id; ?>" method="post" onsubmit="return validateChangePwd()" >
          <table width="70%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>              <tr><th width="25" scope="col"></th><th width="100px" scope="col">Module</th><th scope="col">Level</th><th width="75" scope="col">Email Alert</th></tr>
				<?php
				for($i=0;$i<sizeof($authid);$i++){
						print '<tr><td width="25" scope="col"></td><td scope="col">'.$module_name[$i].'</td><td scope="col">'.$auth_level[$i].'</td><td width="75" scope="col"><input type="checkbox" '.$email_status[$i].' id="subscription'.$authid[$i].'" onchange="emailSubscription('.$authid[$i].')"/></td></tr>';
				}	
				?>
	        </tbody>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<?php
                include_once  'template/footer.php';
?>
