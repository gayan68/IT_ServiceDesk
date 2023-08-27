<?php
                include_once  'template/header.php';
?>
<!-- MENU END -->
<script type="text/javascript" >
function showHint(location,destination,str) {
    if (str.length < 3) { 
        document.getElementById(location).innerHTML = '';
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        document.getElementById(location).innerHTML = '';
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var $listarr = xmlhttp.responseText.split(",");
				for($i=0;$i<($listarr.length);$i++){
					var ul = document.getElementById(location);
					var li = document.createElement("li");
					li.appendChild(document.createTextNode($listarr[$i]));
					li.setAttribute("id","li");
					li.setAttribute("onclick","addHint('"+destination+"','"+$listarr[$i]+"')");
					ul.appendChild(li);  
				}      		  
            }
        }
        xmlhttp.open("GET", "index.php?components=settings&action=ad_query&q=" + str, true);
        xmlhttp.send();
    }
}
</script>
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
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 400px">
      <!--THIS IS A PORTLET-->
		<div class="portlet">
            <div class="portlet-header"><img src="images/icons/chart_bar.gif" width="16" height="16" alt="Reports" /> Current Standalone Users</div>
            <div class="portlet-content">
            <!--THIS IS A PLACEHOLDER FOR FLOT - Report & Graphs -->
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-b">
            <tr><th width="10px"></th><th>Name</th><th>Username</th><th>Type</th><th width="10px"></th></tr>
            
			<?php for($i=0;$i<sizeof($user_id);$i++){
			if($user_type[$i]==1) $type='Admin'; else $type='User';
					print '<tr><td></td><td><gap><ul><li>'.$user_name[$i].'<ul><li><a href="index.php?components=settings&action=userprofile&sub=resetpw&id='.$i.'">Reset Password</a></li><li><a href="index.php?components=settings&action=userprofile&sub=edit&userid='.$user_id[$i].'&id='.$i.'">Edit Account</a></li><li><a href="index.php?components=settings&action=userprofile&sub=delete&userid='.$user_id[$i].'&id='.$i.'">Delete Account</a></li></ul></li></ul></gap></td><td>'.$user_username[$i].'</td><td>'.$type.'</td><td></td></tr>';
			} ?>
			</table>
            </div>
        </div>      
      <!--THIS IS A PORTLET-->
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
	<?php if(isset($_GET['sub'])){ 
	if($_GET['sub']=='resetpw'){ ?>
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Change Password</div>

		<div class="portlet-content">
		<br /><br />
		<form method="post" action="index.php?components=settings&action=userprofile_changepwd1"  onsubmit="return validateChangePwd()" > 
          <input type="hidden" name="userid" value="<?php print $user_id[$_GET['id']]; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
				<tr><td width="150px"></td><td width="200px">Name</td><td width="50px"></td><td width="350px"><?php print $user_name[$_GET['id']]; ?></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>Username</td><td width="50px"></td><td width="350px"><?php print $user_username[$_GET['id']]; ?></td><td width="150px" align="left"></td></tr>
				<tr><td width="150px"></td><td>Email</td><td width="50px"></td><td width="350px"><?php print $user_email[$_GET['id']]; ?></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>New Password</td><td width="50px"></td><td width="350px"><input type="password" name="u_pass" id="u_pass1" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>New Confirm Password</td><td width="50px"></td><td width="350px"><input type="password" id="u_pass2" /></td><td width="150px"></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><br /><input type="submit" value="Change Password" style="height:30px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
          </form>
		  <p>&nbsp;</p>
		</div>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
	<?php }else if($_GET['sub']=='delete'){ ?>
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Delete User</div>

		<div class="portlet-content">
		<br /><br />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
				<tr><td width="150px"></td><td width="200px">Name</td><td width="50px"></td><td width="350px"><?php print $user_name[$_GET['id']]; ?></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>Username</td><td width="50px"></td><td width="150px"><?php print $user_username[$_GET['id']]; ?></td><td width="150px" align="left"></td></tr>
				<tr><td	></td><td colspan="3" align="center"><br />
				<p align="left">Note: Deleting the user may delete or currupt data and reports related to this user.</p>
				<input type="button"  style="width:100px; height:32px; background-color:inherit; border:none;  background-image:url('images/icons/yes.png'); cursor:pointer;"  value="" onclick="window.location = 'index.php?components=settings&action=userprofile_delete&userid=<?php print $_GET['userid']; ?>'" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="button"  style="width:100px; height:32px; background-color:inherit; border:none;  background-image:url('images/icons/no.png'); cursor:pointer;"  value="" onclick="window.location = 'index.php?components=settings&action=userprofile'" />
				</td><td></td></tr>
	        </tbody>
          </table>
		  <p>&nbsp;</p>
		</div>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
	<?php }else if($_GET['sub']=='edit'){ ?>
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Edit User</div>

		<div class="portlet-content">
		<br /><br />
		<form method="post" action="index.php?components=settings&action=userprofile_edituser"  onsubmit="return validateEditUser()" > 
          <input type="hidden" name="userid" value="<?php print $_GET['userid']; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
            <?php if($user_type[$_GET['id']]==1){ $admin='checked="checked"'; $user=''; }else{ $user='checked="checked"'; $admin=''; }
				print '<tr><td width="150px"></td><td width="150px">Name</td><td width="50px"></td><td width="150px"><input type="text" name="u_name" id="u_name" value="'.$user_name[$_GET['id']].'" /></td><td width="150px"></td></tr>';
				print '<tr><td width="150px"></td><td width="150px">Username</td><td width="50px"></td><td width="150px">'.$user_username[$_GET['id']].'</td><td width="150px" align="left"></td></tr>';
				print '<tr><td width="150px"></td><td width="150px">Email</td><td width="50px"></td><td width="150px"><input type="text" name="u_email" id="u_email" value="'.$user_email[$_GET['id']].'" /></td><td width="150px"></td></tr>';
				print '<tr><td width="150px"></td><td width="150px">User Type</td><td width="50px"></td><td width="150px"><input type="radio" checked="checked" name="type" id="type1" value="1" '.$admin.' title="Admin can access control pannel and do system chages" />: Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="type" id="type2" value="2" '.$user.' title="We recommend creating this type of user account for Auditors, external users and for special cases. For the internal users, we recommend to use domain authentication." />: User</td><td width="150px"></td></tr>';
				print '<tr><td width="300px"></td><td colspan="3" align="center"><br /><input type="submit" value="Edit User" style="height:30px; width:130px;" /></td><td width="300px"></td></tr>';
	        ?>
	        </tbody>
          </table>
          </form>
		  <p>&nbsp;</p>
		</div>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
 
	<?php }}else{ ?>
      <!--THIS IS A PORTLET-->        
        <div class="portlet">
		<div class="portlet-header">Create New Standalone User</div>

		<div class="portlet-content">
		<br /><br />
		<form method="post" action="index.php?components=settings&action=userprofile_createuser"  onsubmit="return validateCreateUser()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
				<tr><td width="150px"></td><td width="150px">Name</td><td width="50px"></td><td width="150px"><input type="text" name="u_name" id="u_name" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Username</td><td width="50px"></td><td width="150px"><input type="text" name="u_username" id="u_username" /> </td><td width="150px" align="left"></td></tr>
				<tr><td width="150px"></td><td width="150px">Password</td><td width="50px"></td><td width="150px"><input type="password" name="u_pass" id="u_pass1" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Confirm Password</td><td width="50px"></td><td width="150px"><input type="password" id="u_pass2" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">Email</td><td width="50px"></td><td width="150px"><input type="text" name="u_email" id="u_email" /></td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td width="150px">User Type</td><td width="50px"></td><td width="150px"><input type="radio" name="type" id="type1" value="1" title="Admin can access control pannel and do system chages" />: Admin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="type" id="type2" value="2" title="We recommend creating this type of user account for Auditors, external users and for special cases. For the internal users, we recommend to use domain authentication." />: User</td><td width="150px"></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><input type="submit" value="Create User" style="height:30px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
          </form>
		  <p>&nbsp;</p>
		</div>
		</div>
        </div>   
      <!--THIS IS A PORTLET--> 
	<?php } ?>
    </div>
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16"/>Active Directly User Mapping</div>
		<div class="portlet-content nopadding">
		<p style="padding-left:30px">This is only relevent for mapping Active Directly users as App Admins</p>
        <form action="index.php?components=settings&action=ad_adduser" method="post" onsubmit="return validateAdUser()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Domain Username</td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="ad_username" id="username" onkeyup="showHint('list','username',this.value)" /></a>
					            <ul id="list">
					            </ul>
					        </li>
					    </ul>
					</nav> 
					</td><td width="30px"></td><td>
					<input type="submit"  style="width:50px; height:50px; background-color:inherit; border:none;  background-image:url('images/icons/arrow01.png'); cursor:pointer;"  value="" />
					</td></tr>
					<!--<tr><td colspan="5"><p>Suggestions: <span id="txtHint"></span></p></td></tr>-->
					</table>
				</td><td width="40%" style="vertical-align:top;">
				<!-- ---------------List Admin permited Domain Accounts ------------------------>
					<table id="box-table-b">
					<?php  for($i=0;$i<sizeof($domainuser_id);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$domainuser_username[$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="ad_deleteuser('.$domainuser_id[$i].')" title="Remove User from App Admin" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
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
