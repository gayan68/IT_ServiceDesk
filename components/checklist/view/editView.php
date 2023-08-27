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
if($_COOKIE['checklist']==md5('Submiter'))		print '<li><a href="index.php?components=checklist&action=show" class="current"><span>Fill Checklist</span></a></li>';
if($_COOKIE['checklist']==md5('Approver'))		print '<li><a href="index.php?components=checklist&action=list_checklist"><span>Approve Checklist</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_checklist2"><span>View Checklists</span></a></li>';
                      							print '<li><a href="index.php?components=checklist&action=list_report"><span>Reports</span></a></li>';
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
    <h1 class="checklist">Morning IT Infastructure Check List</h1>
    <?php 
    	if(isset($_GET['re'])){
    		if($_GET['re']=='true') $color='#709BE4'; else $color='red';
    			if($_GET['message']) print '<p style="font-size:12pt; font-weight:bold; color:'.$color.'; text-align:center;">'.$_GET['message'].'</p>'; 
    	}
    ?>
    </div>
    <div class="clear">

    </div>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
  <form method="post" action="index.php?components=checklist&action=updatechecklist" >
  <input type="hidden" name="checklist_id" value="<?php print $_GET['id']; ?>" />
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Servers</div>
		<div class="portlet-content nopadding">

			<table>
				<tr><td width="100px"></td><td width="150px"><strong>Device</strong></td><td width="170px"><strong>IP Address</strong></td><td width="100px"><strong>Status</strong></td><td width="200px"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Servers']);$i++){
					if($status['Servers'][$i]==0){ 
						$img_up='action_check.gif'; $img_down='action_delete2.gif'; 
						$comment1='<input type="text" name="down_comment_'.$id['Servers'][$i].'" size="40" value="'.$comment['Servers'][$i].'" />';
						$status1='down';
					}else{ 
						$img_up='action_check2.gif'; $img_down='action_delete.gif'; 
						$comment1='';
						$status1='up';
					}
					print '<tr><td></td><td>'.$name['Servers'][$i].'</td><td>'.$ip1['Servers'][$i].'<br />'.$ip2['Servers'][$i].'</td><td>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Servers'][$i]."','up'".')"><img id="yes'.$id['Servers'][$i].'" src="images/icons/'.$img_up.'" /></a>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Servers'][$i]."','down'".')"><img id="no'.$id['Servers'][$i].'" src="images/icons/'.$img_down.'" /></a>
					<input type="hidden" id="status'.$id['Servers'][$i].'" name="status'.$id['Servers'][$i].'" value="'.$status1.'" /></td>
					<td><div id="comment'.$id['Servers'][$i].'">'.$comment1.'</div></td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Network Devices</div>
		<div class="portlet-content nopadding">

			<table>
				<tr><td width="100px"></td><td width="150px"><strong>Device</strong></td><td width="170px"><strong>IP Address</strong></td><td width="100px"><strong>Status</strong></td><td width="200px"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Network Devices']);$i++){
					if($status['Network Devices'][$i]==0){ 
						$img_up='action_check.gif'; $img_down='action_delete2.gif'; 
						$comment1='<input type="text" name="down_comment_'.$id['Network Devices'][$i].'" size="40" value="'.$comment['Network Devices'][$i].'" />';
						$status1='down';
					}else{ 
						$img_up='action_check2.gif'; $img_down='action_delete.gif'; 
						$comment1='';
						$status1='up';
					}
					print '<tr><td></td><td>'.$name['Network Devices'][$i].'</td><td>'.$ip1['Network Devices'][$i].'<br />'.$ip2['Network Devices'][$i].'</td><td>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Network Devices'][$i]."','up'".')"><img id="yes'.$id['Network Devices'][$i].'" src="images/icons/'.$img_up.'" /></a>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Network Devices'][$i]."','down'".')"><img id="no'.$id['Network Devices'][$i].'" src="images/icons/'.$img_down.'" /></a>
					<input type="hidden" id="status'.$id['Network Devices'][$i].'" name="status'.$id['Network Devices'][$i].'" value="'.$status1.'" /></td>
					<td><div id="comment'.$id['Network Devices'][$i].'">'.$comment1.'</div></td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Applications</div>
		<div class="portlet-content nopadding">
			<br />
			<table>
				<tr><td width="100px"></td><td width="150px"><strong>Device</strong></td><td width="170px"><strong>IP Address</strong></td><td width="100px"><strong>Status</strong></td><td width="200px"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Applications']);$i++){
					if($status['Applications'][$i]==0){ 
						$img_up='action_check.gif'; $img_down='action_delete2.gif'; 
						$comment1='<input type="text" name="down_comment_'.$id['Applications'][$i].'" size="40" value="'.$comment['Applications'][$i].'" />';
						$status1='down';
					}else{ 
						$img_up='action_check2.gif'; $img_down='action_delete.gif'; 
						$comment1='';
						$status1='up';
					}
					print '<tr><td></td><td>'.$name['Applications'][$i].'</td><td>'.$ip1['Applications'][$i].'<br />'.$ip2['Applications'][$i].'</td><td>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Applications'][$i]."','up'".')"><img id="yes'.$id['Applications'][$i].'" src="images/icons/'.$img_up.'" /></a>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Applications'][$i]."','down'".')"><img id="no'.$id['Applications'][$i].'" src="images/icons/'.$img_down.'" /></a>
					<input type="hidden" id="status'.$id['Applications'][$i].'" name="status'.$id['Applications'][$i].'" value="'.$status1.'" /></td>
					<td><div id="comment'.$id['Applications'][$i].'">'.$comment1.'</div></td></tr>';
				}
			?>				</table>

		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Other</div>
		<div class="portlet-content nopadding">

			<table>
				<tr><td width="100px"></td><td width="150px"><strong>Device</strong></td><td width="170px"><strong>IP Address</strong></td><td width="100px"><strong>Status</strong></td><td width="200px"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Other']);$i++){
					if($status['Other'][$i]==0){ 
						$img_up='action_check.gif'; $img_down='action_delete2.gif'; 
						$comment1='<input type="text" name="down_comment_'.$id['Other'][$i].'" size="40" value="'.$comment['Other'][$i].'" />';
						$status1='down';
					}else{ 
						$img_up='action_check2.gif'; $img_down='action_delete.gif'; 
						$comment1='';
						$status1='up';
					}
					print '<tr><td></td><td>'.$name['Other'][$i].'</td><td>'.$ip1['Other'][$i].'<br />'.$ip2['Other'][$i].'</td><td>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Other'][$i]."','up'".')"><img id="yes'.$id['Other'][$i].'" src="images/icons/'.$img_up.'" /></a>&nbsp;&nbsp;
					<a class="status" onclick="deviceStatus('."'".$id['Other'][$i]."','down'".')"><img id="no'.$id['Other'][$i].'" src="images/icons/'.$img_down.'" /></a>
					<input type="hidden" id="status'.$id['Other'][$i].'" name="status'.$id['Other'][$i].'" value="'.$status1.'" /></td>
					<td><div id="comment'.$id['Other'][$i].'">'.$comment1.'</div></td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
</div>
<table width="100%"><tr><td align="center"><input type="submit" style="width:170px; height:40px" value="Update Check List" /></td></tr></table>
	
  </form>

    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: <?php print $height; ?>">
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
