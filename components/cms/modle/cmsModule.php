<?php
function setTimezone(){
	include('config.php');
	$queryt="SELECT value FROM setting WHERE setting='timezone'";
	$resultt = $conn->query($queryt);
	$timezone=mysqli_fetch_row($resultt);
	date_default_timezone_set("$timezone[0]");
}

function dashboard($action,$type,$user,$module,$task_id,$description,$url){
	setTimezone();
	$date=$date=date("Y-m-d");
	include('config.php');
	if($action=='add'){
		$query="INSERT INTO `dashboard` ( `type`,`date`,`user`,`module`,`task_id`,`description`,`url`) VALUES ('$type','$date','$user','$module','$task_id','$description','$url')";
		$result = $conn->query($query);
	}else
	if($action=='delete'){
		$query="DELETE FROM `dashboard` WHERE `module`='$module' AND `task_id`='$task_id'";
		$result = $conn->query($query);
	}
}

function getCRFormData(){
	global $dev_id,$dev_name,$team_id,$team_name;
	include('config.php');
	$query="SELECT id,name FROM device WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$dev_id[]=$row['id'];
		$dev_name[]=$row['name'];
	} 
	$query="SELECT id,team_name FROM cms_ana_team WHERE id!=1";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$team_id[]=$row['id'];
		$team_name[]=$row['team_name'];
	} 
}

