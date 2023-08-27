<?php
function setTimezone(){
	include('config.php');
	$queryt="SELECT value FROM setting WHERE setting='timezone'";
	$resultt = $conn->query($queryt);
	$timezone=mysqli_fetch_row($resultt);
	date_default_timezone_set("$timezone[0]");
}

function getModule(){
	global $id,$order,$name,$status,$id_list;
	$id_list='';
	include('config.php');
		$query="SELECT id,`order`,name,`status` FROM module ORDER BY `order`";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$id[]=$row['id'];
			$order[]=$row['order'];
			$name[]=$row['name'];
			$status[]=$row['status'];
			if($row['name']!='Settings') $id_list=$id_list.$row['id'].',';
		} 
}

//-----------------------General Settings------------------------------//            

function generalSettingsupdate1(){
	global $message;
	$uploadOk=true;
	$message='Error ! Settings could not be Updated';
	
	include('config.php');
	if(isset($_REQUEST['se_company'])&&isset($_REQUEST['se_appname'])){
		$se_company=$_REQUEST['se_company'];
		$se_appname=$_REQUEST['se_appname'];
		$query1="UPDATE `setting` SET `value`='$se_company' WHERE `setting`='company_name'";
		$result1 = $conn->query($query1);
		$query2="UPDATE `setting` SET `value`='$se_appname' WHERE `setting`='app_name'";
		$result2 = $conn->query($query2);
	}
	
	//---------IMG Upload----------//
	if(isset($_FILES["logUpload"]["size"])){
	if($_FILES["logUpload"]["name"]!=''){
		$target_file = 'images/logo.jpg';
		$imageFileType = pathinfo($_FILES["logUpload"]["name"],PATHINFO_EXTENSION);
	    $check = getimagesize($_FILES["logUpload"]["tmp_name"]);
	    if($check == false) {
	        $message="Error ! File is not an image.";
	        $uploadOk =false;
	    }
	    if ($_FILES["logUpload"]["size"] > 500000) {
		    $message="Sorry, your file is too large. Images has to be less than 500Kb";
		    $uploadOk =false;
		}
		if($imageFileType != "jpg" && $imageFileType != "jpge" ) {
		    $message="Sorry, only JPG files are allowed.";
		    $uploadOk =false;
		}	   
		if($uploadOk){
			move_uploaded_file($_FILES["logUpload"]["tmp_name"], $target_file);
		}
    }}
	//----------------------------//
	if($uploadOk){
		$message='Settings were Updated Successfully'; 
		return true;
	}else{
		return false;
	}
}

function generalSettingsupdate2(){
	global $message;
	$se_mail_srv=$_REQUEST['se_mailsrv'];
	$se_mail_from=$_REQUEST['se_mail_from'];
	$se_ldap=$_REQUEST['se_ldap'];
	$se_account=$_REQUEST['se_account'];
	$se_pass=strrev($_REQUEST['se_pass']);
	$se_timezone=$_REQUEST['timezone'];
	
	if(isset($_POST['emailalert']) &&  $_POST['emailalert'] == 'Yes') {    $email_alert=1;
	}else{    $email_alert=0; }  
	
	include('config.php');

	$query0="SELECT count(*) FROM module_authorization WHERE email_status='1'";
	$result0 = $conn->query($query0);
	$email_alert_count=mysqli_fetch_row($result0);
	if(($email_alert==0)||(($email_alert_count[0]==0)&&($email_alert==1))){
		$query1="UPDATE `module_authorization` SET `email_status`='$email_alert'";
		$result1 = $conn->query($query1);
	}
	
	$query1="UPDATE `setting` SET `value`='$se_mail_srv' WHERE `setting`='mail_srv'";
	$result1 = $conn->query($query1);
	
	$query1="UPDATE `setting` SET `value`='$se_mail_from' WHERE `setting`='sending_mail_add'";
	$result1 = $conn->query($query1);
	
	$query2="UPDATE `setting` SET `value`='$se_ldap' WHERE `setting`='ldap_server'";
	$result2 = $conn->query($query2);
	
	$query3="UPDATE `setting` SET `value`='$se_account' WHERE `setting`='ad_accout'";
	$result3 = $conn->query($query3);
	
	$query4="UPDATE `setting` SET `value`='$se_pass' WHERE `setting`='ad_pass'";
	if($se_pass!='')$result4 = $conn->query($query4);

	$query5="UPDATE `setting` SET `value`='$se_timezone' WHERE `setting`='timezone'";
	$result5 = $conn->query($query5);
	
	if(($result2)&&($result3)&&($result5)){
		$message='Settings were Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Settings could not be Updated';
		return false;
	}
}

