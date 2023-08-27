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

function listDevices(){
	global $id,$name,$ip1,$ip2,$device_type,$id_list,$count,$checklist_close,$height;
	setTimezone();
	include('config.php');
	$id_list='';
	$checklist_close=false;
	$height='300px';
	$date=date("Y-m-d");
	$time=date("H:i");
	$query0="SELECT count(`id`) FROM checklist WHERE `submit_date`='$date'";
	$result0 = $conn->query($query0);
	$count=mysqli_fetch_row($result0);
	if($count[0]==0){
		$height='20px';
		$query1="SELECT id,device_type,name,ip1,ip2,`status` FROM device WHERE `status`='1' ORDER BY device_type,id";
		$result1 = $conn->query($query1);
			while($row1= $result1->fetch_assoc()) {
		        switch ($row1['device_type']){
		            case "4" : $device_type='Other';   break;
		            case "1" : $device_type='Servers';   break;
		            case "2" : $device_type='Network Devices';   break;
		            case "3" : $device_type='Applications';   break;
		        }
		        	$id[$device_type][]=$row1['id'];
		            $name[$device_type][]=$row1['name'];
		            $ip1[$device_type][]=$row1['ip1'];
		            $ip2[$device_type][]=$row1['ip2'];   
		            $id_list=$id_list.$row1['id'].',';
		}
	}
	
	$query3="SELECT value FROM setting WHERE setting='checklist_close'";
	$result3 = $conn->query($query3);
	$checklist_close0=mysqli_fetch_row($result3);
	
	if(substr($time,0,2)>substr($checklist_close0[0],0,2)) $checklist_close=true;
	else{
		if(substr($time,0,2)==substr($checklist_close0[0],0,2))
			if(substr($time,3,2)>substr($checklist_close0[0],3,2)) $checklist_close=true;
	}
	
	if($checklist_close){
	$query3="SELECT value FROM setting WHERE setting='checlkist_onetime'";
	$result3 = $conn->query($query3);
	$checlkist_onetime=mysqli_fetch_row($result3);
		if($checlkist_onetime[0]==1)$checklist_close=false;
	}
}