function addRequest(){
	global $message;
	$message='Error ! Change Request could not be Sent';
	$uploadOk=true;
	$attachment1=$attachment2='';
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$system_type=$_REQUEST['system_type'];
	$cr_title=filter_var($_REQUEST['cr_title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$cr_priority=$_REQUEST['cr_priority'];
	$cr_rq_date=$_REQUEST['cr_rq_date'];
	$ana_team=$_REQUEST['ana_team'];
	$cr_descriptione=filter_var($_REQUEST['cr_description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$cr_bisscase=filter_var($_REQUEST['cr_bisscase'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	switch ($system_type){
			case "1" : $system_type0='New System';   break;
			case "2" : $system_type0='Existing System';   break;
	}
	switch ($cr_priority){
			case "1" : $req_priority='Critical';   break;
			case "2" : $req_priority='High';   break;
			case "3" : $req_priority='Medium';   break;
			case "4" : $req_priority='Low';   break;
	}
	
	include('config.php');
	$query0="SELECT MAX(id) FROM cms";
	$result0 = $conn->query($query0);
	$id_0=mysqli_fetch_row($result0);
	$id0=str_pad(($id_0[0]+1),5,"0",STR_PAD_LEFT);
	
	//---------Attachment Upload----------//
	for($k=1;$k<=2;$k++){
		if($uploadOk){
			if(isset($_FILES["attachment$k"]["size"])){
			if($_FILES["attachment$k"]["name"]!=''){
				$attachmentFileType = pathinfo($_FILES["attachment$k"]["name"],PATHINFO_EXTENSION);
				$target_file = 'attachment/'.$id0.'attachment'.$k.'.'.$attachmentFileType;
			    if ($_FILES["attachment$k"]["size"] > 55000000) {
				    $message="Sorry, your file is too large. Images has to be less than 50MB";
				    $uploadOk =false;
				}
				if($attachmentFileType == "exe" && $attachmentFileType == "bat" ) {
				    $message="Sorry, Attahcment$k contains a restricted File Type.";
				    $uploadOk =false;
				}	   
				if($uploadOk){
					move_uploaded_file($_FILES["attachment$k"]["tmp_name"], $target_file);
					if($k==1) $attachment1=$id0.'attachment1.'.$attachmentFileType;
					if($k==2) $attachment2=$id0.'attachment2.'.$attachmentFileType;
				}
		    }}
		}
	}
	if($uploadOk){
		
		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$cr_title.'</td></tr>
			<tr><td>Change Request ID</td><td>'.$id0.'</td></tr>
			<tr><td>Required Date</td><td>'.$cr_rq_date.'</td></tr>
			<tr><td>Requested Priority</td><td>'.$req_priority.'</td></tr>
			<tr><td>Change Request Type</td><td>'.$system_type0.'</td></tr>
			<tr><td>Requested By</td><td>'.$user.'</td></tr>';
		//----------Main Data insert to CMS table----------------------//
		$query="INSERT INTO `cms` ( `change_type`,`title`,`req_priority`,`required_date`,`requested_date`,`requested_time`,`impact_analyser`,`request_description`,`business_case`,`attachment1`,`attachment2`,`requester`,`status`) VALUES 
		('$system_type','$cr_title','$cr_priority','$cr_rq_date','$date','$time','$ana_team','$cr_descriptione','$cr_bisscase','$attachment1','$attachment2','$user','1')";
		$result = $conn->query($query);
		$last_id = $conn->insert_id;
		if($result){
			//------------add devices to CMS -------------------//
		if($system_type==1){
			$ns_type=$_REQUEST['ns_type'];
			$ns_name=$_REQUEST['ns_name'];
			$ns_ip=$_REQUEST['ns_ip'];
			$query1="INSERT INTO `device` ( `device_type`,`name`,`ip1`,`status`) VALUES ('$ns_type','$ns_name','$ns_ip','1')";
			$result1 = $conn->query($query1);
			$system_name = $conn->insert_id;
			$query1="INSERT INTO `cms_device` ( `cms_id`,`device_id`) VALUES ('$last_id','$system_name')";
			$result1 = $conn->query($query1);
		}else{
			$system_name_arr=explode(",",$_REQUEST['system_list1']);
			for($k=0;$k<sizeof($system_name_arr);$k++){
				$dev_id=$system_name_arr[$k];
				//print $dev_id.'<br />';
				$query1="INSERT INTO `cms_device` ( `cms_id`,`device_id`) VALUES ('$last_id','$dev_id')";
				$result1 = $conn->query($query1);
			}
		}

			
			//------------add devices to CMS End!---------------//
			$query2="SELECT ma.username,m.id,ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='cms' AND ma.`level`='Analysis' AND ma.subteam='$ana_team'";
			$result2 = $conn->query($query2);
			while($row= $result2->fetch_assoc()) {
				$user0=$row['username'];
				$mid=$row['id'];
				$authid=$row['authid'];
				if($user0!=''){
					dashboard('add','1',$user0,$mid,$last_id,'CMS - CR '.str_pad($last_id,5,"0",STR_PAD_LEFT).' Analysis Pending','index.php?components=cms&action=show_analyse_cr&id='.$last_id);
					sendmail($user0,'CMS','cms','template1',$last_id,$body,'Change Request Details','Impact Analysis pending by You','show_analyse_cr',$authid);
				}
			}
		} 
	} else $result=false;
	
	if($result){
		$message='Change Request was Submited Successfully'; 
		return true;
	}else{
		return false;
	}
	
}

function addAnalyze(){
	global $message;
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST['id'];
	$sch_date=$_REQUEST['sch_date'];
	$ana_priority=$_REQUEST['ana_priority'];
	$imp_by=$_REQUEST['imp_by'];
	$ana_spec=filter_var($_REQUEST['ana_spec'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$ana_impact=filter_var($_REQUEST['ana_impact'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$ana_rollback=filter_var($_REQUEST['ana_rollback'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$k=0;
	include('config.php');

	$query0="SELECT cms.title,cms.change_type,cms.requester FROM cms WHERE cms.id='$id'";
	$result0 = $conn->query($query0);
	while($row0= $result0->fetch_assoc()) {
		$title0=$row0['title'];
		$change_type0=$row0['change_type'];
		$requester0=$row0['requester'];
	}	
	switch ($change_type0){
			case "1" : $system_type0='New System';   break;
			case "2" : $system_type0='Existing System';   break;
	}
	switch ($ana_priority){
			case "1" : $ana_priority0='Critical';   break;
			case "2" : $ana_priority0='High';   break;
			case "3" : $ana_priority0='Medium';   break;
			case "4" : $ana_priority0='Low';   break;
	}

		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$title0.'</td></tr>
			<tr><td>Change Request ID</td><td>'.str_pad($id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Scheduled Date</td><td>'.$sch_date.'</td></tr>
			<tr><td>Actual Priority</td><td>'.$ana_priority0.'</td></tr>
			<tr><td>Change Request Type</td><td>'.$system_type0.'</td></tr>
			<tr><td>Requested By</td><td>'.$requester0.'</td></tr>
			<tr><td>Analyzed By</td><td>'.$user.'</td></tr>';
	
	$query="UPDATE `cms` SET `ana_imp_date`='$sch_date',`ana_imp_priority`='$ana_priority',`propose_implementer`='$imp_by',`specification`='$ana_spec',`impact_analysis`='$ana_impact',`rollback_plan`='$ana_rollback',`analyser`='$user',`analyse_date`='$date',`analyse_time`='$time',`status`='2' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$query2="SELECT ma.username,m.id,ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='cms' AND ma.`level`='Approver'";
		$result2 = $conn->query($query2);
		while($row= $result2->fetch_assoc()) {
			$user0=$row['username'];
			$mid=$row['id'];
			$authid=$row['authid'];
			if($user0!=''){
				if($k==0) dashboard('delete','','',$mid,$id,'','');
				dashboard('add','1',$user0,$mid,$id,'CMS - CR '.str_pad($id,5,"0",STR_PAD_LEFT).' Approval Pending','index.php?components=cms&action=show_approve_cr&id='.$id);
				sendmail($user0,'CMS','cms','template1',$id,$body,'Change Request Details','Change Request Approval pending by You','show_approve_cr',$authid);				
				$k++;
			}
		} 
	}
	if($result){
		$message='Analysis was Submited Successfully'; 
		return true;
	}else{
		$message='Error ! Analysis could not be Sent';
		return false;
	}
}

function approveCMS($task){
	global $message;
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST['id'];
	$comment=filter_var($_REQUEST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$k=0;
	if($task=='approve'){ $status=4; $word='Approved'; }
	if($task=='reject'){ $status=3; $word='Rejected'; }
	include('config.php');
	
	$query0="SELECT cms.title,cms.change_type,cms.ana_imp_priority,cms.ana_imp_date,cms.requester,cms.analyser FROM cms WHERE cms.id='$id'";
	$result0 = $conn->query($query0);
	while($row0= $result0->fetch_assoc()) {
		$title0=$row0['title'];
		$change_type0=$row0['change_type'];
		$imp_priority=$row0['ana_imp_priority'];
		$imp_date0=$row0['ana_imp_date'];
		$requester0=$row0['requester'];
		$analyser0=$row0['analyser'];
	}	
	switch ($change_type0){
			case "1" : $system_type0='New System';   break;
			case "2" : $system_type0='Existing System';   break;
	}
	switch ($imp_priority){
			case "1" : $ana_priority0='Critical';   break;
			case "2" : $ana_priority0='High';   break;
			case "3" : $ana_priority0='Medium';   break;
			case "4" : $ana_priority0='Low';   break;
	}
		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$title0.'</td></tr>
			<tr><td>Change Request ID</td><td>'.str_pad($id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Scheduled Date</td><td>'.$imp_date0.'</td></tr>
			<tr><td>Actual Priority</td><td>'.$ana_priority0.'</td></tr>
			<tr><td>Change Request Type</td><td>'.$system_type0.'</td></tr>
			<tr><td>Requested By</td><td>'.$requester0.'</td></tr>
			<tr><td>Analyzed By</td><td>'.$analyser0.'</td></tr>
			<tr><td>'.$word.' By</td><td>'.$user.'</td></tr>';

	$query="UPDATE `cms` SET `approval_comment`='$comment',`approved_by`='$user',`approved_date`='$date',`approved_time`='$time',`status`='$status' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='cms'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
			if($task=='approve'){
				$query2="SELECT propose_implementer FROM cms WHERE id='$id'";
				$result2 = $conn->query($query2);
				while($row= $result2->fetch_assoc()) {
					$user0=$row['propose_implementer'];
					if($user0!=''){
							$query3="SELECT id FROM module_authorization WHERE username='$user0' AND `level`='Implementer' AND module='$mid'";
							$result3 = $conn->query($query3);
							$authid_0=mysqli_fetch_row($result3);
							$authid=$authid_0[0];

						if($k==0) dashboard('delete','','',$mid,$id,'','');
						dashboard('add','1',$user0,$mid,$id,'CMS - CR '.str_pad($id,5,"0",STR_PAD_LEFT).' Implementation Pending','index.php?components=cms&action=show_implement_cr&id='.$id);
						sendmail($user0,'CMS','cms','template1',$id,$body,'Change Request Details','Change Request Implementation pending by You','show_implement_cr',$authid);
						$k++;
					}
				}
			}else
			if($task=='reject'){
				$query2="SELECT  requester FROM cms WHERE id='$id'";
				$result2 = $conn->query($query2);
				while($row= $result2->fetch_assoc()) {
					$user0=$row['requester'];
					if($user0!=''){
							$query3="SELECT id FROM module_authorization WHERE username='$user0' AND `level`='Requester' AND module='$mid'";
							$result3 = $conn->query($query3);
							$authid_0=mysqli_fetch_row($result3);
							$authid=$authid_0[0];
					
						if($k==0) dashboard('delete','','',$mid,$id,'','');
						dashboard('add','2',$user0,$mid,$id,'CMS - CR '.str_pad($id,5,"0",STR_PAD_LEFT).' Was Rejected','index.php?components=cms&action=list_cr&id='.$id);
						sendmail($user0,'CMS','cms','template1',$id,$body,'Change Request Details','Your Change Request was REJECTED!','list_cr',$authid);
						$k++;
					}
				}
			} 
	}
	if($result){
		$message='Change Request was '.$word.' Successfully'; 
		return true;
	}else{
		$message='Error ! Change Request could not be '.$word;
		return false;
	}
}

function addImplement(){
	global $message;
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST['id'];
	$imp_date=$_REQUEST['imp_date'];
	$status=$_REQUEST['imp_status'];
	$imp_comm=filter_var($_REQUEST['imp_comm'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$k=0;
	if($status==5) $wording='Implementation was Failed';
	if($status==6) $wording='Implementation was Successful';

	include('config.php');
	$query0="SELECT cms.title,cms.change_type,cms.ana_imp_priority,cms.ana_imp_date,cms.requester,cms.analyser,cms.approved_by FROM cms WHERE cms.id='$id'";
	$result0 = $conn->query($query0);
	while($row0= $result0->fetch_assoc()) {
		$title0=$row0['title'];
		$change_type0=$row0['change_type'];
		$imp_priority=$row0['ana_imp_priority'];
		$imp_date0=$row0['ana_imp_date'];
		$requester0=$row0['requester'];
		$analyser0=$row0['analyser'];
		$approver0=$row0['approved_by'];
	}	
	switch ($change_type0){
			case "1" : $system_type0='New System';   break;
			case "2" : $system_type0='Existing System';   break;
	}
	switch ($imp_priority){
			case "1" : $ana_priority0='Critical';   break;
			case "2" : $ana_priority0='High';   break;
			case "3" : $ana_priority0='Medium';   break;
			case "4" : $ana_priority0='Low';   break;
	}

		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$title0.'</td></tr>
			<tr><td>Change Request ID</td><td>'.str_pad($id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Scheduled Date</td><td>'.$imp_date0.'</td></tr>
			<tr><td>Actual Priority</td><td>'.$ana_priority0.'</td></tr>
			<tr><td>Change Request Type</td><td>'.$system_type0.'</td></tr>
			<tr><td>Requested By</td><td>'.$requester0.'</td></tr>
			<tr><td>Analyzed By</td><td>'.$analyser0.'</td></tr>
			<tr><td>Approved By</td><td>'.$approver0.'</td></tr>
			<tr><td>Implemented By</td><td>'.$user.'</td></tr>';

	$query="UPDATE `cms` SET `implementation_comment`='$imp_comm',`implement_by`='$user',`implemented_date`='$imp_date',`implemented_frm_date`='$date',`implemented_frm_time`='$time',`status`='$status' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='cms'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
		$query2="SELECT  requester FROM cms WHERE id='$id'";
		$result2 = $conn->query($query2);
		while($row= $result2->fetch_assoc()) {
			$user0=$row['requester'];
			if($user0!=''){
				$query3="SELECT id FROM module_authorization WHERE username='$user0' AND `level`='Implementer' AND module='$mid'";
				$result3 = $conn->query($query3);
				$authid_0=mysqli_fetch_row($result3);
				$authid=$authid_0[0];

				if($k==0) dashboard('delete','','',$mid,$id,'','');
				dashboard('add','2',$user0,$mid,$id,'CMS - CR '.str_pad($id,5,"0",STR_PAD_LEFT).' '.$wording,'index.php?components=cms&action=list_cr&id='.$id);
				sendmail($user0,'CMS','cms','template1',$id,$body,'Change Request Details','Change Request '.$wording,'list_cr',$authid);
				$k++;
			}
		}
	}
	if($result){
		$message='Implementation Report was Submited Successfully'; 
		return true;
	}else{
		$message='Error ! Implementation Report could not be Sent';
		return false;
	}
}

function listCr($status){
	global $id,$cr_date,$title;
	include('config.php');
	$query="SELECT id,requested_date,title FROM cms WHERE `status`=$status";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$id[]=$row['id'];
		$cr_date[]=$row['requested_date'];
		$title[]=$row['title'];
	} 
}

function listAna(){
	global $id,$cr_date,$title;
	$user=$_COOKIE['user'];
	include('config.php');
	$query="SELECT DISTINCT c.id,c.requested_date,c.title FROM cms c, module_authorization ma WHERE c.impact_analyser=ma.subteam AND ma.username='$user' AND `status`=1 ORDER BY c.id DESC";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$id[]=$row['id'];
		$cr_date[]=$row['requested_date'];
		$title[]=$row['title'];
	} 
}

function getCr(){
	global $id,$change_type,$system,$title,$req_priority,$required_date,$requested_date,$requested_time,$request_description,$business_case,$requester,$attachment1,$attachment2;
	$id=$_GET['id'];
	include('config.php');
	$query="SELECT c.change_type,c.title,c.req_priority,c.required_date,c.requested_date,c.requested_time,c.request_description,c.business_case,c.requester,c.attachment1,c.attachment2 FROM cms as c WHERE c.id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
	switch ($row['change_type']){
		case "1" : $change_type='New System';   break;
		case "2" : $change_type='Excisting System';   break;
	}
		$title=$row['title'];
		$required_date=$row['required_date'];
		$requested_date=$row['requested_date'];
		$requested_time=substr($row['requested_time'],0,5);
		$request_description=$row['request_description'];
		$business_case=$row['business_case'];
		$requester=$row['requester'];
		$attachment1=$row['attachment1'];
		$attachment2=$row['attachment2'];
		switch ($row['req_priority']){
			case "1" : $req_priority='Critical';   break;
			case "2" : $req_priority='High';   break;
			case "3" : $req_priority='Medium';   break;
			case "4" : $req_priority='Low';   break;
		}
		$query1="SELECT d.name FROM cms_device cd, device d WHERE cd.device_id=d.id AND cd.cms_id='$id'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			$system[]=$row1['name'];
		}
	} 
}

function getAna(){
	global $ana_imp_date,$propose_implementer,$specification,$impact_analysis,$rollback_plan,$analyser,$analyse_date,$analyse_time,$ana_imp_priority;
	$id=$_GET['id'];
	include('config.php');
	$query="SELECT ana_imp_date,ana_imp_priority,propose_implementer,specification,impact_analysis,rollback_plan,analyser,analyse_date,analyse_time FROM cms WHERE id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$ana_imp_date=$row['ana_imp_date'];
		$propose_implementer=$row['propose_implementer'];
		$specification=$row['specification'];
		$impact_analysis=$row['impact_analysis'];
		$rollback_plan=$row['rollback_plan'];
		$analyser=$row['analyser'];
		$analyse_date=$row['analyse_date'];
		$analyse_time=substr($row['analyse_time'],0,5);
		switch ($row['ana_imp_priority']){
			case "1" : $ana_imp_priority='Critical';   break;
			case "2" : $ana_imp_priority='High';   break;
			case "3" : $ana_imp_priority='Medium';   break;
			case "4" : $ana_imp_priority='Low';   break;
		}
	} 
}

function getApprove(){
	global $approval_comment,$approved_by,$approved_date,$approved_time;
	$id=$_GET['id'];
	include('config.php');
	$query="SELECT approval_comment,approved_by,approved_date,approved_time FROM cms WHERE id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$approval_comment=$row['approval_comment'];
		$approved_by=$row['approved_by'];
		$approved_date=$row['approved_date'];
		$approved_time=substr($row['approved_time'],0,5);
	} 
}

function getImp(){
	global $implementation_comment,$implement_by,$implemented_date,$implemented_frm_date,$implemented_frm_time,$status0;
	$id=$_GET['id'];
	include('config.php');
	$query="SELECT implementation_comment,implement_by,implemented_date,implemented_frm_date,implemented_frm_time,status FROM cms WHERE `status` IN (5,6) AND id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$implementation_comment=$row['implementation_comment'];
		$implement_by=$row['implement_by'];
		$implemented_date=$row['implemented_date'];
		$implemented_frm_date=$row['implemented_frm_date'];
		$implemented_frm_time=substr($row['implemented_frm_time'],0,5);
		if($row['status']==5) $status0='Unsuccessful';
		if($row['status']==6) $status0='Successful';
	} 
}

function getImplementer(){
	global $ma_user;
	include('config.php');
	$query="SELECT ma.username FROM module_authorization as ma, module m WHERE ma.`module`=m.id AND m.component='cms' AND ma.`level`='Implementer'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$ma_user[]=$row['username'];
	} 
}


function listAll(){
	global $id,$cr_date,$title,$status,$action,$color1,$devices;
	$filter=$_REQUEST['filter'];
	if($filter=='all') $st='1,2,3,4,5,6';
	if($filter=='pending') $st='1,2,4';
	if($filter=='complete') $st='3,5,6';
	include('config.php');
	$query="SELECT id,requested_date,title,`status` FROM cms WHERE `status` IN ($st) ORDER BY id DESC LIMIT 50";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$tmp_id=$row['id'];
		$id[]=$row['id'];
		$cr_date[]=$row['requested_date'];
		$title[]=$row['title'];
		switch ($row['status']){
			case "1" : $status[]='pending';   break;
			case "2" : $status[]='pending';   break;
			case "3" : $status[]='done';   break;
			case "4" : $status[]='pending';   break;
			case "5" : $status[]='done';   break;
			case "6" : $status[]='done';   break;
		}
		switch ($row['status']){
			case "1" : $action[]='Analysis Pending'; $color1[]='#069';  break;
			case "2" : $action[]='Approval Pending'; $color1[]='#069';  break;
			case "3" : $action[]='CR Rejected'; $color1[]='red';  break;
			case "4" : $action[]='Implementation Pending'; $color1[]='#069';  break;
			case "5" : $action[]='Implementation Fail'; $color1[]='red';  break;
			case "6" : $action[]='Implementation Done'; $color1[]='green';  break;
		}
		$devices_tmp='';
		$query1="SELECT dv.name FROM cms_device cd, device dv WHERE cd.device_id=dv.id AND cd.cms_id='$tmp_id'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			if($devices_tmp=='') $devices_tmp=$row1['name']; else $devices_tmp=$devices_tmp.','.$row1['name'];
		}
		if((strlen($devices_tmp))>20) $devices[]=substr($devices_tmp,0,19).'...'; else $devices[]=$devices_tmp;
	} 
}

