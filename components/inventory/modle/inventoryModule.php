<?php
function setTimezone(){
	include('config.php');
	$queryt="SELECT value FROM setting WHERE setting='timezone'";
	$resultt = $conn->query($queryt);
	$timezone=mysqli_fetch_row($resultt);
	date_default_timezone_set("$timezone[0]");
}

function getAssLocation(){
global $ass_location_id,$ass_location_name;
	include('config.php');
	$query="SELECT id,name FROM inv_location WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$ass_location_id[]=$row['id'];
		$ass_location_name[]=$row['name'];
	} 
}

function getDepartments(){
global $dep_id,$dep_name;
	include('config.php');
	$query="SELECT id,name FROM inv_department WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$dep_id[]=$row['id'];
		$dep_name[]=$row['name'];
	} 
}

function getAssStatus(){
global $ast_id,$ast_status;
	include('config.php');
	$query="SELECT id,`status` FROM inv_asset_status";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$ast_id[]=$row['id'];
		$ast_status[]=$row['status'];
	} 
}

function getAssType(){
global $ass_type_id,$ass_type_name;
	include('config.php');
	$query="SELECT id,name FROM inv_asset_type";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$ass_type_id[]=$row['id'];
		$ass_type_name[]=$row['name'];
	} 
}

function getFormData(){
	global $tb_asi_id,$tb_ast_name,$tb_ass_id,$tb_emp_name,$tb_dep_name,$tb_ass_name,$tb_ass_sn,$tb_ass_st;
	include('config.php');
	
	$query="SELECT asi.id,ast.name as `astname`,ass.asset_id,emp.name as `empname`,asl.name as `aslname`,ass.name as `assname`,ass.serial_number,ass.`status` FROM inv_assignment asi, inv_asset ass, inv_asset_type ast, inv_employee emp, inv_location asl WHERE asi.asset=ass.id AND asi.employee=emp.id AND ass.`type`=ast.id AND ass.location=asl.id AND asi.`status`=1 ORDER BY asi.id DESC LIMIT 30";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$tb_asi_id[]=$row['id'];
		$tb_ast_name[]=$row['astname'];
		$tb_ass_id[]=$row['asset_id'];
		$tb_emp_name[]=$row['empname'];
		$tb_dep_name[]=$row['aslname'];
		$tb_ass_name[]=$row['assname'];
		$tb_ass_sn[]=$row['serial_number'];
		$tb_ass_st[]=$row['status'];
	}
}

function oneAsset(){
global $one_type,$one_asset_id,$one_sn,$one_name,$one_location,$one_pudate,$one_sodate,$one_comment,$one_status;
	$id=$_GET['id'];
	include('config.php');
	$query="SELECT `type`,asset_id,serial_number,name,location,purchased_date,cancelsold_date,comment,`status` FROM inv_asset WHERE id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$one_type=$row['type'];
		$one_asset_id=$row['asset_id'];
		$one_sn=$row['serial_number'];
		$one_name=$row['name'];
		$one_location=$row['location'];
		$one_pudate=$row['purchased_date'];
		$one_sodate=$row['cancelsold_date'];
		$one_comment=$row['comment'];
		$one_status=$row['status'];
	}
}

function adQuery(){
	$person = $_REQUEST["q"];
	$hint = "";
	if(strlen($person)>2){
	include('config.php');
	$query0="SELECT `value` FROM setting WHERE `setting`='ldap_server'";
	$result0 = $conn->query($query0);
	$ldap_srv0=mysqli_fetch_row($result0);
	$s1=(stripos($ldap_srv0[0],'.')+1);
	$s2=stripos($ldap_srv0[0],'.',$s1);
	$dn=substr($ldap_srv0[0],$s1,$s2-$s1);
	
	$adServer='ldap://'.$ldap_srv0[0];
	$pos=strpos($ldap_srv0[0],'.');
	$primary_dn=substr($ldap_srv0[0],$pos+1,(strlen($ldap_srv0[0])-$pos));
	$primary_dn='dc='.str_replace('.',',dc=',$primary_dn);
 	
	$query0="SELECT `value` FROM setting WHERE `setting`='ad_accout'";
	$result0 = $conn->query($query0);
	$ldap_acc=mysqli_fetch_row($result0);
 	
	$query0="SELECT `value` FROM setting WHERE `setting`='ad_pass'";
	$result0 = $conn->query($query0);
	$ldap_pass=mysqli_fetch_row($result0);

	$username=$ldap_acc[0];
	$password=strrev($ldap_pass[0]);
//  $adServer = "ldap://dc.goic.goic.org.qa";
//	$primary_dn="dc=goic,dc=goic,dc=org,dc=qa";
    $ldap = ldap_connect($adServer);
    $ldaprdn = $dn. "\\" . $username;
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    $bind = @ldap_bind($ldap, $ldaprdn, $password);
    $justthese = array("sn", "samaccountname");
    $filter="(|(sn=$person*)(givenname=$person*))";
    
    if ($bind) {
       $result = ldap_search($ldap,$primary_dn,$filter, $justthese);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
		for ($i=0; $i < $info["count"]; $i++) {
			if(isset($info[$i]["samaccountname"][0]))
			$key2=strpos($info[$i]["dn"],",") - 3;
			$dn=substr($info[$i]["dn"],3,$key2);

			$hint0[]=$dn;
		   // print_r($info[$i]);
		$hint0=(array_unique($hint0));
		$hint= implode(',', $hint0);
		}  
		//print $hint; 
		@ldap_close($ldap);
	}
	}
	return $hint;
}

