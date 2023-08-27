    <table width="100%">
	<tr><td width="50px"></td><td width="100px">Device: </td><td>
	<select name="devid" id="devid" onchange="getReport2('incident','all')" >
	<option value="">-SELECT-</option>
	<?php
		for($i=0;$i<sizeof($dev_id);$i++){
			$select0='';
			if(isset($_GET['device'])) if($_GET['device']==$dev_id[$i]) $select0='selected="selected"';
			print '<option value="'.$dev_id[$i].'" '.$select0.'>'.$dev_name[$i].'</option>';
		}
	
	?>
	</select>
	</td><td width="100px"></td></tr>
</table>

<div id="portlets">
	<div class="clear"></div>
<br />
    <?php
    	if($_GET['filter']=='all'){ $f1='selected="selected"'; $f2=''; $f3=''; $f4=''; }
    	if($_GET['filter']=='pending'){ $f1=''; $f2='selected="selected"'; $f3=''; $f4=''; }
    	if($_GET['filter']=='approved'){ $f1=''; $f2=''; $f3='selected="selected"'; $f4=''; }
    	if($_GET['filter']=='rejected'){ $f1=''; $f2=''; $f3=''; $f4='selected="selected"'; }
    ?>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Incident Report <span style=" padding-left:650px;">Filter <select id="filter" onchange="getReport2('incident',this.value)"><option value="all" <?php print $f1; ?>>All</option><option value="pending" <?php print $f2; ?>>Pending</option><option value="approved" <?php print $f3; ?>>Approved</option><option value="rejected" <?php print $f4; ?>>Rejected</option></select></span></div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet"><tr>
			<tr><th width="50px"></th><th  width="90px">Incident ID</th><th>Title</th><th style="text-align:center">Status</th><th width="50px"></th></tr>
		<?php for($i=0;$i<sizeof($inc_id);$i++){
				if($inc_status[$i]=='Approval Pending') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/pending.png" />'; 
				if($inc_status[$i]=='Rejected') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/reject2.png" />'; 
				if($inc_status[$i]=='Approved') $status1='<img title="'.$inc_status[$i].'" height="15px" src="images/done.png" />'; 
				if((strlen($inc_title[$i]))>30) $title1=substr($inc_title[$i],0,29).'...'; else $title1=$inc_title[$i];
				print '<tr><td width="50px"></td><td  width="90px"><a href="index.php?components=incident&action=get_report&type=by_device&devid='.$inc_id[$i].'" >'.str_pad($inc_id[$i],5,"0",STR_PAD_LEFT).'</a></td><td><a href="index.php?components=incident&action=list_cr&id='.$inc_id[$i].'" title="'.$inc_title[$i].'" >'.$title1.'</a></td><td align="center"><a href="index.php?components=incident&action=list_cr&id='.$inc_id[$i].'" >'.$status1.'</a></td><td width="50px"></td></tr>';
			}
		?>
		</table>
		</div>
      </div>
      </div>
