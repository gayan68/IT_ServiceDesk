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

function getFormData(){
	global $dev_id,$dev_name,$cat_id,$cat_name;
	include('config.php');
	$query="SELECT id,name FROM device WHERE `status`=1 ORDER BY name";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$dev_id[]=$row['id'];
		$dev_name[]=$row['name'];
	} 
	$query="SELECT id,name FROM incident_categoty";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$cat_id[]=$row['id'];
		$cat_name[]=$row['name'];
	} 
}

function listIncidents($filter){
	global $inc_id,$inc_date,$inc_title,$inc_status,$inc_relation,$color1;	
	if($filter=='all') $st='1,2,3';
	if($filter=='pending') $st='1';
	if($filter=='approved') $st='3';
	if($filter=='rejected') $st='2';
	include('config.php');
	$query="SELECT id,occured_date,title,`status` FROM incident WHERE `status` IN ($st) ORDER BY id DESC LIMIT 50";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$inc_id[]=$row['id'];
		$inc_date[]=$row['occured_date'];
		$inc_title[]=$row['title'];
		switch ($row['status']){
			case "1" : $inc_status[]='Approval Pending';  $color1[]='#069'; break;
			case "2" : $inc_status[]='Rejected'; $color1[]='red';  break;
			case "3" : $inc_status[]='Approved';  $color1[]='green'; break;
		}
		$inc_relation[]=getRelation($row['id'],false);
	} 
}

function listSearch(){
	global $inc_id,$inc_date,$inc_title,$inc_status,$color1;	
	$st='1,2,3';
	$searchid=intval($_REQUEST['id']);
	include('config.php');
	$query="SELECT id,occured_date,title,`status` FROM incident WHERE `status` IN ($st) AND `id`='$searchid' ORDER BY id DESC LIMIT 50";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$inc_id[]=$row['id'];
		$inc_date[]=$row['occured_date'];
		$inc_title[]=$row['title'];
		switch ($row['status']){
			case "1" : $inc_status[]='Approval Pending';  $color1[]='#069'; break;
			case "2" : $inc_status[]='Rejected'; $color1[]='red';  break;
			case "3" : $inc_status[]='Approved';  $color1[]='green'; break;
		}
	} 
}

function getIncident(){
	global $inc_device,$inc_category,$inc_occured_date,$inc_title,$inc_description,$inc_submit_date,$inc_submit_time,$inc_submit_by,$inc_approve_comment,$inc_approve_date,$inc_approve_time,$inc_approve_by,$inc_status,$inc_severity;	
	$id=$_REQUEST['id'];
	include('config.php');
	$query="SELECT d.name AS dname,i.severity,ic.name AS cname,i.occured_date,i.title,i.description,i.submit_date,i.submit_time,i.submit_by,i.approve_comment,i.approved_date,i.approved_time,i.approved_by,i.status FROM incident as i , incident_categoty as ic, device as d WHERE i.system=d.id AND i.categoty=ic.id AND i.id='$id'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$inc_device=$row['dname'];
		$inc_category=$row['cname'];
		$inc_occured_date=$row['occured_date'];
		$inc_title=$row['title'];
		$inc_description=$row['description'];
		$inc_submit_date=$row['submit_date'];
		$inc_submit_time=$row['submit_time'];
		$inc_submit_by=$row['submit_by'];
		$inc_approve_comment=$row['approve_comment'];
		$inc_approve_date=$row['approved_date'];
		$inc_approve_time=$row['approved_time'];
		$inc_approve_by=$row['approved_by'];
		$inc_status=$row['status'];
		switch ($row['severity']){
			case "1" : $inc_severity='Critical'; break;
			case "2" : $inc_severity='High'; break;
			case "3" : $inc_severity='Medium'; break;
			case "4" : $inc_severity='Low'; break;
		}
	} 
}