function assetQuery(){
	$sn = $_REQUEST["q"];
	$hint = "";
	$hint0=array();
	if(strlen($sn)>2){
	include('config.php');
	$query="SELECT id,serial_number FROM inv_asset WHERE serial_number LIKE '%$sn%'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$tmp_assetid=$row['id'];
		
		$query0="SELECT count(id) FROM inv_assignment WHERE `status`=1 AND asset='$tmp_assetid'";
		$result0 = $conn->query($query0);
		$count0=mysqli_fetch_row($result0);
		$count=$count0[0];
		if($count==0){
		$hint0[]=$row['serial_number'];
		}
	}
	}
	$hint= implode(',', $hint0);
	return $hint;
}

function createAsset(){
	global $message;
	include('config.php');
	setTimezone();	
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$ass_type=$_REQUEST['ass_type'];
	$asset_id=$_REQUEST['asset_id'];
	$asset_name=$_REQUEST['asset_name'];
	$asset_sn=$_REQUEST['asset_sn'];
	$purchased_on=$_REQUEST['purchased_on'];
	$ass_location=$_REQUEST['ass_location'];
	$asset_comment=$_REQUEST['asset_comment'];
	$ass_status=$_REQUEST['ass_status'];
	$proceed=true;
	
	$query0="SELECT COUNT(id) FROM inv_asset WHERE asset_id='$asset_id'";
	$result0 = $conn->query($query0);
	$count10=mysqli_fetch_row($result0);
	$count1=$count10[0];
	if($count1>0){ $msg='Duplicated Asset ID Found'; $proceed=false; }
	if($asset_id=='') $proceed=true;
	$query0="SELECT COUNT(id) FROM inv_asset WHERE serial_number='$asset_sn'";
	$result0 = $conn->query($query0);
	$count20=mysqli_fetch_row($result0);
	$count2=$count20[0];
	if($count2>0){ $msg='Duplicated Asset Serial Found'; $proceed=false; }
	
	if($proceed){
		$query="INSERT INTO `inv_asset` ( `type`,`asset_id`,`serial_number`,`name`,`location`,`added_date`,`purchased_date`,`added_by`,`comment`,`status`) VALUES ('$ass_type','$asset_id','$asset_sn','$asset_name','$ass_location','$date','$purchased_on','$user','$asset_comment','$ass_status')";
		$result = $conn->query($query);
	
		if($result){
			$message='Asset was Added Successfully'; 
			return true;
		}else{
			$message='Error ! Asset could not be Added !';
			return false;
		}
	}else{
		$message='Error ! '.$msg.' !';
		return false;
	}
}

