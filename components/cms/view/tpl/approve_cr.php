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

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle; width:190px"><strong>Scheduled Implementation Date</strong></td><td>: <?php print $ana_imp_date; ?></td><td width="150px"></td><td style="vertical-align:middle"><strong>Actual Priority</strong></td><td>: <?php print $ana_imp_priority; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Implementer</strong></td><td colspan="4">: <?php print $propose_implementer; ?></td><td></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Specification</strong> <br /><textarea disabled="disabled" name="ana_spec" id="ana_spec" rows="5" style="width:100%"><?php print $specification; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Impact Analysis</strong> <br /><textarea disabled="disabled" name="ana_impact" id="ana_impact" rows="5" style="width:100%"><?php print $impact_analysis; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Rollback Plan </strong><br /><textarea disabled="disabled" name="ana_rollback" id="ana_rollback" rows="5" style="width:100%"><?php print $rollback_plan; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Analyser</strong></td><td style="vertical-align:middle">: <?php print $analyser; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Analyzed Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $analyse_time; ?> "><?php print $analyse_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Approver (Manager)</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td colspan="6">Approval Comment <br /><textarea name="approver_comm" id="approver_comm" rows="5" placeholder="Please Enter Your Comment Here" style="width:100%"></textarea><br /></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
      </div>
<table width="100%">
<tr><td align="center">
<input type="button" onclick="approveCMS('<?php print $_GET['id']; ?>','reject')" style="width:105px; height:45px; background-image:url('images/reject1.png'); cursor:pointer;"  value="" />&nbsp;&nbsp;&nbsp;
<input type="button" onclick="approveCMS('<?php print $_GET['id']; ?>','approve')" style="width:105px; height:45px; background-image:url('images/approve1.png'); cursor:pointer;" value=""/></td></tr>
</table>