function addChecklist(){
	global $message;
	include('config.php');
	setTimezone();
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$query1="INSERT INTO `checklist` ( `submit_by`,`submit_date`,`submit_time`,`status`) VALUES ('$user','$date','$time','0')";
	$result1 = $conn->query($query1);
	$checklist_id = $conn->insert_id;
	
		//---------------email content--------------//
		$body='<tr><td width="200px">Checklist ID</td><td>'.str_pad($checklist_id,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Checklist Date</td><td>'.$date.'</td></tr>
			<tr><td>Submitted By</td><td>'.$user.'</td></tr>';
	
	$query0="SELECT id,device_type,name,ip1,ip2,`status` FROM device WHERE `status`='1' ORDER BY device_type,id";
	$result0 = $conn->query($query0);
	while($row= $result0->fetch_assoc()) {
		$id=$row['id'];
		if($_REQUEST['status'.$id]=='up') $status=1;
		if($_REQUEST['status'.$id]=='down') $status=0;
		if(isset($_REQUEST['down_comment_'.$id])){
			$comment=$_REQUEST['down_comment_'.$id];
		}else{
			$comment='';
		}
		if($comment!=''){
			$query2="INSERT INTO `check_list_comment` ( `comment`) VALUES ('$comment')";
			$result2 = $conn->query($query2);
			$comment_id = $conn->insert_id;
		} else $comment_id =1;
			$query3="INSERT INTO `checklist_data` ( `checklist_id`,`device_id`, `status`, `comment`) VALUES ('$checklist_id','$id', '$status','$comment_id')";
			$result3 = $conn->query($query3);
	}
	
		if($result3){
			$query5="SELECT ma.username,m.id,ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='checklist' AND ma.`level`='Approver'";
			$result5 = $conn->query($query5);
			while($row= $result5->fetch_assoc()) {
				$user0=$row['username'];
				$mid=$row['id'];
				$authid=$row['authid'];
				if($user0!=''){
					dashboard('add','1',$user0,$mid,$checklist_id,'Checklist - '.str_pad($checklist_id,5,"0",STR_PAD_LEFT).' Approval Pending','index.php?components=checklist&action=show_approve&id='.$checklist_id);
					sendmail($user0,'Checklist','checklist','template1',$checklist_id,$body,'Checklist Details','Checklist Approval pending by You','show_approve',$authid);				
				}
			}
		} 

	if($result3){
		$query4="UPDATE `setting` SET `value`='0' WHERE `setting`='checlkist_onetime'";
		$result4 = $conn->query($query4);
		$message='Checklist was Submitted Successfully'; 
		return true;
	}else{
		$message='Error ! Checklist could not be Submitted';
		return false;
	}
}

function updateChecklist(){
	global $message;
	
	$id0=$_REQUEST['checklist_id'];
	$user=$_COOKIE['user'];
	include('config.php');
	$query1="UPDATE `checklist` SET `submit_by`='$user', `status`='0' WHERE `id`='$id0'";
	$result1 = $conn->query($query1);
	
	$query0="SELECT submit_date FROM checklist WHERE id='$id0'";
	$result0 = $conn->query($query0);
	$row0=mysqli_fetch_row($result0);
	$submitted_date=$row0[0];

		//---------------email content--------------//
		$body='<tr><td width="200px">Checklist ID</td><td>'.str_pad($id0,5,"0",STR_PAD_LEFT).'</td></tr>
			<tr><td>Checklist Date</td><td>'.$submitted_date.'</td></tr>
			<tr><td>Submitted By</td><td>'.$user.'</td></tr>';

	$query0="SELECT id,`comment` FROM checklist_data WHERE checklist_id='$id0'";
	$result0 = $conn->query($query0);
	while($row= $result0->fetch_assoc()) {
		$id=$row['id'];
		if($_REQUEST['status'.$id]=='up') $status=1;
		if($_REQUEST['status'.$id]=='down') $status=0;
		if(isset($_REQUEST['down_comment_'.$id])){
			$comment=$_REQUEST['down_comment_'.$id];
		}else{
			$comment='';
		}
		if($comment!=''){
			if($row['comment']==1){
				$query2="INSERT INTO `check_list_comment` ( `comment`) VALUES ('$comment')";
				$result2 = $conn->query($query2);
				$comment_id = $conn->insert_id;
			}else{
				$comment_id = $row['comment'];
				$query2="UPDATE `check_list_comment` SET `comment`='$comment' WHERE `id`='$comment_id'";
				$result2 = $conn->query($query2);
			}
		} else $comment_id =1;
			$query3="UPDATE  `checklist_data`  SET `status`='$status', `comment`='$comment_id' WHERE `id`='$id'";
			$result3 = $conn->query($query3);
			print "$query3<br />";
	}
	if($result3){
		$query5="SELECT ma.username,ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='checklist' AND ma.`level`='Approver'";
		$result5 = $conn->query($query5);
		while($row= $result5->fetch_assoc()) {
			$user0=$row['username'];
			$authid=$row['authid'];
			sendmail($user0,'Checklist','checklist','template1',$id0,$body,'Checklist Details','Checklist Approval pending by You','show_approve',$authid);						
		}
		$message='Checklist was Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Checklist could not be Updated';
		return false;
	}

}


function showCheckList(){
	global $checklistid,$submit_by,$submit_date,$submit_time,$approve_by,$approve_date,$approve_time,$img,$id,$name,$ip1,$ip2,$status,$comment,$id_list,$height;
	$checklistid=$_REQUEST['id'];
	$height='20px';
	include('config.php');
	$query0="SELECT submit_by,submit_date,submit_time,approve_by,approve_date,approve_time,`status` FROM checklist WHERE id='$checklistid'";
	$result0 = $conn->query($query0);
	$row0=mysqli_fetch_row($result0);
	$submit_by=$row0[0];
	$submit_date=$row0[1];
	$submit_time=$row0[2];
	$approve_by=$row0[3];
	$approve_date=$row0[4];
	$approve_time=$row0[5];
		switch ($row0[6]){
			case "0" : $img='pending.gif';   break;
		    case "1" : $img='approved.gif';   break;
		    case "2" : $img='rejected.gif';   break;
		}

	$query1="SELECT cd.id, cdev.device_type, cdev.name, cdev.ip1, cdev.ip2, cd.`status`, cc.`comment` FROM checklist_data cd, device cdev, check_list_comment cc WHERE cdev.id=cd.device_id AND cd.`comment`=cc.id AND cd.checklist_id='$checklistid' ORDER BY cdev.device_type, cdev.id";
	$result1 = $conn->query($query1);
	while($row= $result1->fetch_assoc()) {
		switch ($row['device_type']){
			case "4" : $device_type='Other';   break;
		    case "1" : $device_type='Servers';   break;
		    case "2" : $device_type='Network Devices';   break;
		    case "3" : $device_type='Applications';   break;
		}
		$id[$device_type][]=$row['id'];
		$name[$device_type][]=$row['name'];
		$ip1[$device_type][]=$row['ip1'];
		$ip2[$device_type][]=$row['ip2'];   
		$status[$device_type][]=$row['status'];   
		$comment[$device_type][]=$row['comment'];   
		$id_list=$id_list.$row['id'].',';
	}
}

function showApproveComment(){
	global $approve_comment;
	$checklistid=$_REQUEST['id'];
	$height='20px';
	include('config.php');
	$query0="SELECT cc.`comment` FROM checklist cl, check_list_comment cc WHERE cl.approve_comment=cc.id AND cl.id='$checklistid'";
	$result0 = $conn->query($query0);
	$row0=mysqli_fetch_row($result0);
	$approve_comment=$row0[0];
}

function approve(){
	global $message;
	include('config.php');
	setTimezone();	
	$user=$_COOKIE['user'];
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$id=$_REQUEST['id'];
	$comment=$_REQUEST['comment'];
	
		if($comment!=''){
			$query2="INSERT INTO `check_list_comment` ( `comment`) VALUES ('$comment')";
			$result2 = $conn->query($query2);
			$comment_id = $conn->insert_id;
		} else $comment_id =1;
	$query="UPDATE `checklist` SET `status`= '1',`approve_by`= '$user',`approve_date`= '$date',`approve_time`= '$time',`approve_comment`= '$comment_id' WHERE id = '$id'";
	$result = $conn->query($query);
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='checklist'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
		dashboard('delete','','',$mid,$id,'','');
	}

	if($result){
		$message='Checklist was Approved Successfully'; 
		return true;
	}else{
		$message='Error ! Checklist could not be Approved';
		return false;
	}
}