function updateAsset(){
	global $message,$id;
	include('config.php');
	setTimezone();	
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$id=$_REQUEST['id'];
	$ass_type=$_REQUEST['ass_type'];
	$asset_id=$_REQUEST['asset_id'];
	$asset_name=$_REQUEST['asset_name'];
	$asset_sn=$_REQUEST['asset_sn'];
	$purchased_on=$_REQUEST['purchased_on'];
	$so_on=$_REQUEST['so_on'];
	$ass_location=$_REQUEST['ass_location'];
	$asset_comment=$_REQUEST['asset_comment'];
	$ass_status=$_REQUEST['ass_status'];
	$proceed=true;
	if(($ass_status==2)||($ass_status==4))	$cancelsold_date=$so_on; else $cancelsold_date=NULL;
	
	$query0="SELECT COUNT(id) FROM inv_asset WHERE asset_id='$asset_id' AND id!='$id'";
	$result0 = $conn->query($query0);
	$count10=mysqli_fetch_row($result0);
	$count1=$count10[0];
	if($count1>0){ $msg='Duplicated Asset ID Found'; $proceed=false; }
	if($asset_id=='') $proceed=true;
	$query0="SELECT COUNT(id) FROM inv_asset WHERE serial_number='$asset_sn' AND id!='$id'";
	$result0 = $conn->query($query0);
	$count20=mysqli_fetch_row($result0);
	$count2=$count20[0];
	if($count2>0){ $msg='Duplicated Asset ID Found'; $proceed=false; }

	if($proceed){
		$query0="SELECT `status` FROM inv_asset WHERE id='$id'";
		$result0 = $conn->query($query0);
		$current_status0=mysqli_fetch_row($result0);
		$current_status=$current_status0[0];
		if($current_status!=$ass_status) $status_qry="`status_changed_by`='$user',"; else $status_qry="";
		
		$query="UPDATE `inv_asset` SET `type`='$ass_type',`asset_id`='$asset_id',`serial_number`='$asset_sn',`name`='$asset_name',`location`='$ass_location',`purchased_date`='$purchased_on',`cancelsold_date`='$cancelsold_date',`comment`='$asset_comment' ,$status_qry `status`='$ass_status' WHERE id='$id'";
		$result = $conn->query($query);
		if($result){
			$message='Asset was Updated Successfully'; 
			return true;
		}else{
			$message='Error ! Asset could not be Updated !';
			return false;
		}
	}else{
		$message='Error ! '.$msg.' !';
		return false;
	}
}

function updateAsset2(){
	global $message,$id;
	include('config.php');
	setTimezone();	
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$id=$_REQUEST['id'];
	$ass_type=$_REQUEST['ass_type'];
	$ass_location=$_REQUEST['ass_location'];
	$asset_comment=$_REQUEST['asset_comment'];
	$ass_status=$_REQUEST['ass_status'];
	if(($ass_status==2)||($ass_status==4))	$cancelsold_date=$date; else $cancelsold_date='NULL';
	
		$query0="SELECT `status` FROM inv_asset WHERE id='$id'";
		$result0 = $conn->query($query0);
		$current_status0=mysqli_fetch_row($result0);
		$current_status=$current_status0[0];
		if($current_status!=$ass_status) $status_qry="`status_changed_by`='$user',"; else $status_qry="";
		
		$query="UPDATE `inv_asset` SET `type`='$ass_type',`location`='$ass_location',`cancelsold_date`='$cancelsold_date',`comment`='$asset_comment' ,$status_qry `status`='$ass_status' WHERE id='$id'";
		print $query;
		$result = $conn->query($query);
		if($result){
			$message='Asset was Updated Successfully'; 
			return true;
		}else{
			$message='Error ! Asset could not be Updated !';
			return false;
		}
}

function mapAsset(){
	global $message;
	include('config.php');
	setTimezone();	
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$employee=$_REQUEST['employee'];
	$sn=$_REQUEST['assete'];
	
	$query0="SELECT `id` FROM inv_asset WHERE `serial_number`='$sn'";
	$result0 = $conn->query($query0);
	$asset0=mysqli_fetch_row($result0);
	$asset=$asset0[0];
	$query0="SELECT id FROM inv_employee WHERE name='$employee'";
	$result0 = $conn->query($query0);
	$emp0=mysqli_fetch_row($result0);
	$emp=$emp0[0];
	$query0="SELECT COUNT(id) FROM inv_assignment WHERE `status`=1 AND asset='$asset'";
	$result0 = $conn->query($query0);
	$ass_count0=mysqli_fetch_row($result0);
	$ass_count=$ass_count0[0];
	
	if($ass_count==0){
		if($emp==''){
			$query="INSERT INTO `inv_employee` ( `name`,`status`) VALUES ('$employee','1')";
			$result = $conn->query($query);
			$emp = $conn->insert_id;
		}
		if($asset!=''){
			$query="INSERT INTO `inv_assignment` ( `asset`,`employee`,`assigned_date`,`assigned_by`,`status`) VALUES ('$asset','$emp','$date','$user','1')";
			$result = $conn->query($query);
			if($result){
				$message='Asset was Mapped Successfully'; 
				return true;
			}else{
				$message='Error ! Asset could not be Mapped !';
				return false;
			}
		}else{
				$message='Error ! Asset does not exist !';
				return false;
			}
	}else{
			$message='Error ! Asset is Already Mapped !';
			return false;
	}
}