function addIncident(){
	global $message;
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$system=$_REQUEST['system'];
	$severity=$_REQUEST['severity'];
	$category=$_REQUEST['category'];
	$occured_date=$_REQUEST['occured_date'];
	$title=filter_var($_REQUEST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$description=filter_var($_REQUEST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	include('config.php');
	
		$query0="SELECT name FROM device WHERE id='$system'";
		$result0 = $conn->query($query0);
		$devname_0=mysqli_fetch_row($result0);
		$devname0=$devname_0[0];
	
	$query1="INSERT INTO `incident` ( `system`,`severity`,`categoty`,`occured_date`,`title`,`description`,`submit_date`,`submit_time`,`submit_by`,`status`) VALUES ('$system','$severity','$category','$occured_date','$title','$description','$date','$time','$user','1')";
	$result1 = $conn->query($query1);
	$last_id = $conn->insert_id;
	
		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$title.'</td></tr>
			<tr><td>Incident ID</td><td>'.str_pad($last_id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Incident Date</td><td>'.$occured_date.'</td></tr>
			<tr><td>Associated Device</td><td>'.$devname0.'</td></tr>
			<tr><td>Submited By</td><td>'.$user.'</td></tr>';

	if($result1){
		$query2="SELECT ma.username,m.id,ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='incident' AND ma.`level`='Approver'";
		$result2 = $conn->query($query2);
		while($row= $result2->fetch_assoc()) {
			$user0=$row['username'];
			$mid=$row['id'];
			$authid=$row['authid'];
			if($user0!=''){
				dashboard('add','1',$user0,$mid,$last_id,'Incident - '.str_pad($last_id,5,"0",STR_PAD_LEFT).' Approval Pending','index.php?components=incident&action=show_approve_inc&id='.$last_id);
				sendmail($user0,'Incident','incident','template1',$last_id,$body,'Incident Details','Approval pending by You','show_approve_inc',$authid);
			}
		}
	} 
	if($result1){
		$message='Incident was Submited Successfully'; 
		return true;
	}else{
		$message='Error ! Incident could not be Sent';
		return false;
	}
}

function approveIncident($task){
	global $message;
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST['id'];
	$comment=filter_var($_REQUEST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$k=0;
	if($task=='approve'){ $status=3; $word='Approved'; }
	if($task=='reject'){ $status=2; $word='Rejected'; }
	if($status==2) $wording='Incident was Rejected';
	if($status==3) $wording='Incident was Approved';
	include('config.php');
	
	$query2="SELECT inc.title,inc.occured_date,inc.submit_by,dev.name FROM incident inc, device dev WHERE inc.system=dev.id AND inc.id='$id'";
	$result2 = $conn->query($query2);
	while($row= $result2->fetch_assoc()) {
		$title0=$row['title'];
		$occured_date0=$row['occured_date'];
		$user0=$row['submit_by'];
		$devname0=$row['name'];
	}
	
		//---------------email content--------------//
		$body='<tr><td width="200px">Title</td><td>'.$title0.'</td></tr>
			<tr><td>Incident ID</td><td>'.str_pad($id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Incident Date</td><td>'.$occured_date0.'</td></tr>
			<tr><td>Associated Device</td><td>'.$devname0.'</td></tr>
			<tr><td>Submited By</td><td>'.$user0.'</td></tr>
			<tr><td>'.$word.' By</td><td>'.$user.'</td></tr>';

	$query="UPDATE `incident` SET `approve_comment`='$comment',`approved_by`='$user',`approved_date`='$date',`approved_time`='$time',`status`='$status' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='incident'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
			if($user0!=''){
				$query0="SELECT id as authid FROM module_authorization WHERE `module`='$mid' AND `level`='Submitter'";
				$result0 = $conn->query($query0);
				$authid_0=mysqli_fetch_row($result0);
				$authid=$authid_0[0];
			
				if($k==0) dashboard('delete','','',$mid,$id,'','');
				dashboard('add','2',$user0,$mid,$id,'Incident - '.str_pad($id,5,"0",STR_PAD_LEFT).' '.$wording,'index.php?components=incident&action=list_inc&id='.$id);
				sendmail($user0,'Incident','incident','template1',$id,$body,'Incident Details',$wording,'list_inc',$authid);
				$k++;
			}
	}
	if($result){
		$message='Incident Report was '.$word.' Successfully'; 
		return true;
	}else{
		$message='Error ! Incident Report could not be '.$word;
		return false;
	}
}


function listYears(){
	global $years,$height;
	$height='300px';
	$years=array();
	include('config.php');
	$query="SELECT DISTINCT year(occured_date) as `year` FROM incident";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$years[]=$row['year'];
	} 
	if(sizeof($years)==0) $years[]=date("Y");
}


function incidentStaus($filter){
	global $inc_id,$inc_date,$inc_title,$inc_status,$inc_relation,$color1;
	if($filter=='all') $st='1,2,3'; else
	if($filter=='pending') $st='1'; else
	if($filter=='approved') $st='3'; else
	if($filter=='rejected') $st='2'; else
	$st=$filter;
	$inc_id=$inc_date=$inc_title=$inc_status=array();
	$year=$_REQUEST['year'];
	include('config.php');
	$query="SELECT id,occured_date,title,`status` FROM incident WHERE year(occured_date)='$year' AND `status` IN ($st) ORDER BY id DESC";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$inc_id[]=$row['id'];
		$inc_date[]=$row['occured_date'];
		$inc_title[]=$row['title'];
		switch ($row['status']){
			case "1" : $inc_status[]='Approval Pending';  $color1[]='#069'; break;
			case "2" : $inc_status[]='Rejected'; $color1[]='red';  break;
			case "3" : $inc_status[]='Approved';  $color1[]='green'; break;
		}
		$inc_relation[]=getRelation($row['id'],false);
	} 
}

function reportDeviceBase(){
	global $count,$device_id,$device_name;
	include('config.php');
	$year=$_REQUEST['year'];
	$query="SELECT count(ic.id) as `count`,ic.system,cd.name FROM incident ic, device cd WHERE cd.id=ic.system AND ic.`status`='3' AND year(ic.occured_date)='$year' GROUP BY system";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$count[]=$row['count'];
		$device_id[]=$row['system'];
		$device_name[]=$row['name'];
	} 
}

