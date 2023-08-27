<table><tr><td width="10px"></td><td style="background-color:silver; font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;Change Request ID &nbsp;&nbsp;&nbsp;&nbsp;:</td><td width="100px" style="background-color:silver; font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center"><?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?></td></tr></table>
<div id="portlets">
	<div class="clear"></div>
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
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Approval</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td colspan="5"><strong>Approval Comment</strong> <br /><textarea disabled="disabled" rows="5" style="width:100%"><?php print $approval_comment; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Approver</strong></td><td style="vertical-align:middle">: <?php print $approved_by; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Approved Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $approved_time; ?> "><?php print $approved_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" />Implementer</div>
		<div class="portlet-content nopadding">
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Implemented Date</strong></td><td>: <?php print $implemented_date; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Implementation Status</strong></td><td>: <?php print $status0; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><strong>Comments</strong><br /><textarea name="imp_comm" id="imp_comm" rows="5" style="width:100%" disabled="disabled"><?php print $implementation_comment; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Implemented By</strong></td><td style="vertical-align:middle">: <?php print $implement_by; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>CMS Completed Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $implemented_frm_time; ?> "><?php print $implemented_frm_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
      </div>
<table width="100%">
<tr><td align="center"><a target="_blank" href="index.php?components=cms&action=print_cms&id=<?php print $_GET['id']; ?>" ><img border="0" src="images/print.jpg" /></a><?php if($deleteAllow){ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="DeleteCMS(<?php print $_GET['id']; ?>)" ><img border="0" src="images/icons/action_delete.gif" title="Delete Checklist" /></a><?php } ?></td></tr>
</table>
