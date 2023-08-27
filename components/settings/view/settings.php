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
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Company Profile</div>
		<div class="portlet-content nopadding">
        <form action="index.php?components=settings&action=general_settingsupdate1" enctype="multipart/form-data" method="post" >
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <tbody>
				<tr><td width="150px"></td><td width="150px">Company Name</td><td width="50px"></td><td width="150px"><input type="text" name="se_company" id="se_company" value="<?php print $se_company; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Company Logo</td><td width="50px"></td><td width="150px"><input type="file" name="logUpload" id="logUpload"> </td><td width="150px" align="left"><img height="30px" src="images/logo.jpg" /></td></tr>
				<tr><td width="150px"></td><td width="150px">Application Name</td><td width="50px"></td><td width="150px"><input type="text" name="se_appname" id="se_appname" value="<?php print $se_appname; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><input type="submit" value="Update" style="height:40px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Technical Settings</div>
		<div class="portlet-content nopadding">
        <form action="index.php?components=settings&action=general_settingsupdate2" method="post" >
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
            <tbody>
				<tr><td width="150px"></td><td width="150px">Email Alert Enable</td><td width="50px"></td><td width="300px"><input type="checkbox" name="emailalert" id="emailalert" value="Yes" <?php print $email_alert; ?> /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Mail Server</td><td width="50px"></td><td><input type="text" name="se_mailsrv" id="se_mailsrv" value="<?php print $se_mail_srv; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px"><a title="Email Alerts will be sent from this Email Address">Email Sending Address</a></td><td width="50px"></td><td width="150px"><input <?php if($_SERVER['SERVER_NAME']=='www.wappcloud.com') print 'disabled="disabled"';  ?>  type="text" name="se_mail_from" id="se_mail_from" value="<?php print $se_mail_from; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Domain Controller</td><td width="50px"></td><td><input type="text" name="se_ldap" id="se_ldap" value="<?php print $se_ldap; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Service Account</td><td width="50px"></td><td><input type="text" name="se_account" id="se_account" value="<?php print $se_account; ?>" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Password</td><td width="50px"></td><td><input type="password" name="se_pass" id="se_pass" value="" placeholder="******" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Time Zone<br /><br /> Current System Time</td><td width="50px"></td><td>
					<select name="timezone" id="timezone">
					<?php 
						for($i=0;$i<sizeof($timezone_list);$i++){
							if($timezone_list[$i]==$se_timezone) $select0='selected="selected"'; else $select0='';
							print '<option value="'.$timezone_list[$i].'" '.$select0.'>'.$timezone_list[$i].'</option>';
						}
					?>					
						<option value=""></option>
					</select><br /><br /> <?php print $system_time; ?>
				</td><td width="150px"></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><input type="submit" value="Update" style="height:40px; width:130px;" /></td><td width="300px"></td></tr>
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