function reportOneDevice($filter){
	global $inc_id,$inc_date,$inc_title,$inc_status,$color1;
	if(isset($_GET['device'])){
	if($filter=='all') $st='1,2,3'; else
	if($filter=='pending') $st='1'; else
	if($filter=='approved') $st='3'; else
	if($filter=='rejected') $st='2'; else
		$st=$filter;
		$year=$_REQUEST['year'];
		$device=$_REQUEST['device'];
		include('config.php');
		$query="SELECT id,occured_date,title,`status` FROM incident WHERE `system`='$device' AND year(occured_date)='$year' AND `status` IN ($st) ORDER BY id DESC";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
		$inc_id[]=$row['id'];
		$inc_date[]=$row['occured_date'];
		$inc_title[]=$row['title'];
		switch ($row['status']){
			case "1" : $inc_status[]='Approval Pending';  $color1[]='#069'; break;
			case "2" : $inc_status[]='Rejected'; $color1[]='red';  break;
			case "3" : $inc_status[]='Approved';  $color1[]='green'; break;
		}
		} 
	}
}

function deleteIncident(){
	global $message;
	$result=false;
	include('config.php');
	$id=$_REQUEST['id'];
	$query="DELETE FROM `incident` WHERE `id`='$id'";
	$result = $conn->query($query);
		
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='incident'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
		dashboard('delete','','',$mid,$id,'','');
	}
	if($result){
		$message='Incident was Deleted Successfully'; 
		return true;
	}else{
		$message='Error ! Incident could not be Deleted';
		return false;
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

function getRelation($id,$inc){
	global $rel_cms_id,$rel_cms_title,$rel_cms_impdate,$relation_date;
	$rel_cms_id=$rel_cms_title=$rel_cms_impdate=array();
	$relation_date='';
	$duration=10;
	include('config.php');
	if($inc){
		$query1="SELECT title,occured_date FROM incident WHERE id='$id'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			$ralation_data='[{v:"'.$row1['title'].'", f:'."'".$row1['title'].'<div style="color:red; font-style:italic">INCIDENT</div>'."'".'}, "", "The President"],';
			$inc_title=$row1['title'];
			$inc_date=$row1['occured_date'];
		} 
	}
	$query2="SELECT DISTINCT c.id,c.title,c.implemented_date FROM cms c, incident i, cms_device cd, device d1, device d2 WHERE c.id=cd.cms_id AND d1.id=cd.device_id AND i.system=d2.id AND c.implemented_date < i.occured_date AND c.implemented_date > date(i.occured_date - INTERVAL $duration DAY) AND c.`status`='6' AND i.`status`='3' AND d2.device_type='1' AND d1.device_type='2' AND i.id='$id'";
	$result2 = $conn->query($query2);
	while($row2= $result2->fetch_assoc()) {
		$rel_cms_id[]=$row2['id'];
		$rel_cms_title[]=$row2['title'];
		$rel_cms_impdate[]=$row2['implemented_date'];
		if($inc)	$relation_date.='[{v:"'.$row2['title'].'", f:'."'".$row2['title'].'<div><a style="color:red; font-style:italic" href="index.php?components=cms&action=list_cr&id='.$row2['id'].'">ID: '.str_pad($row2['id'],5,"0",STR_PAD_LEFT).'</a><div><div style="color:blue; font-style:italic">Imp Date: '.$row2['implemented_date'].'<div>'."'".'}, '."'".$inc_title.'<br /><a style="color:red; font-style:italic" href="index.php?components=incident&action=list_inc&id='.$id.'">INC ID: '.str_pad($id,5,"0",STR_PAD_LEFT).'</a><br />INC Date:'.$inc_date."'".', "CMS"],';
	} 
	$query3="SELECT DISTINCT c.id,c.title,c.implemented_date FROM cms c, incident i, cms_device cd WHERE c.id=cd.cms_id AND cd.device_id=i.system AND c.implemented_date < i.occured_date AND c.implemented_date > date(i.occured_date - INTERVAL $duration DAY) AND c.`status`='6' AND i.`status`='3' AND i.id='$id'";
	$result3 = $conn->query($query3);
	while($row3= $result3->fetch_assoc()) {
		$rel_cms_id[]=$row3['id'];
		$rel_cms_title[]=$row3['title'];
		$rel_cms_impdate[]=$row3['implemented_date'];
		if($inc)	$relation_date.='[{v:"'.$row3['title'].'", f:'."'".$row3['title'].'<div><a style="color:red; font-style:italic" href="index.php?components=cms&action=list_cr&id='.$row3['id'].'">ID: '.str_pad($row3['id'],5,"0",STR_PAD_LEFT).'</a><div><div style="color:blue; font-style:italic">Imp Date: '.$row3['implemented_date'].'<div>'."'".'}, '."'".$inc_title.'<br /><a style="color:red; font-style:italic" href="index.php?components=incident&action=list_inc&id='.$id.'">INC ID: '.str_pad($id,5,"0",STR_PAD_LEFT).'</a><br />INC Date:'.$inc_date."'".', "CMS"],';
	} 
	if(sizeof($rel_cms_id)>0)
		return true;
	else
		return false;
}

?>