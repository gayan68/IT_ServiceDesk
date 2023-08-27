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
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Change Requester</strong>
	<br /><span style="color:#666666; font-size:9pt;">User from Active Directory (Domain) or Standalone users can be binned as "Change Requesters" from Here</span></p>
        <form action="index.php?components=settings&action=cms_adduser&level=Requester" method="post" onsubmit="return validateUser1()"  >
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
					<?php  for($i=0;$i<sizeof($cuser_id['Requester']);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Requester'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="cms_removeuser('."'".$cuser_id['Requester'][$i]."','Requester'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>

<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Analysis</strong>
	<br /><span style="color:#666666; font-size:9pt;">User from Active Directory (Domain) or Standalone users can be binned as "Change Request Analysis" from Here</span></p>
        <form action="index.php?components=settings&action=cms_adduser&level=Analysis" method="post" onsubmit="return validateUser2()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="5%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Team (Member of)</td><td width="20px"></td>
					<td style="vertical-align:middle">
						<select id="ana_team" name="ana_team">
							<option value="">-SELECT-</option>
						<?php for($i=0;$i<sizeof($team_id);$i++)
								print '<option value="'.$team_id[$i].'">'.$team_name[$i].'</option>';
						?>
						</select>
					</td><td width="30px"></td><td>
					</td></tr>
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
					<table id="box-table-b" width="100%">
					<?php  for($i=0;$i<sizeof($cuser_id['Analysis']);$i++){
								print '<tr><td width="10px"></td><td>'.$cuser_username['Analysis'][$i].'</td><td width="10px"></td><td>'.$cuser_subteam['Analysis'][$i].'</td><td width="10px"></td><td width="30px"><a href="#" onclick="cms_removeuser('."'".$cuser_id['Analysis'][$i]."','Analysis'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
        
<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Approver</strong>

		<p style="padding-left:30px">User from Active Directory (Domain) or Standalone users can be binned as "Change Request Approvers" from Here <br /> Also, Approvers can view approved CR and reports</p>
        <form action="index.php?components=settings&action=cms_adduser&level=Approver2" method="post" onsubmit="return validateUser3()"  >
          <table width="100%" cellpadding="0" cellspacing="0" >
				<tr><td width="10%"></td><td width="40%">
					<table>
					<tr><td style="vertical-align:middle">Username</td><td width="20px"></td>
					<td style="vertical-align:middle">
	            
					<nav>
					    <ul>
					        <li>
					            <a><input type="text" name="username" id="username3" onkeyup="showHint('list3','username3',this.value)" /></a>
					            <ul id="list3">
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
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Approver'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="cms_removeuser('."'".$cuser_id['Approver'][$i]."','Approver'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
        
<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Implementer</strong>

		<p style="padding-left:30px">User from Active Directory (Domain) or Standalone users can be binned as "Implementers" from Here</p>
        <form action="index.php?components=settings&action=cms_adduser&level=Implementer" method="post" onsubmit="return validateUser4()"  >
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
					<?php  for($i=0;$i<sizeof($cuser_id['Implementer']);$i++){
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Implementer'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="cms_removeuser('."'".$cuser_id['Implementer'][$i]."','Implementer'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>


<table width="100%"><tr><td style="height:10px; background-color:#DDDDDD"></td></tr></table>
	<p style="padding-left:30px; font-size:11pt; color:#3C5F93;"><strong>Auditor</strong>

		<p style="padding-left:30px">User from Active Directory (Domain) or Standalone users can be binned as "Auditors" from Here <br /> Auditor can view reports</p>
        <form action="index.php?components=settings&action=cms_adduser&level=Auditor" method="post" onsubmit="return validateUser5()"  >
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
								print '<tr><td width="50px"></td><td width="150px">'.$cuser_username['Auditor'][$i].'</td><td width="10px"></td><td width="130px"><a href="#" onclick="cms_removeuser('."'".$cuser_id['Auditor'][$i]."','Auditor'".')" title="Remove User from Checklist" ><img src="images/icons/action_delete.gif" /></a></td></tr>';
							} ?>
					</table>
				</td></tr>
          </table>
        </form>
		</div>
      </div>
<!--  END #PORTLETS -->  
