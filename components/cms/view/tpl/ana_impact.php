<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Change Request</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Type Of System</strong></td><td>: <?php print $change_type; ?></td><td colspan="4"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle;" ><strong>Associated Systems</strong></td><td  colspan="4">: 
			<?php 
				for($i=0;$i<sizeof($system);$i++){
				if(sizeof($system)!==($i+1)) $seperater=', '; else $seperater='';
					print $system[$i].$seperater; 
			} ?>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>CR Title</strong></td><td colspan="4">: <?php print $title; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Required Date</strong></td><td>: <?php print $required_date; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Request Priority</strong></td><td>: <?php print $req_priority; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Request Description</strong> <br /><textarea disabled="disabled" name="cr_description" id="cr_description" rows="5" style="width:100%"><?php print $request_description; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Business Case</strong> <br /><textarea disabled="disabled" name="bis_description" id="bis_description" rows="5" style="width:100%"><?php print $business_case; ?></textarea></td><td width="50px"></td></tr>
		<?php if(($attachment1!='')||($attachment2=''))	
				print '<tr><td width="50px"></td><td colspan="5"><strong>Attachments</strong> <br /><span><a style="padding-left:80px;" target="_blank" href="attachment/'.$attachment1.'" >'.$attachment1.'</a></span><span><a style="padding-left:300px;" target="_blank" href="attachment/'.$attachment2.'" >'.$attachment2.'</a></span></td><td width="50px"></td></tr>';
		?>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Requester</strong></td><td style="vertical-align:middle">: <?php print $requester; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Requested Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $requested_time; ?> "><?php print $requested_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Impact Analysis</div>
		<div class="portlet-content nopadding">
  <form method="post" action="index.php?components=cms&action=add_analyze" onsubmit="return validateCMSAnalyze()" >
  <input type="hidden" name="id" value="<?php print $_GET['id']; ?>" />
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Scheduled Implementation Date</td><td><input type="date" name="sch_date" id="app_date" /></td><td width="50px"></td><td style="vertical-align:middle">Actual Priority</td><td>
				<select name="ana_priority" id="ana_priority">
					<option value="">-SELECT-</option>
					<option value="1">Critical</option>
					<option value="2">High</option>
					<option value="3">Medium</option>
					<option value="4">Low</option>
				</select>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Implementer</td><td colspan="4">
				<select name="imp_by" id="imp_by">
					<option value="">-SELECT-</option>
		<?php for($i=0;$i<sizeof($ma_user);$i++)
				print '<option value="'.$ma_user[$i].'">'.$ma_user[$i].'</option>';
		?>
				</select>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Specification <br /><textarea name="ana_spec" id="ana_spec" rows="5" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Impact Analysis <br /><textarea name="ana_impact" id="ana_impact" rows="5" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Rollback Plan <br /><textarea name="ana_rollback" id="ana_rollback" rows="5" style="width:100%"></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5" align="center"><input type="submit" value="Submit Impact Analysis" style="height:40px; width:200px" /></td><td width="50px"></td></tr>
		</table>
		</form>
		</div>
      </div>
      </div>