function getGeneralSettings(){
	global $system_time,$se_ldap,$se_mail_srv,$se_mail_from,$se_company,$se_appname,$se_account,$se_pass,$se_timezone,$timezone_list,$email_alert;
	$timezone_list=array('Africa/Abidjan','Africa/Accra','Africa/Addis_Ababa','Africa/Algiers','Africa/Asmara','Africa/Asmera','Africa/Bamako','Africa/Bangui','Africa/Banjul','Africa/Bissau','Africa/Blantyre','Africa/Brazzaville','Africa/Bujumbura','Africa/Cairo','Africa/Casablanca','Africa/Ceuta','Africa/Conakry','Africa/Dakar','Africa/Dar_es_Salaam','Africa/Djibouti','Africa/Douala','Africa/El_Aaiun','Africa/Freetown','Africa/Gaborone','Africa/Harare','Africa/Johannesburg','Africa/Juba','Africa/Kampala','Africa/Khartoum','Africa/Kigali','Africa/Kinshasa','Africa/Lagos','Africa/Libreville','Africa/Lome','Africa/Luanda','Africa/Lubumbashi','Africa/Lusaka','Africa/Malabo','Africa/Maputo','Africa/Maseru','Africa/Mbabane','Africa/Mogadishu','Africa/Monrovia','Africa/Nairobi','Africa/Ndjamena','Africa/Niamey','Africa/Nouakchott','Africa/Ouagadougou','Africa/Porto-Novo','Africa/Sao_Tome','Africa/Timbuktu','Africa/Tripoli','Africa/Tunis','Africa/Windhoek','America/Adak','America/Anchorage','America/Anguilla','America/Antigua','America/Araguaina','America/Argentina/Buenos_Aires','America/Argentina/Catamarca','America/Argentina/ComodRivadavia','America/Argentina/Cordoba','America/Argentina/Jujuy','America/Argentina/La_Rioja','America/Argentina/Mendoza','America/Argentina/Rio_Gallegos','America/Argentina/Salta','America/Argentina/San_Juan','America/Argentina/San_Luis','America/Argentina/Tucuman','America/Argentina/Ushuaia','America/Aruba','America/Asuncion','America/Atikokan','America/Atka','America/Bahia','America/Bahia_Banderas','America/Barbados','America/Belem','America/Belize','America/Blanc-Sablon','America/Boa_Vista','America/Bogota','America/Boise','America/Buenos_Aires','America/Cambridge_Bay','America/Campo_Grande','America/Cancun','America/Caracas','America/Catamarca','America/Cayenne','America/Cayman','America/Chicago','America/Chihuahua','America/Coral_Harbour','America/Cordoba','America/Costa_Rica','America/Creston','America/Cuiaba','America/Curacao','America/Danmarkshavn','America/Dawson','America/Dawson_Creek','America/Denver','America/Detroit','America/Dominica','America/Edmonton','America/Eirunepe','America/El_Salvador','America/Ensenada','America/Fort_Wayne','America/Fortaleza','America/Glace_Bay','America/Godthab','America/Goose_Bay','America/Grand_Turk','America/Grenada','America/Guadeloupe','America/Guatemala','America/Guayaquil','America/Guyana','America/Halifax','America/Havana','America/Hermosillo','America/Indiana/Indianapolis','America/Indiana/Knox','America/Indiana/Marengo','America/Indiana/Petersburg','America/Indiana/Tell_City','America/Indiana/Vevay','America/Indiana/Vincennes','America/Indiana/Winamac','America/Indianapolis','America/Inuvik','America/Iqaluit','America/Jamaica','America/Jujuy','America/Juneau','America/Kentucky/Louisville','America/Kentucky/Monticello','America/Knox_IN','America/Kralendijk','America/La_Paz','America/Lima','America/Los_Angeles','America/Louisville','America/Lower_Princes','America/Maceio','America/Managua','America/Manaus','America/Marigot','America/Martinique','America/Matamoros','America/Mazatlan','America/Mendoza','America/Menominee','America/Merida','America/Metlakatla','America/Mexico_City','America/Miquelon','America/Moncton','America/Monterrey','America/Montevideo','America/Montreal','America/Montserrat','America/Nassau','America/New_York','America/Nipigon','America/Nome','America/Noronha','America/North_Dakota/Beulah','America/North_Dakota/Center','America/North_Dakota/New_Salem','America/Ojinaga','America/Panama','America/Pangnirtung','America/Paramaribo','America/Phoenix','America/Port-au-Prince','America/Port_of_Spain','America/Porto_Acre','America/Porto_Velho','America/Puerto_Rico','America/Rainy_River','America/Rankin_Inlet','America/Recife','America/Regina','America/Resolute','America/Rio_Branco','America/Rosario','America/Santa_Isabel','America/Santarem','America/Santiago','America/Santo_Domingo','America/Sao_Paulo','America/Scoresbysund','America/Shiprock','America/Sitka','America/St_Barthelemy','America/St_Johns','America/St_Kitts','America/St_Lucia','America/St_Thomas','America/St_Vincent','America/Swift_Current','America/Tegucigalpa','America/Thule','America/Thunder_Bay','America/Tijuana','America/Toronto','America/Tortola','America/Vancouver','America/Virgin','America/Whitehorse','America/Winnipeg','America/Yakutat','America/Yellowknife','Antarctica/Casey','Antarctica/Davis','Antarctica/DumontDUrville','Antarctica/Macquarie','Antarctica/Mawson','Antarctica/McMurdo','Antarctica/Palmer','Antarctica/Rothera','Antarctica/South_Pole','Antarctica/Syowa','Antarctica/Troll','Antarctica/Vostok','Arctic/Longyearbyen','Asia/Aden','Asia/Almaty','Asia/Amman','Asia/Anadyr','Asia/Aqtau','Asia/Aqtobe','Asia/Ashgabat','Asia/Ashkhabad','Asia/Baghdad','Asia/Bahrain','Asia/Baku','Asia/Bangkok','Asia/Beirut','Asia/Bishkek','Asia/Brunei','Asia/Calcutta','Asia/Chita','Asia/Choibalsan','Asia/Chongqing','Asia/Chungking','Asia/Colombo','Asia/Dacca','Asia/Damascus','Asia/Dhaka','Asia/Dili','Asia/Dubai','Asia/Dushanbe','Asia/Gaza','Asia/Harbin','Asia/Hebron','Asia/Ho_Chi_Minh','Asia/Hong_Kong','Asia/Hovd','Asia/Irkutsk','Asia/Istanbul','Asia/Jakarta','Asia/Jayapura','Asia/Jerusalem','Asia/Kabul','Asia/Kamchatka','Asia/Karachi','Asia/Kashgar','Asia/Kathmandu','Asia/Katmandu','Asia/Khandyga','Asia/Kolkata','Asia/Krasnoyarsk','Asia/Kuala_Lumpur','Asia/Kuching','Asia/Kuwait','Asia/Macao','Asia/Macau','Asia/Magadan','Asia/Makassar','Asia/Manila','Asia/Muscat','Asia/Nicosia','Asia/Novokuznetsk','Asia/Novosibirsk','Asia/Omsk','Asia/Oral','Asia/Phnom_Penh','Asia/Pontianak','Asia/Pyongyang','Asia/Qatar','Asia/Qyzylorda','Asia/Rangoon','Asia/Riyadh','Asia/Saigon','Asia/Sakhalin','Asia/Samarkand','Asia/Seoul','Asia/Shanghai','Asia/Singapore','Asia/Srednekolymsk','Asia/Taipei','Asia/Tashkent','Asia/Tbilisi','Asia/Tehran','Asia/Tel_Aviv','Asia/Thimbu','Asia/Thimphu','Asia/Tokyo','Asia/Ujung_Pandang','Asia/Ulaanbaatar','Asia/Ulan_Bator','Asia/Urumqi','Asia/Ust-Nera','Asia/Vientiane','Asia/Vladivostok','Asia/Yakutsk','Asia/Yekaterinburg','Asia/Yerevan','Atlantic/Azores','Atlantic/Bermuda','Atlantic/Canary','Atlantic/Cape_Verde','Atlantic/Faeroe','Atlantic/Faroe','Atlantic/Jan_Mayen','Atlantic/Madeira','Atlantic/Reykjavik','Atlantic/South_Georgia','Atlantic/St_Helena','Atlantic/Stanley','Australia/ACT','Australia/Adelaide','Australia/Brisbane','Australia/Broken_Hill','Australia/Canberra','Australia/Currie','Australia/Darwin','Australia/Eucla','Australia/Hobart','Australia/LHI','Australia/Lindeman','Australia/Lord_Howe','Australia/Melbourne','Australia/North','Australia/NSW','Australia/Perth','Australia/Queensland','Australia/South','Australia/Sydney','Australia/Tasmania','Australia/Victoria','Australia/West','Australia/Yancowinna','Europe/Amsterdam','Europe/Andorra','Europe/Athens','Europe/Belfast','Europe/Belgrade','Europe/Berlin','Europe/Bratislava','Europe/Brussels','Europe/Bucharest','Europe/Budapest','Europe/Busingen','Europe/Chisinau','Europe/Copenhagen','Europe/Dublin','Europe/Gibraltar','Europe/Guernsey','Europe/Helsinki','Europe/Isle_of_Man','Europe/Istanbul','Europe/Jersey','Europe/Kaliningrad','Europe/Kiev','Europe/Lisbon','Europe/Ljubljana','Europe/London','Europe/Luxembourg','Europe/Madrid','Europe/Malta','Europe/Mariehamn','Europe/Minsk','Europe/Monaco','Europe/Moscow','Europe/Nicosia','Europe/Oslo','Europe/Paris','Europe/Podgorica','Europe/Prague','Europe/Riga','Europe/Rome','Europe/Samara','Europe/San_Marino','Europe/Sarajevo','Europe/Simferopol','Europe/Skopje','Europe/Sofia','Europe/Stockholm','Europe/Tallinn','Europe/Tirane','Europe/Tiraspol','Europe/Uzhgorod','Europe/Vaduz','Europe/Vatican','Europe/Vienna','Europe/Vilnius','Europe/Volgograd','Europe/Warsaw','Europe/Zagreb','Europe/Zaporozhye','Europe/Zurich','Indian/Antananarivo','Indian/Chagos','Indian/Christmas','Indian/Cocos','Indian/Comoro','Indian/Kerguelen','Indian/Mahe','Indian/Maldives','Indian/Mauritius','Indian/Mayotte','Indian/Reunion','Pacific/Apia','Pacific/Auckland','Pacific/Bougainville','Pacific/Chatham','Pacific/Chuuk','Pacific/Easter','Pacific/Efate','Pacific/Enderbury','Pacific/Fakaofo','Pacific/Fiji','Pacific/Funafuti','Pacific/Galapagos','Pacific/Gambier','Pacific/Guadalcanal','Pacific/Guam','Pacific/Honolulu','Pacific/Johnston','Pacific/Kiritimati','Pacific/Kosrae','Pacific/Kwajalein','Pacific/Majuro','Pacific/Marquesas','Pacific/Midway','Pacific/Nauru','Pacific/Niue','Pacific/Norfolk','Pacific/Noumea','Pacific/Pago_Pago','Pacific/Palau','Pacific/Pitcairn','Pacific/Pohnpei','Pacific/Ponape','Pacific/Port_Moresby','Pacific/Rarotonga','Pacific/Saipan','Pacific/Samoa','Pacific/Tahiti','Pacific/Tarawa','Pacific/Tongatapu','Pacific/Truk','Pacific/Wake','Pacific/Wallis','Pacific/Yap','Brazil/Acre','Brazil/DeNoronha','Brazil/East','Brazil/West','Canada/Atlantic','Canada/Central','Canada/East-Saskatchewan','Canada/Eastern','Canada/Mountain','Canada/Newfoundland','Canada/Pacific','Canada/Saskatchewan','Canada/Yukon','CET','Chile/Continental','Chile/EasterIsland','CST6CDT','Cuba','EET','Egypt','Eire','EST','EST5EDT','Etc/GMT','Etc/GMT+0','Etc/GMT+1','Etc/GMT+10','Etc/GMT+11','Etc/GMT+12','Etc/GMT+2','Etc/GMT+3','Etc/GMT+4','Etc/GMT+5','Etc/GMT+6','Etc/GMT+7','Etc/GMT+8','Etc/GMT+9','Etc/GMT-0','Etc/GMT-1','Etc/GMT-10','Etc/GMT-11','Etc/GMT-12','Etc/GMT-13','Etc/GMT-14','Etc/GMT-2','Etc/GMT-3','Etc/GMT-4','Etc/GMT-5','Etc/GMT-6','Etc/GMT-7','Etc/GMT-8','Etc/GMT-9','Etc/GMT0','Etc/Greenwich','Etc/UCT','Etc/Universal','Etc/UTC','Etc/Zulu','Factory','GB','GB-Eire','GMT','GMT+0','GMT-0','GMT0','Greenwich','Hongkong','HST','Iceland','Iran','Israel','Jamaica','Japan','Kwajalein','Libya','MET','Mexico/BajaNorte','Mexico/BajaSur','Mexico/General','MST','MST7MDT','Navajo','NZ','NZ-CHAT','Poland','Portugal','PRC','PST8PDT','ROC','ROK','Singapore','Turkey','UCT','Universal','US/Alaska','US/Aleutian','US/Arizona','US/Central','US/East-Indiana','US/Eastern','US/Hawaii','US/Indiana-Starke','US/Michigan','US/Mountain','US/Pacific','US/Pacific-New','US/Samoa','UTC','W-SU','WET','Zulu' );
	//$timezone_list=array('asda','aaa','aaa1');
	include('config.php');
	$query="SELECT `setting`,value FROM setting";
	$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			if($row['setting']=='ldap_server') $se_ldap=$row['value'];
			if($row['setting']=='mail_srv') $se_mail_srv=$row['value'];
			if($row['setting']=='sending_mail_add') $se_mail_from=$row['value'];
			if($row['setting']=='company_name') $se_company=$row['value'];
			if($row['setting']=='app_name') $se_appname=$row['value'];
			if($row['setting']=='ad_accout') $se_account=$row['value'];
			if($row['setting']=='ad_pass') $se_pass=$row['value'];
			if($row['setting']=='timezone') $se_timezone=$row['value'];
		} 
	$query0="SELECT count(*) FROM module_authorization WHERE email_status='1'";
	$result0 = $conn->query($query0);
	$email_alert_count=mysqli_fetch_row($result0);
	if($email_alert_count[0]>0) $email_alert='checked="checked"'; else $email_alert='';
	setTimezone();
	$system_time=date("Y-m-d").' - '.date("H:i:s");
}

