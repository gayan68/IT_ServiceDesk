<div id="portlets">
	<div class="clear"></div>

    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Incidents | Approve Pending </div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet"><tr>
			<tr><th width="50px"></th><th  width="90px">Incident ID</th><th>Title</th><th style="text-align:center">Status</th><th width="50px"></th></tr>
		<?php for($i=0;$i<sizeof($inc_id);$i++){
				if($inc_status[$i]=='Approval Pending') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/pending.png" />'; 
				if($inc_status[$i]=='Rejected') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/reject2.png" />'; 
				if($inc_status[$i]=='Approved') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/done.png" />'; 
				if((strlen($inc_title[$i]))>30) $title1=substr($inc_title[$i],0,29).'...'; else $title1=$inc_title[$i];
				print '<tr><td width="50px"></td><td  width="90px"><a href="index.php?components=incident&action=show_approve_inc&id='.$inc_id[$i].'" >'.str_pad($inc_id[$i],5,"0",STR_PAD_LEFT).'</a></td><td><a href="index.php?components=incident&action=show_approve_inc&id='.$inc_id[$i].'" title="'.$inc_title[$i].'" >'.$title1.'</a></td><td align="center"><a href="index.php?components=incident&action=show_approve_inc&id='.$inc_id[$i].'" >'.$status1.'</a></td><td width="50px"></td></tr>';
			}
		?>
		</table>
		</div>
      </div>
      </div>
