<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />CMS Report</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet"><tr>
			<tr><th width="50px"></th><th  width="90px">CR ID</th><th>Date</th><th>Title</th><th>Devices</th><th>Action</th><th style="text-align:center">Status</th><th width="50px"></th></tr>
		<?php for($i=0;$i<sizeof($id);$i++){
				if($status[$i]=='done') $status1='<img title="Not Pending" width="15px" src="images/done.png" />'; else $status1='<img title="Pending" height="15px" src="images/pending.png" />'; 
				if((strlen($title[$i]))>30) $title1=substr($title[$i],0,29).'...'; else $title1=$title[$i];
				print '<tr><td width="50px"></td><td  width="90px"><a href="index.php?components=cms&action=get_report&type=by_device&devid='.$id[$i].'" >'.str_pad($id[$i],5,"0",STR_PAD_LEFT).'</a></td><td><a href="index.php?components=cms&action=list_cr&id='.$id[$i].'" >'.$cr_date[$i].'</a></td><td><a href="index.php?components=cms&action=list_cr&id='.$id[$i].'" title="'.$title[$i].'" >'.$title1.'</a></td><td><a href="index.php?components=cms&action=list_cr&id='.$id[$i].'" >'.$devices[$i].'</a></td><td align="left"><a href="index.php?components=cms&action=list_cr&id='.$id[$i].'" style="color:'.$color1[$i].'" >'.$action[$i].'</a></td><td align="center"><a href="index.php?components=cms&action=list_cr&id='.$id[$i].'" >'.$status1.'</a></td><td width="50px"></td></tr>';
			}
		?>
		</table>
		</div>
      </div>
      </div>