function listModuleMenu(){
	global $sub_status;
	include('config.php');
		$query="SELECT `component`,`status` FROM module";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$sub_status[$row['component']]=$row['status'];
		} 
}

function generalOrderUp(){
	global $message;
	$order0=$_REQUEST['id'];
	$order1=$order0-1;
	
	include('config.php');
	$query0="SELECT `id` FROM module WHERE `order`='$order0'";
	$result0 = $conn->query($query0);
	$id_0=mysqli_fetch_row($result0);
	$id0=$id_0[0];
	
	$query1="SELECT `id` FROM module WHERE `order`='$order1'";
	$result1 = $conn->query($query1);
	$id_1=mysqli_fetch_row($result1);
	$id1=$id_1[0];

	$query0="UPDATE `module` SET `order`='$order1' WHERE `id`='$id0'";
	$result3 = $conn->query($query0);
	
	$query1="UPDATE `module` SET `order`='$order0' WHERE `id`='$id1'";
	$result4 = $conn->query($query1);
	
	if(($result3)&&($result4)){
		$message='Order was Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Order could not be Updated';
		return false;
	}
}

function generalOrderDown(){
	global $message;
	$order0=$_REQUEST['id'];
	$order1=$order0+1;
	
	include('config.php');
	$query0="SELECT `id` FROM module WHERE `order`='$order0'";
	$result0 = $conn->query($query0);
	$id_0=mysqli_fetch_row($result0);
	$id0=$id_0[0];
	
	$query1="SELECT `id` FROM module WHERE `order`='$order1'";
	$result1 = $conn->query($query1);
	$id_1=mysqli_fetch_row($result1);
	$id1=$id_1[0];

	$query0="UPDATE `module` SET `order`='$order1' WHERE `id`='$id0'";
	$result3 = $conn->query($query0);
	
	$query1="UPDATE `module` SET `order`='$order0' WHERE `id`='$id1'";
	$result4 = $conn->query($query1);
	
	if(($result3)&&($result4)){
		$message='Order was Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Order could not be Updated';
		return false;
	}
}

