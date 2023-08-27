function validateLogin(){
	j=0;
	if((document.getElementById('passwd').value)==''){ j++; }
	if((document.getElementById('uname').value)==''){ j++; }
	if(j>0){ window.alert('Username or Password cannot be Blank'); return false;}
}

function deviceStatus($id,$status){
	document.getElementById('status'+$id).value=$status;
	if($status=='up'){
		document.getElementById("comment"+$id).innerHTML='';
		document.getElementById("yes"+$id).src='images/icons/action_check2.gif';
		document.getElementById("no"+$id).src='images/icons/action_delete.gif';
	}
	if($status=='down'){
		document.getElementById("comment"+$id).innerHTML='<input type="text" name="down_comment_'+$id+'" size="40" value="" placeholder="Comment" />';
		document.getElementById("no"+$id).src='images/icons/action_delete2.gif';
		document.getElementById("yes"+$id).src='images/icons/action_check.gif';
	}
}

function validateCheckList(){
	$list=document.getElementById('id_list').value;
	var $listarr = $list.split(",");
	$count=0;
	for($i=0;$i<($listarr.length-1);$i++){
		$status=document.getElementById('status'+$listarr[$i]).value;
		if(($status!='up')&&($status!='down')) $count++;
	}
	if($count>0){ window.alert('All Devices Must be Checked!'); return false;}
}

function approve($id,$action){
	$comment=document.getElementById('comment').value;
	window.location = 'index.php?components=checklist&action='+$action+'&id='+$id+'&comment='+$comment;
}

function limitModule(){
	$list=document.getElementById('id_list').value;
	var $listarr = $list.split(",");
	$count=0;
	for($i=0;$i<($listarr.length-1);$i++){
		if(document.getElementById('module'+$listarr[$i]).checked) $count++;
	}
	if($count>6){
		window.alert("You Cannot Enable more than 6 Modules!");
		return false;
	}
}

function addHint(destination,str){
	document.getElementById(destination).value=str;
}

function validateCreateUser(){
	var j=0;
	var msg='All fields must be filled';
		if((document.getElementById('u_name').value)==''){ j++; }
		if((document.getElementById('u_username').value)==''){ j++; }
		$type1=document.getElementById("type1").checked;
		$type2=document.getElementById("type2").checked;
		$pass1=document.getElementById('u_pass1').value;
		$pass2=document.getElementById('u_pass2').value;
		if(!$type1&&!$type2){ j++; }
		if($pass1==''){ j++; }
		if($pass2==''){ j++; }
		if($pass1!=$pass2){ j++; msg='Password Miss Match. Please Re-enter password'; }
	if(j>0){ window.alert(msg); return false;}
}

function validateEditUser(){
	var j=0;
	var msg='All fields must be filled';
		if((document.getElementById('u_name').value)==''){ j++; }
		$type1=document.getElementById("type1").checked;
		$type2=document.getElementById("type2").checked;
		if(!$type1&&!$type2){ j++; }
	if(j>0){ window.alert(msg); return false;}
}

function validateChangePwd(){
	var j=0;
	var msg='All fields must be filled';
		$pass1=document.getElementById('u_pass1').value;
		$pass2=document.getElementById('u_pass2').value;
		if($pass1==''){ j++; }
		if($pass2==''){ j++; }
		if($pass1!=$pass2){ j++; msg='Password Miss Match. Please Re-enter password'; }
	if(j>0){ window.alert(msg); return false;}
}

function validateAdUser(){
	var j=0;
	if((document.getElementById('username').value)==''){ j++; }
	if(j>0){ window.alert('User must be Selected'); return false;}
}