function removeAsset(){
	global $message;
	include('config.php');
	setTimezone();
	$id=$_GET['id'];
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	
	$query="UPDATE `inv_assignment` SET `status`='0',`removed_by`='$user',`removed_date`='$date' WHERE id='$id'";
	$result = $conn->query($query);
	if($result){
		$message='Asset Mapping was Removed Successfully'; 
		return true;
	}else{
		$message='Error ! Asset Mapping could not be Removed !';
		return false;
	}
}

function deleteMapping(){
	global $message,$ass_id;
	include('config.php');
	setTimezone();
	$asi_id=$_GET['asi_id'];
	$ass_id=$_GET['ass_id'];

	$query="DELETE FROM `inv_assignment` WHERE id='$asi_id'";
	$result = $conn->query($query);
	if($result){
		$message='Asset Mapping Recod was Deleted Successfully'; 
		return true;
	}else{
		$message='Error ! Asset Mapping Recod could not be Deleted!';
		return false;
	}
}

function getAssetList(){
	global $tb_ass_comment,$type,$filter_emp,$filter_sn,$filter_device,$filter_assid,$filter_type,$filter_status,$filter_location,$type,$st1,$color1,$tb_asset_id,$tb_ass_sn,$tb_ass_name,$tb_ass_pudate,$tb_location,$tb_ass_st,$tb_emp_name,$tb_emp_rdate,$tb_emp_st,$type_id,$type_name,$tb_ass_id;
	$location_qry=$filter_location=$status_qry=$filter_status=$type_qry=$filter_type=$filter_assid=$assid_qry=$filter_device=$device_qry=$sn_qry=$filter_sn=$filter_emp=$emp_qry='';
	if(isset($_REQUEST['filter_type'])){ $filter_type=$_REQUEST['filter_type']; if($filter_type!='')  $type_qry="ass.`type`='$filter_type' AND"; }
	if(isset($_REQUEST['filter_location'])){ $filter_location=$_REQUEST['filter_location']; if($filter_location!='')  $location_qry="ass.location='$filter_location' AND"; }
	if(isset($_REQUEST['filter_status'])){ $filter_status=$_REQUEST['filter_status']; if($filter_status!='')  $status_qry="ass.`status`='$filter_status' AND"; }
	if(isset($_REQUEST['filter_assid'])){ $filter_assid=$_REQUEST['filter_assid']; if($filter_assid!='')  $assid_qry="ass.`asset_id` LIKE '%$filter_assid%' AND"; }
	if(isset($_REQUEST['filter_device'])){ $filter_device=$_REQUEST['filter_device']; if($filter_device!='')  $device_qry="ass.`name` LIKE '%$filter_device%' AND"; }
	if(isset($_REQUEST['filter_sn'])){ $filter_sn=$_REQUEST['filter_sn']; if($filter_sn!='')  $sn_qry="ass.`serial_number` LIKE '%$filter_sn%' AND"; }
	if(isset($_REQUEST['filter_emp'])){ $filter_emp=$_REQUEST['filter_emp']; }
	include('config.php');
	$k=0;
	$emp_rdate='';
	if($filter_type!=''){
	$query0="SELECT name FROM inv_asset_type WHERE id=$filter_type";
	$result0 = $conn->query($query0);
	$type0=mysqli_fetch_row($result0);
	$type=$type0[0];
	}else $type='ALL';

	$query="SELECT id, name FROM inv_asset_type ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$type_id[]=$row['id'];
		$type_name[]=$row['name'];
	}
	if($filter_emp!=''){
		$filter_users=array();
		$query="SELECT asi.asset FROM inv_employee emp, inv_assignment asi  WHERE asi.employee=emp.id AND asi.`status`='1' AND emp.name LIKE '%$filter_emp%'";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$filter_users[]=$row['asset'];
		}
		if(sizeof($filter_users)>0) $emp_qry='ass.id IN ('.implode(',', $filter_users).') AND';
	}

	$query="SELECT ass.id,ass.asset_id,ass.serial_number,ass.name as `assname`,ass.purchased_date,asl.name as `location`,ass.`status`,ast.`status` as `ast`,ass.`comment` FROM inv_asset ass, inv_location asl,inv_asset_status ast  WHERE $location_qry $status_qry $type_qry $assid_qry $device_qry $sn_qry $emp_qry ass.`status`=ast.id AND ass.location=asl.id ORDER BY ass.`status`, asl.name, ass.asset_id, ass.name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$asi_id=$row['id'];
		$tb_ass_id[]=$row['id'];
		$tb_asset_id[]=$row['asset_id'];
		$tb_ass_sn[]=$row['serial_number'];
		$tb_ass_name[]=$row['assname'];
		$tb_ass_pudate[]=$row['purchased_date'];
		$tb_location[]=$row['location'];
		$tb_ass_st[]=$row['ast'];
		$tb_ass_comment[]=$row['comment'];
		$st1[]=$row['ast'];
		if($row['status']==1){ $color1[]='#444444'; }
		if($row['status']==2){ $color1[]='orange'; }
		if($row['status']==3){ $color1[]='blue'; }
		if($row['status']==4){ $color1[]='teal'; }
		
			$emp_name='';
			$emp_st='';
		$query1="SELECT emp.name,emp.`resigned_date`,emp.`status` FROM inv_assignment asi, inv_employee emp WHERE asi.employee=emp.id AND asi.asset='$asi_id' AND asi.`status`='1'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			$emp_name=$row1['name'];
			$emp_rdate=$row1['resigned_date'];
			$emp_st=$row1['status'];
		}
			if($emp_name!='') $tb_emp_name[$k]=$emp_name; else $tb_emp_name[$k]='';
			if($emp_rdate!='') $tb_emp_rdate[$k]='Resigned Date: '.$emp_rdate; else $tb_emp_rdate[$k]='';
			if($emp_st!='') $tb_emp_st[$k]=$emp_st; else $tb_emp_st[$k]='';
		$k++;
	}
}


