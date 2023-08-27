		<form method="post" action="index.php?components=inventory&action=create_asset"  onsubmit="return validateCreateAsset()" > 
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
				<tr><td width="150px"></td><td width="250px">Type</td><td width="50px"></td><td width="350px">
				<select name="ass_type" id="ass_type">
					<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($ass_type_id);$i++){
						print '<option value="'.$ass_type_id[$i].'">'.$ass_type_name[$i].'</option>';
					} ?>
				</select>
				</td><td width="50px"></td></tr>
				<tr><td width="150px"></td><td>Asset ID</td><td width="50px"></td><td width="350px"><input type="text" name="asset_id" /></td><td></td></tr>
				<tr><td width="150px"></td><td>Name</td><td width="50px"></td><td width="350px"><input type="text" id="asset_name" name="asset_name" /></td><td></td></tr>
				<tr><td width="150px"></td><td>Serial Number</td><td width="50px"></td><td width="350px"><input type="text" id="asset_sn" name="asset_sn" /></td><td></td></tr>
				<tr><td width="150px"></td><td>Purchased Date</td><td width="50px"></td><td width="350px" style="vertical-align:middle"><input type="date"  name="purchased_on" id="app_date"  /></td><td></td></tr>
				<tr><td width="150px"></td><td>Location</td><td width="50px"></td><td width="350px">
				<select name="ass_location" id="ass_location">
					<option value="">-SELECT-</option>
					<?php for($i=0;$i<sizeof($ass_location_id);$i++){
						print '<option value="'.$ass_location_id[$i].'">'.$ass_location_name[$i].'</option>';
					} ?>
				</select>
				</td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>Status</td><td width="50px"></td><td width="350px">
				<select name="ass_status" id="ass_status">
					<?php for($i=0;$i<sizeof($ast_id);$i++){
						print '<option value="'.$ast_id[$i].'" '.$select.'>'.$ast_status[$i].'</option>';
					} ?>
				</select>
				</td><td width="150px"></td></tr>
				<tr><td width="150px"></td><td>Comment</td><td width="50px"></td><td width="350px" style="vertical-align:middle"><textarea name="asset_comment" ></textarea></td><td></td></tr>
				<tr><td width="300px"></td><td colspan="3" align="center"><br /><input type="submit" value="Create Asset" style="height:30px; width:130px;" /></td><td width="300px"></td></tr>
	        </tbody>
          </table>
          </form>