function ad_deleteuser(id){
	var check= confirm("Do you really want remove this user from APP Admins ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=ad_deleteuser&id='+id;
}

function cl_removeuser(id,type){
	var check= confirm("Do you really want remove this user from this Group ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=cl_removeuser&id='+id+'&type='+type;
}

function cl_reopen(){
	$reopen=document.getElementById('checklist_reopen').checked;
	window.location = 'index.php?components=settings&action=cl_reopen&reopen='+$reopen;
}

function updateClclose(){
	var j=0;
	$cl_close=document.getElementById('cl_close').value;
	if($cl_close==''){ j++; }
	if($cl_close.indexOf(":")=='-1'){ j++; }
	if(j==0){ 
		window.location = 'index.php?components=settings&action=cl_closetime&cl_close='+$cl_close;
	}else{
		window.alert('Invalid Time Format. Time should be given in 24H. (eg:- 14:00');
	}
}

function device_decommission(id){
	var check= confirm("Decommission the device. This will not delete any previous data. Also, you can make it active later time.");
 if (check== true)
	window.location = 'index.php?components=settings&action=device_decommission&id='+id;
}

function device_dev_delete(id){
	var check= confirm("All related checklists should be deleted manually, inorder to delete the Device.");
 if (check== true)
	window.location = 'index.php?components=settings&action=device_dev_delete&id='+id;
}

function device_dev_decommission(id){
	var check= confirm("Decommission the device. This will not delete any previous data. Also, you can make it active later time.");
 if (check== true)
	window.location = 'index.php?components=settings&action=device_decommission&id='+id;
}

function validateDev1(){
	j=0;
	if((document.getElementById('dname').value)==''){ j++; }
	if((document.getElementById('dtype').value)==''){ j++; }
	if((document.getElementById('dip1').value)==''){ j++; }
	if(j>0){ window.alert('Device Name & primary IP should not be Blank !'); return false;}
}

function DeleteChecklist(id){
	var check= confirm("Do you really want Delete this Checklist ?");
 if (check== true)
	window.location = 'index.php?components=checklist&action=delete_checklist&id='+id;
}

function workingdays(){
	var days='';
	if(document.getElementById('sun').checked) days='1,';
	if(document.getElementById('mon').checked) days+='2,';
	if(document.getElementById('tue').checked) days+='3,';
	if(document.getElementById('wed').checked) days+='4,';
	if(document.getElementById('thu').checked) days+='5,';
	if(document.getElementById('fri').checked) days+='6,';
	if(document.getElementById('sat').checked) days+='7,';
	days = days.substring(0, days.length - 1);
	window.location = 'index.php?components=settings&action=cl_workingdays&days='+days;
}

//--------------------------------------CMS------------------------------------------//

function changeSystemType(){
	if((document.getElementById('system_type').value)==1){ 
		document.getElementById("temp").value=document.getElementById("systemname").innerHTML;
		document.getElementById("div1").innerHTML='System Type <br /><br />System Name <br /><br /> IP Address';
		document.getElementById("systemname").innerHTML='<select name="ns_type" id="ns_type"><option value="">-SELECT-</option><option value="1">Server</option><option value="2">Network Device</option><option value="3">Application</option><option value="4">Other</option></select><br /><br /><input type="text" name="ns_name" id="system_list1" /><br /><input type="text" name="ns_ip" id="ns_ip" />';
		document.getElementById("system_list1_div").innerHTML='';
		document.getElementById("system_list").innerHTML='';
	}
	if((document.getElementById('system_type').value)==2){ 
		if(document.getElementById("temp").value!='')
			document.getElementById("systemname").innerHTML=document.getElementById("temp").value;
			document.getElementById("div1").innerHTML='Name Of the System';
			document.getElementById("system_list1_div").innerHTML='<input type="hidden" id="system_list1" name="system_list1" value="" />';
	}
}

function validateCMSRequest(){
	j=0;
	if((document.getElementById('system_type').value)==''){ j++; }
	if((document.getElementById('system_list1').value)==''){ j++; }
	if((document.getElementById('cr_priority').value)==''){ j++; }
	if((document.getElementById('app_date').value)==''){ j++; }
	if((document.getElementById('ana_team').value)==''){ j++; }
	if((document.getElementById('cr_description').value)==''){ j++; }
	if((document.getElementById('cr_bisscase').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function validateCMSAnalyze(){
	j=0;
	if((document.getElementById('app_date').value)==''){ j++; }
	if((document.getElementById('ana_priority').value)==''){ j++; }
	if((document.getElementById('imp_by').value)==''){ j++; }
	if((document.getElementById('ana_spec').value)==''){ j++; }
	if((document.getElementById('ana_impact').value)==''){ j++; }
	if((document.getElementById('ana_rollback').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function approveCMS($id,$action){
	$comment=document.getElementById('approver_comm').value;
	window.location = 'index.php?components=cms&action='+$action+'&id='+$id+'&comment='+$comment;
}

function validateCMSImplement(){
	j=0;
	if((document.getElementById('app_date').value)==''){ j++; }
	if((document.getElementById('imp_status').value)==''){ j++; }
	if((document.getElementById('imp_comm').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function CMSFilter(){
	$filter=document.getElementById('filter').value;
	window.location = 'index.php?components=cms&action=list_list&filter='+$filter;
}

function validateUser1(){
	j=0;
	if((document.getElementById('username1').value)==''){ j++; }
	if(j>0){ window.alert('Username Cannot be Empty !'); return false;}
}

function validateUser2(){
	j=0;
	if((document.getElementById('ana_team').value)==''){ j++; }
	if((document.getElementById('username2').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function validateUser3(){
	j=0;
	if((document.getElementById('username3').value)==''){ j++; }
	if(j>0){ window.alert('Username Cannot be Empty !'); return false;}
}

function validateUser4(){
	j=0;
	if((document.getElementById('username4').value)==''){ j++; }
	if(j>0){ window.alert('Username Cannot be Empty !'); return false;}
}

function validateUser5(){
	j=0;
	if((document.getElementById('username2').value)==''){ j++; }
	if(j>0){ window.alert('Username Cannot be Empty !'); return false;}
}

function validateUser5(){
	j=0;
	if((document.getElementById('username5').value)==''){ j++; }
	if(j>0){ window.alert('Username Cannot be Empty !'); return false;}
}

function validateEMPUpdate(){
	$emp_status=document.getElementById('emp_status').value;
	$res_date=document.getElementById('res_date').value;
	if($emp_status==0){
		if($res_date==''){
			window.alert('Resigned Date Cannot be Empty !'); return false;
		}else{
			return true;
		}
	}else{
		return true;
	}
}

function cms_removeuser(id,type){
	var check= confirm("Do you really want remove this user from this Group ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=cms_removeuser&id='+id+'&type='+type;
}

function inc_removeuser(id,type){
	var check= confirm("Do you really want remove this user from this Group ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=inc_removeuser&id='+id+'&type='+type;
}

function inv_removeuser(id,type){
	var check= confirm("Do you really want remove this user from this Group ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=inv_removeuser&id='+id+'&type='+type;
}

function DeleteCMS(id){
	var check= confirm("Do you really want Delete this CMS ?");
 if (check== true)
	window.location = 'index.php?components=cms&action=delete_cms&id='+id;
}

function Search(component){
	j=0;
	$id=document.getElementById('search').value;
	if($id==''){ j++; }
	if(j==0) window.location = 'index.php?components='+component+'&action=list_search&id='+$id+'&filter=all';
}

function getReport(components){
	var j=0;
		$report_type=document.getElementById('report_type').value;
		$year=document.getElementById('year').value;
		if($report_type==''){ j++; }
		if($year==''){ j++; }
	if(j==0){ 
	window.location = 'index.php?components='+components+'&action=get_report&type='+$report_type+'&year='+$year+'&filter=all';
	}
}

function getReport2(component,filter){
	var j=0;
		$report_type=document.getElementById('report_type').value;
		$device=document.getElementById('devid').value;
		$year=document.getElementById('year').value;
		if($report_type==''){ j++; }
		if($device==''){ j++; }
		if($year==''){ j++; }
	if(j==0){ 
	window.location = 'index.php?components='+component+'&action=get_report&type='+$report_type+'&year='+$year+'&device='+$device+'&filter='+filter;
	}
}

function selectDate(date){
	var d = new Date(date);
	var n = d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
	document.getElementById('app_date').value=n;
}

function cmsDeleteteam(id){
	var check= confirm("Do you really want Delete this Team ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=cms_deleteteam&id='+id;
}
//--------------------------------------Incident------------------------------------------//

function validateIncidentForm(){
	j=0;
	if((document.getElementById('system').value)==''){ j++; }
	if((document.getElementById('severity').value)==''){ j++; }
	if((document.getElementById('category').value)==''){ j++; }
	if((document.getElementById('app_date').value)==''){ j++; }
	if((document.getElementById('title').value)==''){ j++; }
	if((document.getElementById('description').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function incidentFilter(){
	$filter=document.getElementById('filter').value;
	window.location = 'index.php?components=incident&action=list_list&filter='+$filter;
}

function approveIncident($id,$action){
	$comment=document.getElementById('approver_comm').value;
	window.location = 'index.php?components=incident&action='+$action+'&id='+$id+'&comment='+$comment;
}

function validateCategory(){
	j=0;
	if((document.getElementById('category').value)==''){ j++; }
	if(j>0){ window.alert('All fields must be filled !'); return false;}
}

function incDeletecategory(id){
	var check= confirm("Do you really want Delete this CATEGORY ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=inc_delete_category&id='+id;
}

function inc_removeuser(id,type){
	var check= confirm("Do you really want remove this user from this Group ?");
 if (check== true)
	window.location = 'index.php?components=settings&action=inc_removeuser&id='+id+'&type='+type;
}


function DeleteIncident(id){
	var check= confirm("Do you really want Delete this Incident ?");
 if (check== true)
	window.location = 'index.php?components=incident&action=delete_incident&id='+id;
}

function emailSubscription($authid){
	$subscription=document.getElementById("subscription"+$authid).checked;
	if($subscription) $action='enable_emailalert'; else $action='disable_emailalert';
	window.location = 'index.php?components=settings&action='+$action+'&authid='+$authid;
}

//-------------------------Update ----------------------------//

function updateNow(update_id){
	var check= confirm('Do you want to perform update '+update_id+' Now ?');
 if (check== true)
	window.location = 'index.php?components=dashboard&action=update_now&up_uid='+update_id;
}

function addSystem(){
	var str=document.getElementById('system_name').value;
	var list=document.getElementById('system_list1').value;
	if(str.length>8) var len=str.length*6; else var len=str.length*8;
	var systemid=str.substring(0,(str.indexOf(',')));
	var systemname=str.substring((str.indexOf(',')+1),str.length);
	var item='<div id="uid'+systemid+'" ><div class="system_select" style="width:'+len+'px">'+systemname+'<a class="system_remove" onclick="removeSystem('+systemid+')" title="Remove System">x</a></div></div>';
	//window.alert(systemname);
	$selected_systems=document.getElementById("system_list").innerHTML;
	document.getElementById("system_list").innerHTML=$selected_systems+item;
	if(list=='')document.getElementById('system_list1').value=systemid;
	else document.getElementById('system_list1').value=list+','+systemid;
}

function removeSystem($id){
	var listarr = document.getElementById('system_list1').value.split(",");
	var item=listarr.indexOf(String($id));
	listarr.splice(item,1);
	document.getElementById('system_list1').value=listarr.join();
	document.getElementById("uid"+$id).innerHTML='';
}

function validateCreateAsset(){
	var j=0;
	var msg='All fields must be filled except Asset ID';
		if((document.getElementById('ass_type').value)==''){ j++; }
		if((document.getElementById('asset_name').value)==''){ j++; }
		if((document.getElementById('asset_sn').value)==''){ j++; }
		if((document.getElementById('ass_location').value)==''){ j++; }
	if(j>0){ window.alert(msg); return false;}
}

function validateMapAsset(){
	var j=0;
	var msg='Employee and Asset Serial Number Must be Filled';
		if((document.getElementById('employee').value)==''){ j++; }
		if((document.getElementById('assete').value)==''){ j++; }
	if(j>0){ window.alert(msg); return false;}
}


function assetRemoveMapping(id){
	var check= confirm('Do you want to remove this Asset from the User? ');
 if (check== true)
	window.location = 'index.php?components=inventory&action=remove_mapping&id='+id;
}

function assetDeleteMapping(asi_id,ass_id){
	var check= confirm('Do you want to Delete this Asset Mapping Record? ');
 if (check== true)
	window.location = 'index.php?components=inventory&action=delete_mapping&asi_id='+asi_id+'&ass_id='+ass_id;
}

function InventoryFilter(){
	$filter=document.getElementById('filter').value;
	window.location = 'index.php?components=inventory&action=list_list&type='+$filter;
}

function addTonerName(){
	j=0;
	if((document.getElementById('toner_name').value)==''){ j++; }
	if(j>0){ window.alert('Please Fill Name Of the Toner'); return false;}
}

function addTonerInventory(){
	j=0;
	if((document.getElementById('toner_id').value)==''){ j++; }
	if((document.getElementById('toner_qty').value)==''){ j++; }
	if((document.getElementById('purchased_price').value)==''){ j++; }
	if(j>0){ window.alert('Please Fill "Toner Name" and "Toner Qty"'); return false;}
}

function allocateToner(){
	j=0;
	if((document.getElementById('location_id').value)==''){ j++; }
	if((document.getElementById('toner_id').value)==''){ j++; }
	if((document.getElementById('date').value)==''){ j++; }
	if((document.getElementById('qty').value)==''){ j++; }
	if(j>0){ window.alert('Please Fill the details of Allocation'); return false;}
}

function deleteTonerName(id){
	var check= confirm('Do you want to Deactivate this Toner? ');
 if (check== true)
	window.location = 'index.php?components=inventory&action=delete_toner_name&id='+id;
}


