<?php

function sendmail($user,$modulename,$module,$template,$id,$body,$titlebody,$heading,$action2,$authid){
	$to='';
	$sent=false;
	$server_url0=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$server_url=substr($server_url0,0,strrpos($server_url0,'/'));
	include('config.php');
	$query0="SELECT count(*) FROM module_authorization WHERE email_status='1' AND id='$authid'";
	$result0 = $conn->query($query0);
	$authorization=mysqli_fetch_row($result0);

	if($authorization[0]==1){
		$query1="SELECT DISTINCT up.email FROM userprofile up WHERE up.email!='' AND up.username='$user'";
		$result1 = $conn->query($query1);
		$email=mysqli_fetch_row($result1);
		$to=$email[0];
		if($to=='') $to=adEmailQuery($user);
		
		$query0="SELECT `value` FROM setting WHERE `setting`='app_name'";
		$result0 = $conn->query($query0);
		$appname0=mysqli_fetch_row($result0);
		$appname=$appname0[0];
		$query0="SELECT `value` FROM setting WHERE `setting`='sending_mail_add'";
		$result0 = $conn->query($query0);
		$mailadd=mysqli_fetch_row($result0);
		$sending_mailadd=$mailadd[0];
	
		if($to!=''){
			include  'components/settings/view/email/'.$template.'.php';
			$subject = $appname.' | '.$module.' Alert';
			$from = $sending_mailadd;
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			$headers .= 'From: '.$from. "\r\n";	
			
			$sent=mail($to,$subject,$message,$headers);
		}
	}
	if($sent)return true; else return false;
}

function adEmailQuery($user){
	$person = $user;
	$hint = "";
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
    $justthese = array("mail");
    $filter="(|(samaccountname=$person))";
    
    if ($bind) {
       $result = ldap_search($ldap,$primary_dn,$filter, $justthese);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        if(isset($info[0]['mail'][0]))	$hint=$info[0]['mail'][0];
		@ldap_close($ldap);
	}
	return $hint;
}


?>