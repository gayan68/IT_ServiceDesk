		<form method="post" action="index.php?components=inventory&action=edit_toner_name"  onsubmit="return addTonerName()" > 
		<input type="hidden" name="toner_id" value="<?php print $_GET['id']; ?>" />
          <table width="100%" cellpadding="0" cellspacing="0" id="box-table-a">
            <tbody>
            <tr><th width="10px" scope="col"></th><th scope="col" style="text-align:center">Name Of the Toner</th><td scope="col" style="text-align:center">
            <input type="text" name="toner_name" id="toner_name" value="<?php print $one_toner_name; ?>" style="width:140px" />
            </td><td scope="col"></td></tr>
			<tr><td scope="col" colspan="4"  style="vertical-align:middle" align="center"><input type="submit" value="Update" style="height:40px; width:80px" /></td></tr>
			</tbody>
          </table>
         </form>