function downloadList(){
global $company,$user;
	$user=$_COOKIE['user'];
	include('config.php');
	$query0="SELECT value FROM setting WHERE setting='company_name'";
	$result0 = $conn->query($query0);
	$company0=mysqli_fetch_row($result0);
	$company=$company0[0];
	
}

function getAssetDetails(){
global $tb1_ass_id,$tb1_ass_type,$tb1_ass_assetid,$tb1_ass_sn,$tb1_ass_name,$tb1_ass_loc,$tb1_ass_addeddate,$tb1_ass_pudate,$tb1_ass_sodate,$tb1_ass_addedby,$tb1_ass_status,$tb1_ass_comment,$tb2_asi_id,$tb2_emp_id,$tb2_emp_name,$tb2_emp_resigneddate,$tb2_emp_empstatus,$tb2_asi_assigneddate,$tb2_asi_assignedby,$tb2_asi_removeddate,$tb2_asi_removedby,$tb2_asi_asistatus;
	if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
		include('config.php');
		$query="SELECT id,`type`,asset_id,serial_number,name,location,added_date,purchased_date,cancelsold_date,added_by,comment,`status` FROM inv_asset ass WHERE id='$id'";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$tb1_ass_id=$row['id'];
			$tb1_ass_type=$row['type'];
			$tb1_ass_assetid=$row['asset_id'];
			$tb1_ass_sn=$row['serial_number'];
			$tb1_ass_name=$row['name'];
			$tb1_ass_loc=$row['location'];
			$tb1_ass_addeddate=$row['added_date'];
			$tb1_ass_pudate=$row['purchased_date'];
			$tb1_ass_sodate=$row['cancelsold_date'];
			$tb1_ass_addedby=$row['added_by'];
			$tb1_ass_comment=$row['comment'];
			$tb1_ass_status=$row['status'];
		}
		
		$query="SELECT asi.id as `asiid`,emp.id as `empid`,emp.name,emp.resigned_date,emp.`status` as `empstatus`,asi.assigned_date,asi.assigned_by,asi.removed_date,asi.removed_by,asi.`status` as `asistatus` FROM inv_assignment asi, inv_employee emp WHERE asi.employee=emp.id AND asi.asset='$id' ORDER BY asi.assigned_date DESC";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$tb2_asi_id[]=$row['asiid'];
			$tb2_emp_id[]=$row['empid'];
			$tb2_emp_name[]=$row['name'];
			$tb2_emp_resigneddate[]=$row['resigned_date'];
			$tb2_emp_empstatus[]=$row['empstatus'];
			$tb2_asi_assigneddate[]=$row['assigned_date'];
			$tb2_asi_assignedby[]=$row['assigned_by'];
			$tb2_asi_removeddate[]=$row['removed_date'];
			$tb2_asi_removedby[]=$row['removed_by'];
			$tb2_asi_asistatus[]=$row['asistatus'];
		}
	}
}

