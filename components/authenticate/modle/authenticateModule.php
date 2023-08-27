<?php

function companyProfile(){
	global $se_company,$se_appname;
	include('config.php');
	$query="SELECT `setting`,value FROM setting WHERE `setting`='company_name' OR `setting`='app_name' ORDER BY `setting`";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		if($row['setting']=='company_name') $se_company=$row['value'];
		if($row['setting']=='app_name') $se_appname=$row['value'];
	} 
}	

function login(){
	global $message;
	$message='Invalid Username or Password!';
	$blank=false;
	if(($_REQUEST['uname']=='')||($_REQUEST['passwd']=='')){
		$message='Username or Password cannot be Blank!';
		$blank=true;
	}
	$username=$_REQUEST['uname'];
	if(isset($_REQUEST['remember'])) $duration=7; else $duration=1;
	$password=$_REQUEST['passwd'];
	$password1=md5($password);
	$sqluser=$type_count='';
	$appadmin=array();
	$auth=0;
	
	include('config.php');
	$query="SELECT `name`,`username`,`type` FROM userprofile WHERE `username`='$username' AND `password`='$password1'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$name=$row['name'];
		$sqluser=$row['username'];
		$type_count=$row['type'];
	} 
	if($sqluser==$username){
		$auth=1;
	}else{

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

	    $ldap = ldap_connect($adServer);
	    $ldaprdn = $dn. "\\" . $username;
	    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
	    $bind = @ldap_bind($ldap, $ldaprdn, $password);

	    if ($bind) {
		        $filter="(sAMAccountName=$username)";
		        $result = ldap_search($ldap,$primary_dn,$filter);
		        ldap_sort($ldap,$result,"sn");
		        $info = ldap_get_entries($ldap, $result);
		        for ($i=0; $i<$info["count"]; $i++){
		            if($info['count'] > 1)
		                break;
		            $name=$info[$i]["givenname"][0];
		            $userDn = $info[$i]["distinguishedname"][0]; 
		         }
		        @ldap_close($ldap);
		        
		    $query="SELECT id FROM domainuser_appadmin WHERE username='$username'";
			$result = $conn->query($query);
			$appadmin=mysqli_fetch_row($result);
			if(sizeof($appadmin)>0) $type_count=1; else $type_count=2;
			$auth=2;
	    }
    }
 //   print $name;
 	if($blank) $auth=0;
    	//----------------------------Set Cookie----------------------------//
    if($auth!=0){
		setcookie("name",$name, time()+3600*24*$duration);
		setcookie("user",$username, time()+3600*24*$duration);
		setcookie("remember",$duration, time()+3600*24*$duration);
		setModuleAuthorization($username,$duration);		//--------Define Module Autorization
		if($type_count==1) setcookie("type",md5('appadmin'), time()+3600*24*$duration);
		if($type_count==2){
			if($auth==1) setcookie("type",md5('standaloneuser'), time()+3600*24*$duration);
			if($auth==2) setcookie("type",md5('domainuser'), time()+3600*24*$duration);
 		}
		return true;
	}else {
		return false;
    }
}

function setModuleAuthorization($user,$duration){
	include('config.php');
	
	$query1="SELECT DISTINCT CONCAT(m.component, ma.`level`) as cmp FROM module_authorization ma, module m WHERE m.id=ma.module AND m.`status`=1";
	$result1 = $conn->query($query1);
	while($row1= $result1->fetch_assoc()) {
		$cmp=$row1['cmp'];
		setcookie($cmp,'0', time()+(3600*24*$duration));
	}

	$query0="SELECT `id`,`component` FROM module WHERE `status`=1 AND authorization_required=1";
	$result0 = $conn->query($query0);
	while($row0= $result0->fetch_assoc()) {
		$moduleid=$row0['id'];
		$modulename=$row0['component'];
		$authorizationLevel=0;
			setcookie($modulename,md5($authorizationLevel), time()+(3600*24*$duration));
			
		$query1="SELECT DISTINCT `level` FROM module_authorization WHERE module='$moduleid' AND username='$user'";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			$authorizationLevel=$row1['level'];
			setcookie($modulename,md5($authorizationLevel), time()+(3600*24*$duration));
			setcookie($modulename.$authorizationLevel,md5($authorizationLevel), time()+(3600*24*$duration));
		} 
	} 
}

function logout(){
	include('config.php');
	if(isset($_COOKIE['remember'])){
		$duration=$_COOKIE['remember'];
		$query0="SELECT `component` FROM module WHERE `status`=1 AND authorization_required=1";
		$result0 = $conn->query($query0);
		while($row0= $result0->fetch_assoc()) {
			$modulename=$row0['component'];
			setcookie($modulename,'', time()-(3600*24*$duration));
		}
		$query1="SELECT DISTINCT CONCAT(m.component, ma.`level`) as cmp FROM module_authorization ma, module m WHERE m.id=ma.module AND m.`status`=1";
		$result1 = $conn->query($query1);
		while($row1= $result1->fetch_assoc()) {
			$modulename=$row1['cmp'];
			setcookie($modulename,'', time()-(3600*24*$duration));
		}
		setcookie("name",'', time()-3600*24*$duration);
		setcookie("user",'', time()-3600*24*$duration);
		setcookie("type",'', time()-3600*24*$duration);
		setcookie("remember",'', time()-3600*24*$duration);
	}
}
?>