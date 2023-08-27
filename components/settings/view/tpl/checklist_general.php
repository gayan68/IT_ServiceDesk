    <!-- #PORTLETS START -->
    <div id="portlets">
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 10px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
    <!--THIS IS A WIDE PORTLET-->
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16"/>Checklist Settings</div>
		<div class="portlet-content nopadding">
		<br />
		<table>
		<tr><td width="50px"></td><td width="200px" > Re-Open today checklist (one time) </td><td>&nbsp;<input style="vertical-align:middle;" type="checkbox" id="checklist_reopen" onchange="cl_reopen()" <?php if($cl_reopen==1) print 'checked="checked"'; ?> /><br /><br /></td><td></td></tr>
		<tr><td width="50px"></td><td style="vertical-align:middle">Checklist Close Time (24H)</td><td style="text-align:left" align="left" width="90px"><input style="width:80px" type="text" name="cl_close" id="cl_close" value="<?php print $cl_close; ?>" /></td><td style="vertical-align:middle; text-align:left" align="left"><input type="button" value="Update" onclick="updateClclose()" /></td></tr>
		<tr><td width="50px"></td><td style="vertical-align:middle">Checklist Available Days</td><td colspan="2"><br />
			<table>
			<tr><td>Sun:<input onchange="workingdays()" type="checkbox" name="sun" id="sun" style="vertical-align:middle;" <?php if($sun) print 'checked="checked"'; ?> />&nbsp;&nbsp; 
					Mon:<input onchange="workingdays()" type="checkbox" name="mon" id="mon" style="vertical-align:middle;" <?php if($mon) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					Tue:<input onchange="workingdays()" type="checkbox" name="tue" id="tue" style="vertical-align:middle;" <?php if($tue) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					Web:<input onchange="workingdays()" type="checkbox" name="wed" id="wed" style="vertical-align:middle;" <?php if($wed) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					Thu:<input onchange="workingdays()" type="checkbox" name="thu" id="thu" style="vertical-align:middle;" <?php if($thu) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					Fri:<input onchange="workingdays()" type="checkbox" name="fri" id="fri" style="vertical-align:middle;" <?php if($fri) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					Sat:<input onchange="workingdays()" type="checkbox" name="sat" id="sat" style="vertical-align:middle;" <?php if($sat) print 'checked="checked"'; ?> />&nbsp;&nbsp;
					
					</td></tr>
			</table>
		</td></tr>
		</table>
		</div>
      </div>
<!--  END #PORTLETS -->  
