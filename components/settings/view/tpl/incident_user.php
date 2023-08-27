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
        <div class="portlet-header fixed"><img src="images/icons/user.gif" width="16" height="16"/>User Permission</div>
		<div class="portlet-content nopadding">
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Incident Submitter</strong>
	<br /><span style="color:#666666; font-size:9pt;">User from Active Directory (Domain) or Standalone users can be binned as "Submitters" from Here</span></p>
        <form action="index.php?components=settings&action=inc_adduser&level=Submitter" method="post" onsubmit="return validateUser()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Username</td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="username" id="username1" onkeyup="showHint('list1','username1',this.value)" /></a>
					            <ul id="list1">
					            </ul>
					        </li>
					    </ul>
					</nav> 
					</td><td width="30px"></td><td>
					<input type="submit"  style="width:50px; height:50px; background-color:inherit; border:none;  background-image:url('images/icons/arrow01.png'); cursor:pointer;"  value="" />
					</td></tr>
					<!--<tr><td colspan="5"><p>Suggestions: <span id="txtHint"></span></p></td></tr>-->
					</table>
				</td><td width="40%" style="vertical-align:top;">
				<!-- ---------------List Admin permited Domain Accounts ------------------------>
					<table id="box-table-b">
					<?php  for($i=0;$i<sizeof($cuser_id['Submitter']);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Submitter'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="inc_removeuser('."'".$cuser_id['Submitter'][$i]."','Submitter'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>

<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Incident Approver</strong>
	<br /><span style="color:#666666; font-size:9pt;">User from Active Directory (Domain) or Standalone users can be binned as "Approvers" from Here</span></p>
        <form action="index.php?components=settings&action=inc_adduser&level=Approver" method="post" onsubmit="return validateUser()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Username</td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="username" id="username2" onkeyup="showHint('list2','username2',this.value)" /></a>
					            <ul id="list2">
					            </ul>
					        </li>
					    </ul>
					</nav> 
					</td><td width="30px"></td><td>
					<input type="submit"  style="width:50px; height:50px; background-color:inherit; border:none;  background-image:url('images/icons/arrow01.png'); cursor:pointer;"  value="" />
					</td></tr>
					<!--<tr><td colspan="5"><p>Suggestions: <span id="txtHint"></span></p></td></tr>-->
					</table>
				</td><td width="40%" style="vertical-align:top;">
				<!-- ---------------List Admin permited Domain Accounts ------------------------>
					<table id="box-table-b">
					<?php  for($i=0;$i<sizeof($cuser_id['Approver']);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Approver'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="inc_removeuser('."'".$cuser_id['Approver'][$i]."','Approver'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
        
       
<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Auditor</strong>

		<p style="padding-left:30px">User from Active Directory (Domain) or Standalone users can be binned as "Auditors" from Here <br /> Auditor can view reports</p>
        <form action="index.php?components=settings&action=inc_adduser&level=Auditor" method="post" onsubmit="return validateUser()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Username</td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="username" id="username4" onkeyup="showHint('list4','username4',this.value)" /></a>
					            <ul id="list4">
					            </ul>
					        </li>
					    </ul>
					</nav> 
					</td><td width="30px"></td><td>
					<input type="submit"  style="width:50px; height:50px; background-color:inherit; border:none;  background-image:url('images/icons/arrow01.png'); cursor:pointer;"  value="" />
					</td></tr>
					<!--<tr><td colspan="5"><p>Suggestions: <span id="txtHint"></span></p></td></tr>-->
					</table>
				</td><td width="40%" style="vertical-align:top;">
				<!-- ---------------List Admin permited Domain Accounts ------------------------>
					<table id="box-table-b">
					<?php  for($i=0;$i<sizeof($cuser_id['Auditor']);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Auditor'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="inc_removeuser('."'".$cuser_id['Auditor'][$i]."','Approver'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