function reject(){
	global $message;
	
	include('config.php');
	$id=$_REQUEST['id'];
	$user=$_COOKIE['user'];
	$k=0;
	$query="UPDATE `checklist` SET `status`= '2' WHERE id = '$id'";
	$result = $conn->query($query);
	if($result){
		$query1="SELECT `id` FROM module WHERE `component`='checklist'";
		$result1 = $conn->query($query1);
		$id_1=mysqli_fetch_row($result1);
		$mid=$id_1[0];
		$query2="SELECT submit_by,submit_date FROM checklist WHERE id='$id'";
		$result2 = $conn->query($query2);
		while($row= $result2->fetch_assoc()) {
			$user0=$row['submit_by'];
			$submitted_date=$row['submit_date'];
			if($user0!=''){
			
			$query5="SELECT ma.id as authid FROM module_authorization ma, module m WHERE m.id=ma.`module` AND m.component='checklist' AND ma.`level`='Approver'";
			$result5 = $conn->query($query5);
			$authid_5=mysqli_fetch_row($result5);
			$authid=$authid_5[0];
			
			//---------------email content--------------//
			$body='<tr><td width="200px">Checklist ID</td><td>'.str_pad($id,5,"0",STR_PAD_LEFT).'</td></tr>
				<tr><td>Checklist Date</td><td>'.$submitted_date.'</td></tr>
				<tr><td>Submitted By</td><td>'.$user0.'</td></tr>
				<tr><td>Rejected By</td><td>'.$user.'</td></tr>';

				if($k==0) dashboard('delete','','',$mid,$id,'','');
				dashboard('add','2',$user0,$mid,$id,'Checklist - '.str_pad($id,5,"0",STR_PAD_LEFT).' Was Rejected','index.php?components=checklist&action=show_checklist&id='.$id);
				sendmail($user0,'Checklist','checklist','template1',$id,$body,'Checklist Details','The Checklist was Rejected!','show_checklist',$authid);						
				$k++;
			}
		}
	}
	if($result){
		$message='Checklist was Rejected Successfully'; 
		return true;
	}else{
		$message='Error ! Checklist could not be Rejected';
		return false;
	}
}

function listChecklist($status,$filter){
	global $id,$date,$count,$cl_status,$img,$height;
	$height=260;
	$user=$_COOKIE['user'];
	if($status==7) $sqlstatus=''; else $sqlstatus="WHERE `status`='$status'";
	if($filter=='submiter') $sqlfilter="WHERE `submit_by`='$user'"; else $sqlfilter='';
	include('config.php');
		$query1="SELECT id,submit_date,`status` FROM checklist $sqlstatus $sqlfilter ORDER BY submit_date DESC";
	$result1 = $conn->query($query1);
	while($row= $result1->fetch_assoc()) {
		 switch ($row['status']){
		 	case "0" : $cl_status[]='Pending'; $img[]='pending.png';  break;
		    case "1" : $cl_status[]='Approved'; $img[]='approve.png';  break;
		    case "2" : $cl_status[]='Rejected'; $img[]='reject.png';  break;
		}
		$id[]=$row['id'];
		$date[]=$row['submit_date'];
		$height=$height-35;
	}
	$count=sizeof($id);
	if($height<10) $height=10;
}

