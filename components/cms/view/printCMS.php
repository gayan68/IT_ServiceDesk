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
<tr><td><?php print '<p style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; ">'.strtoupper($se_company).' CHANGE MANAGEMENT SYSTEM </p>'; ?></td>
<td width="150px"><img width="100px" src="images/logo.jpg" /></td>
</tr>
</table><hr />
<br />
<table width="100%" align="right"><tr><td align="right">
<table cellspacing="0" cellpadding="0" border="1" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">&nbsp;&nbsp;&nbsp;&nbsp;Change Request ID &nbsp;&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;<?php print str_pad($_GET['id'],5,"0",STR_PAD_LEFT); ?>&nbsp;&nbsp;</td></tr></table>
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
			<tr><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>Type Of System</strong></td><td class="data">: <?php print $change_type; ?></td><td colspan="4"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle" class="headers" ><strong>Associated Systems</strong></td><td  colspan="4" class="data">: 
			<?php 
				for($i=0;$i<sizeof($system);$i++){
				if(sizeof($system)!==($i+1)) $seperater=', '; else $seperater='';
					print $system[$i].$seperater; 
			} ?>
			</td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>CR Title</strong></td><td colspan="4"  class="data">: <?php print $title; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>Required Date</strong></td><td  class="data">: <?php print $required_date; ?></td><td width="50px"></td><td style="vertical-align:middle"  class="headers"><strong>Request Priority</strong></td><td  class="data">: <?php print $req_priority; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><strong><br />Request Description</strong></span> <br /><textarea disabled="disabled" name="cr_description" id="cr_description" rows="5" style="width:100%"><?php print $request_description; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><strong><br />Business Case</strong></span> <br /><textarea disabled="disabled" name="bis_description" id="bis_description" rows="5" style="width:100%"><?php print $business_case; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px" height="40px"></td><td style="vertical-align:middle"  class="headers"><strong>Requester</strong></td><td style="vertical-align:middle"  class="data">: <?php print $requester; ?></td><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>Requested Date</strong></td><td  class="data">: <a href="#" title="Requested Time: <?php print $requested_time; ?> "><?php print $requested_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
</td></tr></table>
<br />
<!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
<br />
<table cellspacing="0" cellpadding="0" border="1" width="100%" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">Impact Analysis</td></tr>
<tr><td>
    <div class="portlet">
		<div class="portlet-content nopadding">
<br />
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle; width:190px"  class="headers"><strong>Scheduled Implementation Date</strong></td><td class="data">: <?php print $ana_imp_date; ?></td><td></td><td style="vertical-align:middle"  class="headers"><strong>Actual Priority</strong></td><td class="data">: <?php print $ana_imp_priority; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td style="vertical-align:middle"  class="headers"><strong>Implementer</strong></td><td colspan="4" class="data">: <?php print $propose_implementer; ?></td><td></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><strong><br />Specification</strong> <br /></span><textarea disabled="disabled" name="ana_spec" id="ana_spec" rows="5" style="width:100%"><?php print $specification; ?></textarea></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><strong><br />Impact Analysis</strong> <br /></span><textarea disabled="disabled" name="ana_impact" id="ana_impact" rows="5" style="width:100%"><?php print $impact_analysis; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><strong><br />Rollback Plan</strong> <br /></span><textarea disabled="disabled" name="ana_impact" id="ana_impact" rows="5" style="width:100%"><?php print $rollback_plan; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px" height="40px"></td><td style="vertical-align:middle"  class="headers"><strong>Analyser</strong></td><td style="vertical-align:middle" class="data">: <?php print $analyser; ?></td><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>Analyzed Date</strong></td><td class="data">: <a href="#" title="Requested Time: <?php print $analyse_time; ?> "><?php print $analyse_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
</td></tr></table>
<br /><br />
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
<br />
<table cellspacing="0" cellpadding="0" border="1" width="100%" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">Approval</td></tr>
<tr><td>
    <div class="portlet">
		<div class="portlet-content nopadding">
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><br /><strong>Approval Comment</strong> <br /></span><textarea disabled="disabled" rows="5" style="width:100%"><?php print $approval_comment; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px" height="40px"></td><td style="vertical-align:middle" class="headers"><strong>Approver</strong></td><td style="vertical-align:middle" class="data">: <?php print $approved_by; ?></td><td width="200px"></td><td style="vertical-align:middle" class="headers"><strong>Approved Date</strong></td><td class="data">: <a href="#" title="Requested Time: <?php print $approved_time; ?> "><?php print $approved_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
</td></tr></table>
<br /><br />
            <!--THIS IS A PORTLET--> 

	<div class="clear"></div>
<br />
<table cellspacing="0" cellpadding="0" border="1" width="100%" ><tr><td bgcolor="silver" style="font-family:Arial, Helvetica, sans-serif; font-size:12pt; font-weight:bold; text-align:center">Implementer</td></tr>
<tr><td>
    <div class="portlet">
		<div class="portlet-content nopadding">
<br />
		<table width="100%" cellpadding="0" cellspacing="0" id="box-table-a" summary="Employee Pay Sheet">
			<tr><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>Implemented Date</strong></td><td class="data">: <?php print $implemented_date; ?></td><td width="50px"></td><td style="vertical-align:middle" class="headers">	<strong>Implementation Status</strong></td><td class="data">: <?php print $status0; ?></td><td width="50px"></td></tr>
			<tr><td width="50px"></td><td colspan="5"><span class="headers"><br /><strong>Comments</strong><br /></span><textarea name="imp_comm" id="imp_comm" rows="5" style="width:100%" disabled="disabled"><?php print $implementation_comment; ?></textarea><br /><br /></td><td width="50px"></td></tr>
			<tr bgcolor="silver"><td width="50px" height="40px"></td><td style="vertical-align:middle" class="headers"><strong>Implemented By</strong></td><td style="vertical-align:middle" class="data">: <?php print $implement_by; ?></td><td width="50px"></td><td style="vertical-align:middle" class="headers"><strong>CMS Completed Date</strong></td><td class="data">: <a href="#" title="Requested Time: <?php print $implemented_frm_time; ?> "><?php print $implemented_frm_date; ?></a></td><td width="50px"></td></tr>
		</table>
		</div>
      </div>
      </div>
</td></tr></table>
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