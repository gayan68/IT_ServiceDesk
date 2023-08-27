<table><tr><td width="10px"></td><td style="background-color:silver; font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;Incident ID &nbsp;&nbsp;&nbsp;&nbsp;:</td><td width="100px" style="background-color:silver; font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center"><?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?></td></tr></table>
<div id="portlets">
	<div class="clear"></div>
    <div class="portlet">
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16" alt="Latest Registered Users" /> Incident</div>
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Affected System</td><td style="vertical-align:middle">: <?php print $inc_device; ?></td><td width="50px"></td><td style="vertical-align:middle"><div id="div1">Impact Severity</div></td><td>: <?php print $inc_severity; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Incident Category</td><td style="vertical-align:middle">: <?php print $inc_category; ?></td><td width="50px"></td><td style="vertical-align:middle">Occured Date</td><td style="vertical-align:middle">: <?php print $inc_occured_date; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Title</td><td colspan="4">: <?php print $inc_title; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Impact Description <br /><textarea name="description" id="description" disabled="disabled" rows="7" style="width:100%"><?php print $inc_description; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Submit By</strong></td><td style="vertical-align:middle">: <?php print $inc_submit_by; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Approved Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $inc_submit_time; ?> "><?php print $inc_submit_date; ?></a></td><td width="50px"></td></tr>
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
			<tr><td width="50px"></td><td colspan="5"><strong>Approval Comment</strong> <br /><textarea rows="5" style="width:100%" id="approver_comm"></textarea><br /></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
            <!--THIS IS A PORTLET--> 

<table width="100%">
<tr><td align="center">
<input type="button" onclick="approveIncident('<?php print $_GET['id']; ?>','reject')" style="width:105px; height:45px; background-image:url('images/reject1.png'); cursor:pointer;"  value="" />&nbsp;&nbsp;&nbsp;
<input type="button" onclick="approveIncident('<?php print $_GET['id']; ?>','approve')" style="width:105px; height:45px; background-image:url('images/approve1.png'); cursor:pointer;" value=""/></td></tr>
</table>