function getEmpData(){
global $emp_name,$emp_department,$emp_resigned_date,$emp_status;
	$emp_id=$_REQUEST['id'];
	include('config.php');
	$query="SELECT name,department,resigned_date,`status` FROM inv_employee WHERE id=$emp_id";
	$result = $conn->query($query);
	$data=mysqli_fetch_row($result);
	$emp_name=$data[0];
	$emp_department=$data[1];
	$emp_resigned_date=$data[2];
	$emp_status=$data[3];
}

function updateEmpData(){
global $emp_id,$message;
	$emp_id=$_POST['emp_id'];
	$emp_status=$_POST['emp_status'];
	$res_date=$_POST['res_date'];
	$emp_dep=$_POST['emp_dep'];
	if($res_date!='') $res_qry=",`resigned_date`='$res_date'"; else $res_qry=',`resigned_date`=null';
	if($emp_dep!='') $dep_qry=",`department`='$emp_dep'"; else $dep_qry=',`department`=null';
	include('config.php');
	$query="UPDATE `inv_employee` SET `status`='$emp_status' $res_qry $dep_qry WHERE `id`='$emp_id'";
	$result = $conn->query($query);
	if($result){
		$message='Employee Details were Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Employee Details Could Not be Updated !';
		return false;
	}
}

//---------------------Toner------------------------//

function getTonerList(){
global $toner_id,$toner_name;
	include('config.php');
	$query="SELECT id,name FROM toner_list WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$toner_id[]=$row['id'];
		$toner_name[]=$row['name'];
	} 
}

function getOneToner(){
global $one_toner_name;
	$id=$_GET['id'];
	include('config.php');
	$queryt="SELECT name FROM toner_list WHERE id='$id'";
	$resultt = $conn->query($queryt);
	$row=mysqli_fetch_row($resultt);
	$one_toner_name=$row[0];
}

function getTonerUtilization(){
global $toneru_id,$toneru_name,$toner_balance;
	include('config.php');
	$query="SELECT id,name FROM toner_list WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$toneru_id[]=$row['id'];
		$toneru_name[]=$row['name'];
		$toner_id_tmp=$row['id'];
		$query1="SELECT sum(qty) FROM toner_inventory WHERE toner='$toner_id_tmp'";
		$result1 = $conn->query($query1);
		$row1=mysqli_fetch_row($result1);
		$toner_inv=$row1[0];
		$query1="SELECT sum(qty) FROM toner_utilization WHERE toner='$toner_id_tmp'";
		$result1 = $conn->query($query1);
		$row1=mysqli_fetch_row($result1);
		$toner_allo=$row1[0];
		$toner_balance[]=$toner_inv-$toner_allo;
	} 
}

function tonerReport(){
global $from_date,$to_date,$ti_id,$ti_date,$ti_po,$ti_toner,$ti_qty,$ti_uprice,$tu_date,$tu_location,$tu_toner,$tu_qty,$tu_allocated,$tu_comment;
	if(isset($_REQUEST['from_date'])) $from_date=$_REQUEST['from_date']; else $from_date='';
	if(isset($_REQUEST['to_date'])) $to_date=$_REQUEST['to_date']; else $to_date='';
	
	if(($from_date!='')&&($to_date!='')){
		include('config.php');
		$query="SELECT ti.id,ti.added_date,ti.po_number,tl.name,ti.qty,ti.purchased_price FROM toner_list tl, toner_inventory ti WHERE tl.id=ti.toner AND ti.added_date BETWEEN '$from_date' AND '$to_date' ORDER BY ti.added_date";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$ti_id[]=$row['id'];
			$ti_date[]=$row['added_date'];
			$ti_po[]=$row['po_number'];
			$ti_toner[]=$row['name'];
			$ti_qty[]=$row['qty'];
			$ti_uprice[]=$row['purchased_price'];
		} 
		
		$query="SELECT tu.`date`,il.name as `location`,tl.name,tu.qty,tu.allocated_by,tu.`comment` FROM toner_list tl, toner_utilization tu, inv_location il WHERE tl.id=tu.toner AND tu.location=il.id AND tu.`date` BETWEEN '$from_date' AND '$to_date' ORDER BY tu.`date`";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$tu_date[]=$row['date'];
			$tu_location[]=$row['location'];
			$tu_toner[]=$row['name'];
			$tu_qty[]=$row['qty'];
			$tu_allocated[]=$row['allocated_by'];
			$tu_comment[]=$row['comment'];
		} 
	}
}

