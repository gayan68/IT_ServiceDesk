<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Report</title>

</head>

<body style="background-color:white; background-image:none;">
 
<!-- #PORTLETS START -->
<?php
print '<h1>'.$se_appname.'</h1>';
print '<h3>'.$se_company.'</h3>';
print '<h3>Checklist Report</h3>';
print '<hr /><br />';
?>

    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
 <?php if(!isset($_GET['re'])){ ?>
  <form method="post" action="index.php?components=checklist&action=addchecklist" onsubmit="return validateCheckList()" >
    <div id="portlets">
        <!--THIS IS A WIDE PORTLET-->
    <table width="100%" border="1"><tr><td>
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> 
			<strong>Check List Header</strong></div>
		<div class="portlet-content nopadding">
			
		<table><tr><td><br /><br />
			<table>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>
				Check List ID</strong></td><td width="30px"></td><td><?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>
				Check List Date</strong></td><td width="30px"></td><td><?php print $submit_date; ?></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>
				Checked By</strong></td><td width="30px"></td><td><strong><?php print $submit_by; ?></strong></td></tr>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>
				Checked Time</strong></td><td width="30px"></td><td><?php print $submit_time; ?></td></tr>
		<?php if($approve_by!=''){ ?>
			<tr><td colspan="4" height="1px"></td></tr>
			<tr><td width="100px"></td><td width="120px" style="background-color:#F1F1F1; padding-left:20px"> <strong>
				Approve By</strong></td><td width="30px"></td><td><?php print '<strong>'.$approve_by.'</strong> at '.$approve_time.' on '.$approve_date; ?></td></tr>
		<?php } ?>
			</table>
		</td><td width="200px"><br /><img style="position:relative; left:200px" src="images/<?php print $img; ?>" /></td></tr></table>
		</div>
      </td></tr></table><br /><br />
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <table width="100%" border="1"><tr><td>
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> 
			<strong>Servers</strong></div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%" border="1" cellspacing="0">
				<tr><th width="50px" style="border:0;"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>
					IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">
					Comment</th><td width="50px" style="border:0;"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Servers']);$i++){
					if($status['Servers'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td style="border:0;"></td><td>'.$name['Servers'][$i].'</td><td>'.$ip1['Servers'][$i].'<br />'.$ip2['Servers'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Servers'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Servers'][$i].'</td><td style="border:0;"></td></tr>';
				}
			?>				
			</table>

		</div>
      </td></tr></table><br /><br />
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <table width="100%" border="1"><tr><td>
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> 
			<strong>Network</strong></div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%" border="1" cellspacing="0">
				<tr><th width="50px" style="border:0;"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>
					IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">
					Comment</th><td width="50px" style="border:0;"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Network Devices']);$i++){
					if($status['Network Devices'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td style="border:0;"></td><td>'.$name['Network Devices'][$i].'</td><td>'.$ip1['Network Devices'][$i].'<br />'.$ip2['Network Devices'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Network Devices'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Network Devices'][$i].'</td><td style="border:0;"></td></tr>';
				}
			?>				
			</table>

		</div>
      </td></tr></table><br /><br />
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <table width="100%" border="1"><tr><td>
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /><strong>Applications</strong></div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%" border="1" cellspacing="0">
				<tr><th width="50px" style="border:0;"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>
					IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">
					Comment</th><td width="50px" style="border:0;"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Applications']);$i++){
					if($status['Applications'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td style="border:0;"></td><td>'.$name['Applications'][$i].'</td><td>'.$ip1['Applications'][$i].'<br />'.$ip2['Applications'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Applications'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Applications'][$i].'</td><td style="border:0;"></td></tr>';
				}
			?>				
			</table>

		</div>
      </td></tr></table><br /><br />
<!--  END #PORTLETS -->
        <!--THIS IS A WIDE PORTLET-->
    <table width="100%" border="1"><tr><td>
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> 
			<strong>Other</strong></div>
		<div class="portlet-content nopadding">

			<table id="box-table-b" width="100%" border="1" cellspacing="0">
				<tr><th width="50px" style="border:0;"></th><th width="150px"><strong>Device</strong></th><th width="170px"><strong>
					IP Address</strong></th><th width="50px"><strong>Status</strong></th><th width="340px">
					Comment</th><td width="50px" style="border:0;"></td></tr>
			<?php
				for($i=0;$i<sizeof($id['Other']);$i++){
					if($status['Other'][$i]==1) $img1='action_check.gif'; else $img1='action_delete.gif';
					print '<tr><td style="border:0;"></td><td>'.$name['Other'][$i].'</td><td>'.$ip1['Other'][$i].'<br />'.$ip2['Other'][$i].'</td><td>&nbsp;&nbsp;<img id="yes'.$id['Other'][$i].'" src="images/icons/'.$img1.'" />&nbsp;&nbsp;</td><td>'.$comment['Other'][$i].'</td><td style="border:0;"></td></tr>';
				}
			?>				
			</table>

		</div>
      </td></tr></table><br /><br />
<!--  END #PORTLETS -->
</div>
<table width="100%">
<tr><td align="center"><textarea id="comment" cols="128" rows="5"><?php  print $approve_comment; ?></textarea><br /></td></tr>
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
<br />
	
</body>
</html>