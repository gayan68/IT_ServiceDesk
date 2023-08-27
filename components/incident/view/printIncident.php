<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Report</title>
<style type="text/css">
.headers{
	font-size:10pt;
}
.data{
	font-size:10pt;
}

</style>
</head>

<body style="background-color:white; background-image:none; -webkit-print-color-adjust:exact; font-family:Arial, Helvetica, sans-serif;">
 
<!-- #PORTLETS START -->
<table width="100%">
<tr><td><?php print '<p style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; ">'.strtoupper($se_company).' INCIDENT MANAGEMENT SYSTEM </p>'; ?></td>
<td width="150px"><img width="100px" src="images/logo.jpg" /></td>
</tr>
</table><hr />
<br />
<table width="100%" align="right"><tr><td align="right">
<table cellspacing="0" cellpadding="0" border="1" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;Incident ID &nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?>&nbsp;&nbsp;</td></tr></table>
</td></tr></table>
    <!--  TITLE END  -->    
    <!-- #PORTLETS START -->
<table cellspacing="0" cellpadding="0" border="1" width="100%" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">Change Request</td></tr>
<tr><td>
<div id="portlets">
	<div class="clear"></div>
<br />
    <div class="portlet">
		<div class="portlet-content nopadding">

		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle">Affected System</td><td style="vertical-align:middle">: <?php print $inc_device; ?></td><td width="50px"></td><td style="vertical-align:middle"><div id="div1">Impact Severity</div></td><td>: <?php print $inc_severity; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Incident Category</td><td style="vertical-align:middle">: <?php print $inc_category; ?></td><td width="50px"></td><td style="vertical-align:middle">Occured Date</td><td style="vertical-align:middle">: <?php print $inc_occured_date; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle">Title</td><td colspan="4">: <?php print $inc_title; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5">Impact Description <br /><textarea name="description" id="description" disabled="disabled" rows="10" style="width:100%"><?php print $inc_description; ?></textarea></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px"></td><td height="40px" style="vertical-align:middle"><strong>Submit By</strong></td><td style="vertical-align:middle">: <?php print $inc_submit_by; ?></td><td width="50px"></td><td style="vertical-align:middle"><strong>Approved Date</strong></td><td>: <a href="#" title="Requested Time: <?php print $inc_submit_time; ?> "><?php print $inc_submit_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
</td></tr></table>
<br />
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
<br />
<table cellspacing="0" cellpadding="0" border="1" width="100%" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">Approval</td></tr>
<tr><td>
    <div class="portlet">
		<div class="portlet-content nopadding">
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><br /><strong>Approval Comment</strong> <br /></span><textarea disabled="disabled" rows="5" style="width:100%"><?php print $inc_approve_comment; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px" height="40px"></td><td style="vertical-align:middle" class="headers"><strong>Approver</strong></td><td style="vertical-align:middle" class="data">: <?php print $inc_approve_by; ?></td><td width="200px"></td><td style="vertical-align:middle" class="headers"><strong>Approved Date</strong></td><td class="data">: <a href="#" title="Requested Time: <?php print $inc_approve_time; ?> "><?php print $inc_approve_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
</td></tr></table>
<br /><br />
    <!-- FIRST SORTABLE COLUMN START -->
      <div class="column" id="left" style="height: 15px">
      </div>
      <!-- FIRST SORTABLE COLUMN END -->
      <!-- SECOND SORTABLE COLUMN START -->
      <div class="column">
      <!--THIS IS A PORTLET-->        
 
      <!--THIS IS A PORTLET--> 

                        
    </div>
	<!--  SECOND SORTABLE COLUMN END -->
    <div class="clear"></div>
  
   </div>
    <div class="clear"> </div>
<!-- END CONTENT-->    
<br />
	
</body>
</html>