function generalModuleActivate(){
	global $message;
	$id_list=$_REQUEST['id_list'];
	$idarr = explode(",", $id_list);
	include('config.php');
	for($i=0;$i<(sizeof($idarr)-1);$i++){
		$id=$idarr[$i];
		if(isset($_REQUEST['module'.$id])) $status=1; else $status=0;
		$query="UPDATE `module` SET `status`='$status' WHERE `id`='$id'";
		$result = $conn->query($query);
	}
	if($result){
		$message='Module was Activated Successfully'; 
		return true;
	}else{
		$message='Error ! Module could not be Activated!';
		return false;
	}
}

//-------------------------------User Profile---------------------------------//

function listStandaloneUsers(){
	global $user_id,$user_name,$user_username,$user_email,$user_type;
	include('config.php');
	$query="SELECT `id`,`name`,`username`,`email`,`type` FROM userprofile";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$user_id[]=$row['id'];
		$user_name[]=$row['name'];
		$user_username[]=$row['username'];
		$user_email[]=$row['email'];
		$user_type[]=$row['type'];
	} 
}

function listDomainUsers(){
	global $domainuser_id,$domainuser_username;
	include('config.php');
	$query="SELECT `id`,`username` FROM domainuser_appadmin";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$domainuser_id[]=$row['id'];
		$domainuser_username[]=$row['username'];
	} 
}

function userprofileCreateuser(){
	global $message;
	$name=$_REQUEST['u_name'];
	$username=$_REQUEST['u_username'];
	$password=md5($_REQUEST['u_pass']);
	$type=$_REQUEST['type'];
	$email=$_REQUEST['u_email'];
	include('config.php');
	$query="INSERT INTO `userprofile` ( `name`,`username`,`password`,`email`,`type`) VALUES ('$name','$username','$password','$email','$type')";
	$result = $conn->query($query);
	if($result){
		$message='User was created Successfully!'; 
		return true;
	}else{
		$message='Error ! User could not be Created!';
		return false;
	}
}

