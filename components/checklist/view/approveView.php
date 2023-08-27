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
if($_COOKIE['checklist']==md5('Submiter'))		print '<li><a href="index.php?components=checklist&action=show"><span>Fill Checklist</span></a></li>';
if($_COOKIE['checklist']==md5('Approver'))		print '<li><a href="index.php?components=checklist&action=list_checklist" class="current"><span>Approve Checklist</span></a></li>';
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
    </div>
    <div class="clear">

    </div>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
 <?php if(!isset($_GET['re'])){ ?>
  <form method="post" action="index.php?components=checklist&action=addchecklist" onsubmit="return validateCheckList()" >
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Check List Header</div>
		<div class="portlet-content nopadding">
			
		<table><tr><td><br /><br />
			<table>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>Check List ID</strong></td><td width="30px"></td><td><?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>Check List Date</strong></td><td width="30px"></td><td><?php print $submit_date; ?></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>Checked By</strong></td><td width="30px"></td><td><?php print $submit_by; ?></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>Checked Time</strong></td><td width="30px"></td><td><?php print $submit_time; ?></td></tr>
			</table>
		</td><td width="200px"><br /><img style="position:relative; left:200px" src="images/<?php print $img; ?>" /></td></tr></table>
		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Servers</div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%">
				<tr><th width="100px"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">Comment</th></tr>
			<?php
				for($i=0;$i<sizeof($id['Servers']);$i++){
					if($status['Servers'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td></td><td>'.$name['Servers'][$i].'</td><td>'.$ip1['Servers'][$i].'<br />'.$ip2['Servers'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Servers'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Servers'][$i].'</td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Network</div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%">
				<tr><th width="100px"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">Comment</th></tr>
			<?php
				for($i=0;$i<sizeof($id['Network Devices']);$i++){
					if($status['Network Devices'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td></td><td>'.$name['Network Devices'][$i].'</td><td>'.$ip1['Network Devices'][$i].'<br />'.$ip2['Network Devices'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Network Devices'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Network Devices'][$i].'</td></tr>';
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

			<table id="box-table-b" width="100%">
				<tr><th width="100px"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">Comment</th></tr>
			<?php
				for($i=0;$i<sizeof($id['Applications']);$i++){
					if($status['Applications'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td></td><td>'.$name['Applications'][$i].'</td><td>'.$ip1['Applications'][$i].'<br />'.$ip2['Applications'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Applications'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Applications'][$i].'</td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Other</div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%">
				<tr><th width="100px"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">Comment</th></tr>
			<?php
				for($i=0;$i<sizeof($id['Other']);$i++){
					if($status['Other'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td></td><td>'.$name['Other'][$i].'</td><td>'.$ip1['Other'][$i].'<br />'.$ip2['Other'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Other'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Other'][$i].'</td></tr>';
				}
			?>				
			</table>

		</div>
      </div>
<!--  END #PORTLETS -->
</div>
<table width="100%">
<tr><td align="center"><textarea id="comment" cols="128" rows="5" placeholder="Please Enter Your Comment Here"></textarea><br /></td></tr>
<tr><td align="center">
<input type="button" onclick="approve('<?php print $checklistid; ?>','reject')" style="width:105px; height:45px; background-image:url('images/reject1.png'); cursor:pointer;"  value="" />&nbsp;&nbsp;&nbsp;
<input type="button" onclick="approve('<?php print $checklistid; ?>','approve')" style="width:105px; height:45px; background-image:url('images/approve1.png'); cursor:pointer;" value=""/></td></tr>
</table>
	
  </form>
 <?php } ?>

    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 15px">
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