function listSearch(){
	global $id,$cr_date,$title,$status,$action,$color1;
	$filter=$_REQUEST['filter'];
	$searchid=intval($_REQUEST['id']);
	if($filter=='all') $st='1,2,3,4,5,6';
	if($filter=='pending') $st='1,2,4';
	if($filter=='complete') $st='3,5,6';
	include('config.php');
	$query="SELECT id,requested_date,title,`status` FROM cms WHERE `status` IN ($st) AND id='$searchid' ORDER BY id DESC LIMIT 50";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$id[]=$row['id'];
		$cr_date[]=$row['requested_date'];
		$title[]=$row['title'];
		switch ($row['status']){
			case "1" : $status[]='pending';   break;
			case "2" : $status[]='pending';   break;
			case "3" : $status[]='done';   break;
			case "4" : $status[]='pending';   break;
			case "5" : $status[]='done';   break;
			case "6" : $status[]='done';   break;
		}
		switch ($row['status']){
			case "1" : $action[]='Analysis Pending'; $color1[]='#069';  break;
			case "2" : $action[]='Approval Pending'; $color1[]='#069';  break;
			case "3" : $action[]='CR Rejected'; $color1[]='red';  break;
			case "4" : $action[]='Implementation Pending'; $color1[]='#069';  break;
			case "5" : $action[]='Implementation Fail'; $color1[]='red';  break;
			case "6" : $action[]='Implementation Done'; $color1[]='green';  break;
		}
	} 
}