function userprofileChangePwd(){
	global $message;
	$id=$_REQUEST['userid'];
	$password=md5($_REQUEST['u_pass']);
	include('config.php');
	$query="UPDATE `userprofile` SET `password`='$password' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$message='Pasword was Changed Successfully!'; 
		return true;
	}else{
		$message='Error ! Pasword could not be Changed!';
		return false;
	}
}

function userprofileEdituser(){
	global $message;
	$id=$_REQUEST['userid'];
	$name=$_REQUEST['u_name'];
	$type=$_REQUEST['type'];
	$email=$_REQUEST['u_email'];
	include('config.php');
	$query="UPDATE `userprofile` SET `name`='$name', `email`='$email', `type`='$type' WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$message='User was Updated Successfully!'; 
		return true;
	}else{
		$message='Error ! User could not be Updated!';
		return false;
	}
}

function userprofileDelete(){
	global $message;
	$id=$_REQUEST['userid'];
	include('config.php');
	$query="DELETE FROM `userprofile` WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$message='User was Delete Successfully!'; 
		return true;
	}else{
		$message='Error ! User could not be Deleted!';
		return false;
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
			$hint0[]=$info[$i]["samaccountname"][0];
		    //print_r($info[$i]);
		$hint0=(array_unique($hint0));
		$hint= implode(', ', $hint0);
		}  
		//print $hint; 
		@ldap_close($ldap);
	}
	}
	return $hint;
}

function adQuery2(){
	$person = $_REQUEST["q"];
	$hint = "";
	$adquery_date=false;
	if(strlen($person)>2){
	include('config.php');
	$query0="SELECT `value` FROM setting WHERE `setting`='ldap_server'";
	$result0 = $conn->query($query0);
	$ldap_srv0=mysqli_fetch_row($result0);
	if($ldap_srv0[0]!=''){
		$adquery_date=true;
		$s1=(stripos($ldap_srv0[0],'.')+1);
		$s2=stripos($ldap_srv0[0],'.',$s1);
		$dn=substr($ldap_srv0[0],$s1,$s2-$s1);
		
		$adServer='ldap://'.$ldap_srv0[0];
		$pos=strpos($ldap_srv0[0],'.');
		$primary_dn=substr($ldap_srv0[0],$pos+1,(strlen($ldap_srv0[0])-$pos));
		$primary_dn='dc='.str_replace('.',',dc=',$primary_dn);
 	}
	$query0="SELECT `value` FROM setting WHERE `setting`='ad_accout'";
	$result0 = $conn->query($query0);
	$ldap_acc=mysqli_fetch_row($result0);
 	
	$query0="SELECT `value` FROM setting WHERE `setting`='ad_pass'";
	$result0 = $conn->query($query0);
	$ldap_pass=mysqli_fetch_row($result0);
	
	if(($ldap_acc[0]!='')&&($ldap_pass[0]))	$adquery_date=true;
	if($adquery_date){
		$username=$ldap_acc[0];
		$password=strrev($ldap_pass[0]);
		
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
	       	//var_dump ($info);
			for ($i=0; $i < $info["count"]; $i++) {
				if(isset($info[$i]["samaccountname"][0]))
				$hint0[]=$info[$i]["samaccountname"][0];
			  //  print_r($info[$i]);
			$hint0=(array_unique($hint0));
			$hint= implode(', ', $hint0);
			}  
			@ldap_close($ldap);
		}
	}
	//---------------------standalone users------------------//
	$k=0;
	$query="SELECT `username` FROM userprofile WHERE `username` LIKE '$person%' OR `name` LIKE '$person%'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		if($hint==''){ if($k==0) $hint=$row['username']; 
		 else 	$hint=$hint.','.$row['username'];
		}else{	$hint=$hint.','.$row['username']; }
	}
	}
		//print $hint; 
	return $hint;
}

function adAdduser(){
	global $message;
	$username=trim($_REQUEST['ad_username']," ");
	include('config.php');
	$query="INSERT INTO `domainuser_appAdmin` ( `username`) VALUES ('$username')";
	$result = $conn->query($query);
	if($result){
		$message='Domain User was Added to APP Admins'; 
		return true;
	}else{
		$message='Error ! Domain user could not be Added to APP Admins!';
		return false;
	}
}

function adDeleteuser(){
	global $message;
	$id=$_REQUEST['id'];
	include('config.php');
	$query="DELETE FROM `domainuser_appadmin` WHERE `id`='$id'";
	$result = $conn->query($query);
	if($result){
		$message='User was Removed from App Admin Successfully!'; 
		return true;
	}else{
		$message='Error ! User could not be Removed from App Admin!';
		return false;
	}
}

//---------------------------------------------My Profile-----------------------------------//

function listUser($username){
	global $user_id,$user_name,$user_username;
	include('config.php');
	$query="SELECT `id`,`name`,`username` FROM userprofile WHERE username='$username'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$user_id=$row['id'];
		$user_name=$row['name'];
		$user_username=$row['username'];
	} 
}

function listEmailSubscription(){
	global $authid,$module_name,$auth_level,$email_status;
	$authid=$module_name=$auth_level=$email_status=array();
	$user=$_COOKIE['user'];
	include('config.php');
		$query="SELECT  ma.id,m.name,ma.`level`,ma.email_status FROM module_authorization ma, module m WHERE m.id=ma.`module` AND ma.username='$user'";
		$result = $conn->query($query);
		while($row= $result->fetch_assoc()) {
			$authid[]=$row['id'];
			$module_name[]=$row['name'];
			$auth_level[]=$row['level'];
			if($row['email_status']==1) $email_status[]='checked="checked"'; else  $email_status[]='';
		} 
}

function emailSubscription($subscription){
	global $message;
	$authid=$_REQUEST['authid'];
	if($subscription==1) $ms='Enabled'; $ms='Disabled';
	include('config.php');
	$query="UPDATE `module_authorization` SET `email_status`='$subscription' WHERE `id`='$authid'";
	$result = $conn->query($query);
	if($result){
		$message='Email Subscription was '.$ms.' Successfully';
		return true;
	}else{
		$message='Error ! Email Subscription could not be Mobified!';
		return false;
	}
}