function addTonerName(){
	global $message;
	include('config.php');
	$toner_name=$_POST['toner_name'];
	
	$queryt="SELECT count(id) FROM toner_list WHERE name='$toner_name'";
	$resultt = $conn->query($queryt);
	$row=mysqli_fetch_row($resultt);
	$duplicate_toner=$row[0];
	
	if($duplicate_toner==0){
		$query="INSERT INTO `toner_list` (`name`,`status`) VALUES ('$toner_name','1')";
		$result = $conn->query($query);
		if($result){
			$message='Toner was Added Successfully'; 
			return true;
		}else{
			$message='Error ! Toner Could Not be Added!';
			return false;
		}
	}else{
		$message='Error ! Toner Name is Alredy Exist!';
		return false;
	}
}

function editTonerName(){
	global $message;
	include('config.php');
	$toner_id=$_POST['toner_id'];
	$toner_name=$_POST['toner_name'];
	
	$queryt="SELECT count(id) FROM toner_list WHERE name='$toner_name'";
	$resultt = $conn->query($queryt);
	$row=mysqli_fetch_row($resultt);
	$duplicate_toner=$row[0];
	
	if($duplicate_toner==0){
		$query="UPDATE `toner_list` SET `name`='$toner_name' WHERE `id`='$toner_id'";
		$result = $conn->query($query);
		if($result){
			$message='Toner was Updated Successfully'; 
			return true;
		}else{
			$message='Error ! Toner Could Not be Updated !';
			return false;
		}
	}else{
		$message='Error ! Toner Name is Alredy Exist!';
		return false;
	}
}

function deleteTonerName(){
	global $message;
	include('config.php');
	$toner_id=$_GET['id'];
	
	$query="UPDATE `toner_list` SET `status`='0' WHERE `id`='$toner_id'";
	$result = $conn->query($query);
	if($result){
		$message='Toner was Deactivated Successfully'; 
		return true;
	}else{
		$message='Error ! Toner Could Not be Deactivated !';
		return false;
	}
}

function addTonerInventory(){
	global $message;
	setTimezone();
	$po_no=$_POST['po_no'];
	$date=date("Y-m-d");
	$toner_id=$_POST['toner_id'];
	$toner_qty=$_POST['toner_qty'];
	$purchased_price=$_POST['purchased_price'];
	
	include('config.php');
	$query="INSERT INTO `toner_inventory` (`po_number`,`added_date`,`toner`,`qty`,`purchased_price`) VALUES ('$po_no','$date','$toner_id','$toner_qty','$purchased_price')";
	$result = $conn->query($query);
	if($result){
		$message='Toner was Added to Inventory Successfully'; 
		return true;
	}else{
		$message='Error ! Toner Could Not be Added to Inventory!';
		return false;
	}
}

function allocateToner(){
	global $message;
	$location_id=$_POST['location_id'];
	$toner_id=$_POST['toner_id'];
	$date=$_POST['date'];
	$qty=$_POST['qty'];
	$comment=$_POST['comment'];
	$user=$_COOKIE['user'];
	
	include('config.php');
	$query="INSERT INTO `toner_utilization` (`location`,`toner`,`qty`,`date`,`comment`,`allocated_by`) VALUES ('$location_id','$toner_id','$qty','$date','$comment','$user')";
	$result = $conn->query($query);
	if($result){
		$message='Toner was Allocated Successfully'; 
		return true;
	}else{
		$message='Error ! Toner Could Not be Allocated !';
		return false;
	}
}

function updateTonerPrice(){
	global $message;
	$id=$_GET['id'];
	$uprice=$_GET['uprice'];
	$out='Error';
	
	if($uprice>0){
		include('config.php');
		$query="UPDATE `toner_inventory` SET `purchased_price`='$uprice' WHERE id='$id'";
		$result = $conn->query($query);
		if($result) $out='Done'; 
	}
	return $out;
}
?>