function companyProfile2(){
	global $se_company,$se_appname;
	include('config.php');
	$query="SELECT `setting`,value FROM setting WHERE `setting`='company_name' OR `setting`='app_name' ORDER BY `setting`";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		if($row['setting']=='company_name') $se_company=$row['value'];
		if($row['setting']=='app_name') $se_appname=$row['value'];
	} 
}	

function deleteAllow($id){
	$user=$_COOKIE['user'];
	$id1=$id2='';
	include('config.php');
	$query1="SELECT id FROM cms WHERE requester='$user' AND specification is NULL AND analyser is NULL AND id='$id'";
	$result1 = $conn->query($query1);
	$id_1=mysqli_fetch_row($result1);
	$id1=$id_1[0];
	
	$query2="SELECT `level` FROM module_authorization WHERE username='$user'";
	$result2 = $conn->query($query2);
	$id_2=mysqli_fetch_row($result2);
	$id2=$id_2[0];
	
	if(($id1!='')||($id2=='Approver'))
		return true;
	else
		return false;
}

function deleteCMS(){
	global $message;
	$result=false;
	include('config.php');
	$id=$_REQUEST['id'];
	if(deleteAllow($id)){
		$query="DELETE FROM `cms` WHERE `id`='$id'";
		$result = $conn->query($query);
	}
	if($result){
		$message='CMS was Deleted Successfully'; 
		return true;
	}else{
		$message='Error ! CMS could not be Deleted';
		return false;
	}
}