//---------------------------------------------Checklist------------------------------------//

function checklistReopen(){
	global $message;
	if($_GET['reopen']=='true'){
		$reopen=1;
		$message='Checklist was Re-Opend for One time';
	}else{
		$reopen=0;
		$message='Re-Opend was Canceled';
	}
	include('config.php');
	$query="UPDATE `setting` SET `value`='$reopen' WHERE `setting`='checlkist_onetime'";
	$result = $conn->query($query);
	
	if($result){
		return true;
	}else{
		$message='Error ! Checklist Could not be Re-Open!';
		return false;
	}

}

function checklistCloseTime(){
	global $message;
	$cl_close=$_REQUEST['cl_close'];
	include('config.php');
	$query="UPDATE `setting` SET `value`='$cl_close' WHERE `setting`='checklist_close'";
	$result = $conn->query($query);
	
	if($result){
		$message='Checklist Close Time was Updated Successfully';
		return true;
	}else{
		$message='Error ! Checklist Close Time could not be Mobified!';
		return false;
	}
}

function checklistWorkingdays(){
	global $message;
	$days=$_REQUEST['days'];
	include('config.php');
	$query="UPDATE `setting` SET `value`='$days' WHERE `setting`='working_days'";
	$result = $conn->query($query);
	
	if($result){
		$message='Working Days were Updated Successfully';
		return true;
	}else{
		$message='Error ! Working Days could not be Updated!';
		return false;
	}
}

function listChecklistGeneral(){
	global $cl_reopen,$cl_close,$sun,$mon,$tue,$wed,$thu,$fri,$sat;
	include('config.php');
	$sun=$mon=$tue=$wed=$thu=$fri=$sat=false;
	$query="SELECT value FROM setting WHERE `setting`='checlkist_onetime'";
	$result = $conn->query($query);
	$value=mysqli_fetch_row($result);
	$cl_reopen=$value[0];
	$query="SELECT value FROM setting WHERE `setting`='checklist_close'";
	$result = $conn->query($query);
	$value=mysqli_fetch_row($result);
	$cl_close=$value[0];
	$query="SELECT value FROM setting WHERE `setting`='working_days'";
	$result = $conn->query($query);
	$value=mysqli_fetch_row($result);
	$workingdays1=$value[0];
	$workingdays=explode(",",$workingdays1);
	for($n=0;$n<sizeof($workingdays);$n++){
		if($workingdays[$n]==1) $sun=true;
		if($workingdays[$n]==2) $mon=true;
		if($workingdays[$n]==3) $tue=true;
		if($workingdays[$n]==4) $wed=true;
		if($workingdays[$n]==5) $thu=true;
		if($workingdays[$n]==6) $fri=true;
		if($workingdays[$n]==7) $sat=true;
	}
}

function listChecklistUsers(){
	global $cuser_id,$cuser_username,$cl_reopen,$cl_close;
	$cuser_id['Checklist Submitter']=$cuser_username['Checklist Submitter']=array();
	$cuser_id['Checklist Approver']=$cuser_username['Checklist Approver']=array();
	$cuser_id['Top Manager']=$cuser_username['Top Manager']=array();
	$cuser_id['Auditor']=$cuser_username['Auditor']=array();
	include('config.php');
	$query="SELECT ma.`id`,ma.`username`,ma.`level` FROM module_authorization ma, module md WHERE md.id=ma.module AND md.component='checklist'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		switch ($row['level']){
			case "Submitter" : $user_type='Checklist Submitter';   break;
			case "Approver" : $user_type='Checklist Approver';   break;
			case "Manager" : $user_type='Top Manager';   break;
			case "Auditor" : $user_type='Auditor';   break;
		}
		if($user_type!=''){
		$cuser_id[$user_type][]=$row['id'];
		$cuser_username[$user_type][]=$row['username'];
		}
	}
}

function adduserAuthorization($component){
	global $message;
	$username=trim($_REQUEST['username']," ");
	$level=$_REQUEST['level'];
	$result1=false;
	$subteam=1;
	$count=array();
	include('config.php');
	$query="SELECT ma.`level` FROM module_authorization ma, module md WHERE md.id=ma.module AND md.component='$component' AND ma.username='$username'";
	$result = $conn->query($query);
	$count=mysqli_fetch_row($result);
	if($component=='cms') $count=array();
	if(sizeof($count)==0) $level0=$level; else $level0=$count[0];
		switch ($level0){
			case "Submitter" : $user_type='Submitter'; $level1=$level;  break;
			case "Approver" : $user_type='Approver'; $level1=$level;  break;
			case "Manager" : $user_type='Top Manager'; $level1=$level;  break;
			case "Auditor" : $user_type='Auditor'; $level1=$level;  break;
			case "Requester" : $user_type='Requester'; $level1=$level;  break;
			case "Analysis" : $user_type='Analysis'; $level1=$level; $subteam=$_REQUEST['ana_team']; break;
			case "Approver2" : $user_type='Approver'; $level1="Approver";  break;
			case "Implementer" : $user_type='Implementer'; $level1=$level;  break;
		}
	if(sizeof($count)==0){
		$query0="SELECT `id` FROM module WHERE `component`='$component'";
		$result0 = $conn->query($query0);
		$module0=mysqli_fetch_row($result0);
		$module=$module0[0];
		$query1="INSERT INTO `module_authorization` ( `module`,`username`,`level`,`subteam`) VALUES ('$module','$username','$level1','$subteam')";
		$result1 = $conn->query($query1);
		$message='Error ! User could not be Added to '.$user_type.'!';
	}else{
		$message='Error ! The Same User is Configured as a '.$user_type.'! &nbsp; Cannot Assign Multiple Roles for a User';
	}
	

	if($result1){
		$message='User was Added to '.$user_type.' Successfully'; 
		return true;
	}else{
		return false;
	}
}

