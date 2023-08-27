<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />List of Pending Change Request | Approval Pending by You </div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
		<?php for($i=0;$i<sizeof($id);$i++)
				print '<tr><td width="100px"></td><td  width="90px"><a href="index.php?components=cms&action=show_implement_cr&id='.$id[$i].'" >'.str_pad($id[$i],5,"0",STR_PAD_LEFT).'</a></td><td  width="90px"><a href="index.php?components=cms&action=show_implement_cr&id='.$id[$i].'" >'.$cr_date[$i].'</a></td><td><a href="index.php?components=cms&action=show_implement_cr&id='.$id[$i].'" >'.$title[$i].'</a></td><td width="50px"></td></tr>';
		?>
		</table>
		</div>
      </div>
      </div>