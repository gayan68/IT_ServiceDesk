<?php

function listModule(){
	global $module_id,$module_name,$module_component,$module_action,$module_location,$left_margin;
	$left_margin=413;
	include('config.php');
		$query="SELECT `id`,`name`,`component`,`action`,`authorization_required` FROM module WHERE `status`=1 ORDER BY `order`";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$coolkiename=$row['component'];
			if($row['authorization_required']==1){
				if($_COOKIE[$coolkiename]!=md5(0)){
				$module_id[]=$row['id'];
				$module_name[]=$row['name'];
				$module_component[]=$row['component'];
				$module_action[]=$row['action'];
				$module_location[]='middle';
				$left_margin=$left_margin-57;
				}
			}else if($row['component']=='settings'){
				if(($_COOKIE['type']==md5('appadmin'))||($_COOKIE['type']==md5('standaloneuser'))){
				$module_id[]=$row['id'];
				$module_name[]=$row['name'];
				$module_component[]=$row['component'];
				$module_action[]=$row['action'];
				$module_location[]='middle';
				$left_margin=$left_margin-57;
				}
			}else{
				$module_id[]=$row['id'];
				$module_name[]=$row['name'];
				$module_component[]=$row['component'];
				$module_action[]=$row['action'];
				$module_location[]='middle';
				$left_margin=$left_margin-57;
			}
		} 
		$module_location[sizeof($module_id)-1]='last';
		
}

function companyProfile(){
	global $se_company_template,$se_appname_template;
	include('config.php');
	$query="SELECT `setting`,value FROM setting WHERE `setting`='company_name' OR `setting`='app_name' ORDER BY `setting`";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		if($row['setting']=='company_name') $se_company_template=$row['value'];
		if($row['setting']=='app_name') $se_appname_template=$row['value'];
	} 
}	

?>

