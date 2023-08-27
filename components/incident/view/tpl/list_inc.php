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
			<tr><td width="50px"></td><td colspan="5">Impact Description <br /><textarea name="description" id="description" disabled="disabled" rows="6" style="width:100%"><?php print $inc_description; ?></textarea></td><td width="50px"></td></tr>
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
			<tr><td width="50px"></td><td colspan="5"><strong>Approval Comment</strong> <br /><textarea disabled="disabled" rows="5" style="width:100%"><?php print $inc_approve_comment; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"><strong>Approver</strong></td><td style="vertical-align:middle">: <?php print $inc_approve_by; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Approved Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $inc_approve_time; ?> "><?php print $inc_approve_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
            <!--THIS IS A PORTLET--> 

<table width="100%">
<tr><td align="center"><a target="_blank" href="index.php?components=incident&action=print_incident&id=<?php print $_GET['id']; ?>" ><img border="0" src="images/print.jpg" /></a><?php if($_COOKIE['incident']==md5('Approver')){ ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="DeleteIncident(<?php print $_GET['id']; ?>)" ><img border="0" src="images/icons/action_delete.gif" title="Delete Checklist" /></a><?php } ?></td></tr>
</table>