//-----------------------------------------REPORT----------------------------------------//

function listYears(){
	global $years,$height;
	$height='300px';
	$years=array();
	include('config.php');
	$query="SELECT DISTINCT year(requested_date) as `year` FROM cms";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$years[]=$row['year'];
	} 
	if(sizeof($years)==0) $years[]=date("Y");
}


function cmsStaus($filter){
	global $id,$cr_date,$title,$status,$action,$color1,$devices;
	if($filter=='all') $st='1,2,3,4,5,6'; else
	if($filter=='pending') $st='1,2,4'; else
	if($filter=='finished') $st='3,5,6'; else
	$st=$filter;
	if($_REQUEST['year']=='all') $year_qry=''; else $year_qry="year(requested_date)='".$_REQUEST['year']."' AND";
	include('config.php');
	$query="SELECT id,requested_date,title,`status` FROM cms WHERE $year_qry `status` IN ($st) ORDER BY id DESC";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$tmp_id=$row['id'];
		$id[]=$row['id'];
		$cr_date[]=$row['requested_date'];
		$title[]=$row['title'];
		switch ($row['status']){
			case "1" : $status[]='pending';   break;
			case "2" : $status[]='pending';   break;
			case "3" : $status[]='done';   break;
			case "4" : $status[]='pending';   break;
			case "5" : $status[]='done';   break;
			case "6" : $status[]='done';   break;
		}
		switch ($row['status']){
			case "1" : $action[]='Analysis Pending'; $color1[]='#069';  break;
			case "2" : $action[]='Approval Pending'; $color1[]='#069';  break;
			case "3" : $action[]='CR Rejected'; $color1[]='red';  break;
			case "4" : $action[]='Implementation Pending'; $color1[]='#069';  break;
			case "5" : $action[]='Implementation Fail'; $color1[]='red';  break;
			case "6" : $action[]='Implementation Done'; $color1[]='green';  break;
		}
		$devices_tmp='';
		$query1="SELECT dv.name FROM cms_device cd, device dv WHERE cd.device_id=dv.id AND cd.cms_id='$tmp_id'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			if($devices_tmp=='') $devices_tmp=$row1['name']; else $devices_tmp=$devices_tmp.','.$row1['name'];
		}
		if((strlen($devices_tmp))>20) $devices[]=substr($devices_tmp,0,19).'...'; else $devices[]=$devices_tmp;
	} 
}