function checklistDeleteuser(){
	global $message;
	$id=$_REQUEST['id'];
	$type=$_REQUEST['type'];
	include('config.php');
	$query="DELETE FROM `module_authorization` WHERE `id`='$id'";
	$result = $conn->query($query);
	
	switch ($type){
		case "1" : $user_type='Checklist Submitter';   break;
		case "2" : $user_type='Checklist Approver';   break;
		case "3" : $user_type='Top Manager';   break;
		case "4" : $user_type='Auditor';   break;
	}

	if($result){
		$message='User was Removed from '.$user_type.' Successfully'; 
		return true;
	}else{
		$message='Error ! User could not be Removed from '.$user_type.'!';
		return false;
	}
}

function listDevices(){
	global $dev1_id,$dev1_name,$dev1_ip1,$dev1_ip2,$dev2_id,$dev2_name,$dev2_ip1,$dev2_ip2,$dev_type,$dev3_type,$dev3_name,$dev3_ip1,$dev3_ip2;
	$dev_type=array(1=>"Servers",2=>"Network Devices",3=>"Applications",4=>"Other");
	include('config.php');
	$query1="SELECT id,name,ip1,ip2,device_type FROM device WHERE `status`=1 ORDER BY device_type, id";
	$result1 = $conn->query($query1);
	while($row1= $result1->fetch_assoc()) {
		$dev1_id[$row1['device_type']][]=$row1['id'];
		$dev1_name[$row1['device_type']][]=$row1['name'];
		$dev1_ip1[$row1['device_type']][]=$row1['ip1'];
		$dev1_ip2[$row1['device_type']][]=$row1['ip2'];
	}
	
	$query2="SELECT id,name,ip1,ip2,device_type FROM device WHERE `status`=0 ORDER BY device_type, id";
	$result2 = $conn->query($query2);
	while($row2= $result2->fetch_assoc()) {
		$dev2_id[$row2['device_type']][]=$row2['id'];
		$dev2_name[$row2['device_type']][]=$row2['name'];
		$dev2_ip1[$row2['device_type']][]=$row2['ip1'];
		$dev2_ip2[$row2['device_type']][]=$row2['ip2'];
	}
	if(isset($_GET['sub'])){
		if($_GET['sub']=='edit_dev'){
			$id0=$_GET['id'];
			$query3="SELECT device_type,name,ip1,ip2 FROM device WHERE `id`='$id0'";
			$result3 = $conn->query($query3);
			while($row3= $result3->fetch_assoc()) {
				$dev3_type=$row3['device_type'];
				$dev3_name=$row3['name'];
				$dev3_ip1=$row3['ip1'];
				$dev3_ip2=$row3['ip2'];
			}
		}
	}
}

function deviceStatus($status){
	global $message;
	if($status==0) $msg='decommissioned';
	if($status==1) $msg='activated';
	$id=$_REQUEST['id'];
	include('config.php');
	$query="UPDATE `device` SET `status`='$status' WHERE `id`='$id'";
	$result = $conn->query($query);
	
	if($result){
		$message='The Device was '.$msg.' Successfully';
		return true;
	}else{
		$message='Error ! The Device could not be '.$msg.'!';
		return false;
	}
}

function deviceAdd(){
	global $message;
	include('config.php');
	$dtype=$_REQUEST['dtype'];
	$dname=$_REQUEST['dname'];
	$dip1=$_REQUEST['dip1'];
	$dip2=$_REQUEST['dip2'];
	$query1="INSERT INTO `device` ( `device_type`,`name`,`ip1`,`ip2`,`status`) VALUES ('$dtype','$dname','$dip1','$dip2','1')";
	$result1 = $conn->query($query1);
	
	if($result1){
		$message='Device was Added Successfully'; 
		return true;
	}else{
		$message='Error! | Device could not be Added'; 
		return false;
	}
}

function deviceEdit(){
	global $message;
	include('config.php');
	$id=$_REQUEST['id'];
	$dtype=$_REQUEST['dtype'];
	$dname=$_REQUEST['dname'];
	$dip1=$_REQUEST['dip1'];
	$dip2=$_REQUEST['dip2'];
	$query1="UPDATE `device` SET `device_type`='$dtype',`name`='$dname',`ip1`='$dip1',`ip2`='$dip2' WHERE `id`='$id'";
	$result1 = $conn->query($query1);
	
	if($result1){
		$message='Device was Updated Successfully'; 
		return true;
	}else{
		$message='Error! | Device could not be Updated'; 
		return false;
	}
}

function deviceDelete(){
	global $message;
	$id=$_REQUEST['id'];
	include('config.php');
	$query1="SELECT COUNT(id) FROM checklist_data WHERE device_id='$id'";
	$result1 = $conn->query($query1);
	$count=mysqli_fetch_row($result1);
	if($count[0]==0){
		$query2="DELETE FROM `device` WHERE `id`='$id'";
		$result2 = $conn->query($query2);
		if($result2){
			$message='Device was Delete Successfully!'; 
			$out=true;
		}else{
			$message='Error! Device could not be Delete!'; 
			$out=false;
		}
	}else{
		$message='Associated Checklists should be Deleted !'; 
		$out=false;
	}
	if($out){
		return true;
	}else{
		return false;
	}
}

function cmsAddTeam(){
	global $message;
	include('config.php');
	$category=$_REQUEST['category'];
	$query1="INSERT INTO `cms_ana_team` (`team_name`) VALUES ('$category')";
	$result1 = $conn->query($query1);
	
	if($result1){
		$message='Team was Added Successfully'; 
		return true;
	}else{
		$message='Error! | Team could not be Added'; 
		return false;
	}
}
//-----------------------------------------CMS--------------------------------------------------//
function CMSanaTeam(){
	global $team_id,$team_name;
	include('config.php');
	$query="SELECT id,team_name FROM cms_ana_team WHERE id!=1";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$team_id[]=$row['id'];
		$team_name[]=$row['team_name'];
	}
}

