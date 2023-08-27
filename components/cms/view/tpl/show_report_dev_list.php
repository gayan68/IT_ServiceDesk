    <table width="100%">
	<tr><td width="50px"></td><td width="100px">Device: </td><td>
	<select name="devid" id="devid" onchange="getReport2()" >
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