function reportDeviceBase(){
	global $count,$device_id,$device_name;
	include('config.php');
	if($_REQUEST['year']=='all') $year_qry=''; else $year_qry="year(cms.requested_date)='".$_REQUEST['year']."' AND";
	$query="SELECT count(cms.id) as `count`,d.id,d.name FROM cms, device d, cms_device cd WHERE cms.id=cd.cms_id AND cd.device_id=d.id AND $year_qry cms.`status`='6' GROUP BY cd.device_id ORDER BY `count` DESC";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$count[]=$row['count'];
		$device_id[]=$row['id'];
		$device_name[]=$row['name'];
	} 
}


function reportOneDevice($filter){
	global $id,$cr_date,$title,$status,$action,$color1;
	if(isset($_GET['device'])){
		if($filter=='all') $st='1,2,3,4,5,6'; else
		if($filter=='pending') $st='1,2,4'; else
		if($filter=='complete') $st='3,5,6'; else
		$st=$filter;
		if($_REQUEST['year']=='all') $year_qry=''; else $year_qry="year(c.`requested_date`)='".$_REQUEST['year']."' AND";
		$device=$_REQUEST['device'];
		include('config.php');
		$query="SELECT DISTINCT c.id,c.requested_date,c.title,c.`status` FROM cms c, cms_device cd WHERE c.id=cd.cms_id AND cd.device_id='$device' AND $year_qry c.`status` IN ($st) ORDER BY id DESC";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$id[]=$row['id'];
			$cr_date[]=$row['requested_date'];
			$title[]=$row['title'];
			switch ($row['status']){
				case "1" : $status[]='pending';   break;
				case "2" : $status[]='pending';   break;
				case "3" : $status[]='done';   break;
				case "4" : $status[]='pending';   break;
				case "5" : $status[]='done';   break;
				case "6" : $status[]='done';   break;
			}
			switch ($row['status']){
				case "1" : $action[]='Analysis Pending'; $color1[]='#069';  break;
				case "2" : $action[]='Approval Pending'; $color1[]='#069';  break;
				case "3" : $action[]='CR Rejected'; $color1[]='red';  break;
				case "4" : $action[]='Implementation Pending'; $color1[]='#069';  break;
				case "5" : $action[]='Implementation Fail'; $color1[]='red';  break;
				case "6" : $action[]='Implementation Done'; $color1[]='green';  break;
			}
		} 
	}
}


?>