function listCMSUsers(){
	global $cuser_id,$cuser_username,$team_id,$cuser_subteam,$team_name;
	$cuser_id['Requester']=$cuser_username['Requester']=array();
	$cuser_id['Analysis']=$cuser_username['Analysis']=array();
	$cuser_id['Approver']=$cuser_username['Approver']=array();
	$cuser_id['Implementer']=$cuser_username['Implementer']=array();
	$cuser_id['Auditor']=$cuser_username['Auditor']=array();
	include('config.php');
	$query="SELECT ma.`id`,ma.`username`,ma.`level`,at.`team_name` FROM module_authorization ma, module md, cms_ana_team at  WHERE at.id=ma.subteam AND md.id=ma.module AND md.component='cms'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$user_type=$row['level'];
		if($user_type!=''){
			$cuser_id[$user_type][]=$row['id'];
			$cuser_username[$user_type][]=$row['username'];
			$cuser_subteam[$user_type][]=$row['team_name'];
		}
	}
}

function removeuserAuthorization(){
	global $message;
	$id=$_REQUEST['id'];
	$type=$_REQUEST['type'];
	include('config.php');
	$query="DELETE FROM `module_authorization` WHERE `id`='$id'";
	$result = $conn->query($query);
	
	if($result){
		$message='User was Removed from '.$type.' Successfully'; 
		return true;
	}else{
		$message='Error ! User could not be Removed from '.$type.'!';
		return false;
	}
}

function cmsEditTeam(){
	global $message;
	$id=$_REQUEST['id'];
	$category=$_REQUEST['category'];
	include('config.php');
	$query="UPDATE `cms_ana_team` SET `team_name`='$category' WHERE `id`='$id'";
	$result = $conn->query($query);
	
	if($result){
		$message='Team was Updated Successfully'; 
		return true;
	}else{
		$message='Error ! Team Could not be Updated';
		return false;
	}
}

function cmsDeleteTeam(){
	global $message;
	$id=$_REQUEST['id'];
	include('config.php');
	$query1="SELECT COUNT(id) FROM cms WHERE impact_analyser='$id'";
	$result1 = $conn->query($query1);
	$count=mysqli_fetch_row($result1);
	if($count[0]==0){
		$query2="DELETE FROM `cms_ana_team` WHERE `id`='$id'";
		$result2 = $conn->query($query2);
		if($result2){
			$message='Team was Delete Successfully!'; 
			$out=true;
		}else{
			$message='Error! Team could not be Delete!'; 
			$out=false;
		}
	}else{
		$message='Associated CMS should be Deleted !'; 
		$out=false;
	}
	if($out){
		return true;
	}else{
		return false;
	}
}


//-----------------------------------------Incident--------------------------------------------------//

function incidentGeneral(){
	global $id1,$name1;
	include('config.php');
	$query1="SELECT `id`,`name` FROM incident_categoty";
	$result1 = $conn->query($query1);
	while($row= $result1->fetch_assoc()) {
		$id1[]=$row['id'];
		$name1[]=$row['name'];
	} 
}

function listIncidentUsers(){
	global $cuser_id,$cuser_username,$cuser_subteam;
	$cuser_id['Submitter']=$cuser_username['Submitter']=array();
	$cuser_id['Approver']=$cuser_username['Approver']=array();
	$cuser_id['Auditor']=$cuser_username['Auditor']=array();
	include('config.php');
	$query="SELECT ma.`id`,ma.`username`,ma.`level` FROM module_authorization ma, module md  WHERE  md.id=ma.module AND md.component='incident'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$user_type=$row['level'];
		if($user_type!=''){
			$cuser_id[$user_type][]=$row['id'];
			$cuser_username[$user_type][]=$row['username'];
		}
	}
}

function incidentAddcategory(){
	global $message;
	include('config.php');
	$name=$_REQUEST['category'];
	$query="INSERT INTO `incident_categoty` (`name`) VALUES ('$name')";
	$result = $conn->query($query);
		
	if($result){
		$message='Category was Added Successfully'; 
		return true;
	}else{
		$message='Error! | Category could not be Added'; 
		return false;
	}
}

function incidentEditcategory(){
	global $message;
	include('config.php');
	$id=$_REQUEST['id'];
	$category=$_REQUEST['category'];
	$query="UPDATE `incident_categoty` SET `name`='$category' WHERE `id`='$id'";
	$result = $conn->query($query);
		
	if($result){
		$message='Category was Updated Successfully'; 
		return true;
	}else{
		$message='Error! | Category could not be Updated'; 
		return false;
	}
}

function incidentDeletecategory(){
	global $message;
	$id=$_REQUEST['id'];
	include('config.php');
	$query1="SELECT COUNT(id) FROM incident WHERE categoty='$id'";
	$result1 = $conn->query($query1);
	$count=mysqli_fetch_row($result1);
	if($count[0]==0){
		$query2="DELETE FROM `incident_categoty` WHERE `id`='$id'";
		$result2 = $conn->query($query2);
		if($result2){
			$message='Category was Delete Successfully!'; 
			$out=true;
		}else{
			$message='Error! Category could not be Delete!'; 
			$out=false;
		}
	}else{
		$message='Associated Incidents should be Deleted !'; 
		$out=false;
	}
	if($out){
		return true;
	}else{
		return false;
	}
}

//-----------------------------------------Inventory--------------------------------------------------//
function listInventoryUsers(){
	global $cuser_id,$cuser_username;
	$cuser_id['Submitter']=$cuser_username['Submitter']=array();
	include('config.php');
	$query="SELECT ma.`id`,ma.`username`,ma.`level` FROM module_authorization ma, module md  WHERE  md.id=ma.module AND md.component='inventory'";
	$result = $conn->query($query);
	while($row= $result->fetch_assoc()) {
		$user_type=$row['level'];
		if($user_type!=''){
			$cuser_id[$user_type][]=$row['id'];
			$cuser_username[$user_type][]=$row['username'];
		}
	}
}

?>