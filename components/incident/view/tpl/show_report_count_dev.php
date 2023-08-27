<div id="portlets">
	<div class="clear"></div>
<br />
<p>Note: This report list down count of Incedents reported by Devices </p>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Incident Report</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet"><tr>
			<tr><th width="50px"></th><th  width="90px">Device Name</th><th></th><th width="120px">Number of Changes</th><th></th><th width="50px">Status</th><th width="50px"></th></tr>
		<?php for($i=0;$i<sizeof($count);$i++){
				$status1='<img title="Not Pending" width="15px" src="images/done.png" />'; 
				print '<tr><td width="50px"></td><td><a href="index.php?components=incident&action=get_report&type=by_device&year='.$_GET['year'].'&device='.$device_id[$i].'&filter=approved" >'.$device_name[$i].'</a></td><td></td><td align="center"><a href="index.php?components=incident&action=get_report&type=by_device&year='.$_GET['year'].'&device='.$device_id[$i].'&filter=approved" >'.$count[$i].'</a></td><td></td><td align="center">'.$status1.'</td><td width="50px"></td></tr>';
			}
		?>
		</table>
		</div>
      </div>
      </div>