//-----------------------------------------REPORT----------------------------------------//

function listYears(){
	global $years,$height;
	$height='300px';
	$years=array();
	include('config.php');
	$query="SELECT DISTINCT year(submit_date) as `year` FROM checklist WHERE approve_by!=''";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$years[]=$row['year'];
	} 
	if(sizeof($years)==0) $years[]=date("Y");
}

function deviceFailure(){
	global $cl_id,$cl_dates,$height,$header;
	$height='300px';
	$year=$_REQUEST['year'];
	$header='Device Failures Report for '.$year;
	include('config.php');
	$query="SELECT DISTINCT cl.id,cl.submit_date FROM checklist cl, checklist_data cd WHERE cl.id=cd.checklist_id AND cd.`status`=0 AND approve_by!='' AND year(cl.submit_date)='$year'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$cl_id[]=$row['id'];
		$cl_dates[]=$row['submit_date'];
	} 
}

function missingChecklistt(){
	global $missingdays,$year,$mis_month,$mis_day,$height,$header;
	$height='300px';
	$year=$_REQUEST['year'];
	$header='Missing Checklist Report for '.$year;
	include('config.php');
	//check for holidays
	$query="SELECT  value FROM setting WHERE `setting`='working_days'";
	$result = $conn->query($query);
	$workingdays0=mysqli_fetch_row($result);
	$workingdays1=$workingdays0[0];
	$workingdays=explode(",",$workingdays1);
	//---------
	$query0="SELECT MAX(submit_date) FROM checklist WHERE year(submit_date)='$year'";
	$result0 = $conn->query($query0);
	$enddate=mysqli_fetch_row($result0);
	$now = strtotime($year.'-01-01');
	$aYearLater = strtotime($enddate[0]);
	
	$allDates = Array();
	
	$sunday = strtotime('Next Sunday', strtotime('-1 Day', $now));
	$monday = strtotime('Next Monday', strtotime('-1 Day', $now));
	$tuesday = strtotime('Next Tuesday', strtotime('-1 Day', $now));
	$wednesday = strtotime('Next Wednesday', strtotime('-1 Day', $now));
	$thursday = strtotime('Next Thursday', strtotime('-1 Day', $now));
	$friday = strtotime('Next Friday', strtotime('-1 Day', $now));
	$saturday = strtotime('Next Saturday', strtotime('-1 Day', $now));
	
	while(1){
	    if(($sunday > $aYearLater)||($monday > $aYearLater)||($tuesday > $aYearLater)||($wednesday > $aYearLater)||($thursday > $aYearLater)||($friday > $aYearLater)||($saturday > $aYearLater))     break 1;
		    if(in_array(1, $workingdays)) $allDates[] = date('Y-m-d', $sunday);
		    if(in_array(2, $workingdays)) $allDates[] = date('Y-m-d', $monday);
		    if(in_array(3, $workingdays)) $allDates[] = date('Y-m-d', $tuesday);
		    if(in_array(4, $workingdays)) $allDates[] = date('Y-m-d', $wednesday);
		    if(in_array(5, $workingdays)) $allDates[] = date('Y-m-d', $thursday);
		    if(in_array(6, $workingdays)) $allDates[] = date('Y-m-d', $friday);
		    if(in_array(7, $workingdays)) $allDates[] = date('Y-m-d', $saturday);
	
	    $sunday = strtotime('+1 Week', $sunday);
	    $monday = strtotime('+1 Week', $monday);
	    $tuesday = strtotime('+1 Week', $tuesday);
	    $wednesday = strtotime('+1 Week', $wednesday);
	    $thursday = strtotime('+1 Week', $thursday);
	    $friday = strtotime('+1 Week', $friday);
	    $saturday = strtotime('+1 Week', $saturday);
	}
	
	$active_days="(SELECT '".implode("' AS id) UNION ALL (SELECT '",$allDates)."' AS id)";
	$query="SELECT days.id, month(days.id) as `month`, day(days.id) as `day` FROM( $active_days ) AS days WHERE days.id NOT IN (SELECT submit_date FROM checklist)";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$missingdays[]=$row['id'];
		$mis_month[]=$row['month'];
		$mis_day[]=$row['day'];
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

function deleteChecklist(){
	global $message;
	
	include('config.php');
	$id=$_REQUEST['id'];
	$query="DELETE FROM `checklist_data` WHERE `checklist_id`='$id'";
	$result = $conn->query($query);
	
	$query="DELETE FROM `checklist` WHERE `id`='$id'";
	$result = $conn->query($query);

	if($result){
		$message='Checklist was Deleted Successfully'; 
		return true;
	}else{
		$message='Error ! Checklist could not be Deleted';
		return false;
	}
}

?>