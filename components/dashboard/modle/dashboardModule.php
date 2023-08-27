<?php
function setTimezone(){
	include('config.php');
	$queryt="SELECT value FROM setting WHERE setting='timezone'";
	$resultt = $conn->query($queryt);
	$timezone=mysqli_fetch_row($resultt);
	date_default_timezone_set("$timezone[0]");
}

function setInitialVar(){
	global $today_checklist,$today_checklist_apr,$reopen_sent,$checklist_reopen;
	$today_checklist=true;
    $today_checklist_apr=true;
    $reopen_sent=false;
    $checklist_reopen=false;
}

function checklistSubmiter(){
	global $today_checklist,$checklist_close;
	setTimezone();
	$date=date("Y-m-d");
	$user=$_COOKIE['user'];
	$today_checklist=false;	
	include('config.php');
	
	$query2="SELECT count(`id`) FROM checklist WHERE `submit_date`='$date'";
	$result2 = $conn->query($query2);
	$count=mysqli_fetch_row($result2);
	if($count[0]>0) $today_checklist=true;
	
	$query3="SELECT value FROM setting WHERE setting='checklist_close'";
	$result3 = $conn->query($query3);
	$checklist_close=mysqli_fetch_row($result3);
	
	$query4="SELECT count(id) FROM module WHERE component='checklist' AND `status`=1 ";
	$result4 = $conn->query($query4);
	$module_status=mysqli_fetch_row($result4);
	if($module_status[0]==0){
		$today_checklist=true;
	}

}

function checklistApprover(){
	global $today_checklist_apr,$checklist_reopen,$reopen_sent,$date_apr;
	setTimezone();
	$date=date("Y-m-d");
	$date_apr=$date;
	$time=date("H:i");
	$today_checklist_apr=$checklist_close=$checklist_reopen=$reopen_sent=false;
	$checklist_close=false;
	
	include('config.php');

	$query2="SELECT count(`id`) FROM checklist WHERE `submit_date`='$date'";
	$result2 = $conn->query($query2);
	$count=mysqli_fetch_row($result2);
	if($count[0]>0) $today_checklist_apr=true;
	
	if(!$today_checklist_apr){
		$query3="SELECT value FROM setting WHERE setting='checklist_close'";
		$result3 = $conn->query($query3);
		$checklist_close0=mysqli_fetch_row($result3);
	
		if(substr($time,0,2)>substr($checklist_close0[0],0,2)) $checklist_close=true;
		else{
			if(substr($time,0,2)==substr($checklist_close0[0],0,2))
				if(substr($time,3,2)>substr($checklist_close0[0],3,2)) $checklist_close=true;
		}
	}
	
		$query3="SELECT value FROM setting WHERE setting='checlkist_onetime'";
		$result3 = $conn->query($query3);
		$checklist_reopen0=mysqli_fetch_row($result3);
		if($checklist_reopen0[0]==1) $reopen_sent=true;
		
	if($checklist_close){
		if($checklist_reopen0[0]==0) $checklist_reopen=true;
	}
	
	$query4="SELECT count(id) FROM module WHERE component='checklist' AND `status`=1 ";
	$result4 = $conn->query($query4);
	$module_status=mysqli_fetch_row($result4);
	if($module_status[0]==0){
	    $today_checklist_apr=true;
	    $reopen_sent=false;
	    $checklist_reopen=false;
	}
}

function L2Chart(){
	$t=time();
	for($i=0;$i<10;$i++){
		echo(date("Y-m-d",$t)).'<br />';
		$t=$t-86400;
	}
}

function getDashboardEvent(){
	global $event_0id,$event_0type,$event_0date,$module_0id,$task_0id,$event_0des,$event_0url;
	$user=$_COOKIE['user'];
	setTimezone();
	include('config.php');
	
	$query1="SELECT `id`,`type`,`date`,`module`,`task_id`,`description`,`url` FROM dashboard WHERE `user`='$user'";
	$result1 = $conn->query($query1);
	while($row1= $result1->fetch_assoc()) {
		$event_0id[]=$row1['id'];
		$event_0type[]=$row1['type'];
		$event_0date[]=$row1['date'];
		$module_0id[]=$row1['module'];
		$task_0id[]=$row1['task_id'];
		$event_0des[]=$row1['description'];
		$event_0url[]=$row1['url'];
	}
}

function chartData(){
	global $chart_cms_count,$chart_cms_date,$chart_inc_count,$chart_inc_date,$chart_date;
	$chart_date=$chart_inc_count=$chart_cms_count='';
	$duration=30;
	$chart_cms_count0=$chart_cms_date=$chart_inc_count0=$chart_inc_date=array();
	include('config.php');
	$query1="SELECT count(id) as `count`,requested_date FROM cms WHERE requested_date < date(now()) AND requested_date > date(NOW() - INTERVAL $duration DAY) AND `status` IN (4,6) GROUP BY requested_date";
	$result1 = $conn->query($query1);
	while($row1= $result1->fetch_assoc()) {
		$chart_cms_count0[]=$row1['count'];
		$chart_cms_date[]=$row1['requested_date'];
	}
	$query2="SELECT count(id) as `count`,submit_date FROM incident WHERE submit_date < date(now()) AND submit_date > date(NOW() - INTERVAL $duration DAY) AND `status`='3' GROUP BY submit_date";
	$result2 = $conn->query($query2);
	while($row2= $result2->fetch_assoc()) {
		$chart_inc_count0[]=$row2['count'];
		$chart_inc_date[]=$row2['submit_date'];
	}
	
	for($k=1;$k<=$duration;$k++){
		$key1=$key2='';
		$chart_date0[]=date("M-d",time() - ($k*60*60*24));
		$chart_date=$chart_date."'".date("M-d",time() - ($k*60*60*24))."',";
		$chart_date1=date("Y-m-d",time() - ($k*60*60*24));
		if (in_array($chart_date1, $chart_cms_date)){
			$key1=array_search($chart_date1,$chart_cms_date);
			$chart_cms_count.=$chart_cms_count0[$key1].',';
		}else{
			$chart_cms_count.='0,';
		}
		if (in_array($chart_date1, $chart_inc_date)){
			$key2=array_search($chart_date1,$chart_inc_date);
			$chart_inc_count.=$chart_inc_count0[$key2].',';
		}else{
			$chart_inc_count.='0,';
		}
	}
	$chart_date=rtrim($chart_date, ",");
	$chart_cms_count=rtrim($chart_cms_count, ",");
	$chart_inc_count=rtrim($chart_inc_count, ",");
}

function acknowledge(){
	include('config.php');
	$id=$_REQUEST['id'];
	$query="DELETE FROM `dashboard` WHERE `id`='$id'";
	$result = $conn->query($query);
}


function checklistReopen(){
	if($_GET['reopen']=='true')	$reopen=1;	else	$reopen=0;
	include('config.php');
	$query="UPDATE `setting` SET `value`='$reopen' WHERE `setting`='checlkist_onetime'";
	$result = $conn->query($query);
	
	if($result)	return true;	else	return false;
}

?>