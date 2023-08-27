<?php

function checkUpdate($updatenow,$checknow,$up_uid){
	global $checkupdatenow,$message,$keystatus;
	$message='';
	include('config.php');
	$query1="SELECT value FROM setting WHERE setting='key'";
	$result1 = $conn->query($query1);
	$key0=mysqli_fetch_row($result1);
	$key=$key0[0];
	$query1="SELECT value FROM setting WHERE setting='next_update'";
	$result1 = $conn->query($query1);
	$next_update0=mysqli_fetch_row($result1);
	$next_update=$next_update0[0];
	$query1="SELECT update_id FROM `update` WHERE id=(SELECT max(id) FROM `update`)";
	$result1 = $conn->query($query1);
	$update_version0=mysqli_fetch_row($result1);
	$update_version=$update_version0[0];
	$criticalupdate=$update_done=false;
	$keystatus=true;
	$url='http://www.wappcloud.com/APPCENTER/index.php?components=update&action=getupdate&version='.$update_version.'&key='.$key;
	
	$today=time();
	if(($today>$next_update)||($checknow)){
		$checkupdatenow=true;
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($url);
		$appstatus = $xmlDoc->getElementsByTagName( "status" )->item(0)->nodeValue;
		$x = $xmlDoc->getElementsByTagName( "update" );
		  foreach( $x as $entry )
		  {
		  $updateid[]= $entry->getElementsByTagName( "updateid" )->item(0)->nodeValue;
		  $type[]= $entry->getElementsByTagName( "type" )->item(0)->nodeValue;
		  $file[] = $entry->getElementsByTagName( "file" )->item(0)->nodeValue;
		  $update_sql[] = $entry->getElementsByTagName( "sql" )->item(0)->nodeValue;
		  }
		  
		  if($appstatus=='c4ca4238a0b923820dcc509a6f75849b'){
		  	for($i=0;$i<sizeof($updateid);$i++){
		  		if($type[$i]==1){
		  			$criticalupdate=true;
		  			if(($up_uid=='')&&($updatenow)){
		  				$update_done=performUpdate($updateid[$i],$file[$i],$update_sql[$i],$key);
		  				// print $updateid[$i].' - '.$file[$i].'<br />';
		  			}
		  		}
		  		if($type[$i]==2){
		  			if($checknow){
		  				$criticalupdate=true;
		  				$message='New Updates are Available';
		  			}
		  			availableUpdate('add',$updateid[$i]);
		  			if($up_uid!='') if($up_uid==$updateid[$i]) $update_done=performUpdate($updateid[$i],$file[$i],$update_sql[$i],$key);
		  		}
		  	}
		  }else
		  if($appstatus=='eccbc87e4b5ce2fe28308fd9f2a7baf3'){ $keystatus=false; $message='Invalid License Key! Please Contact Support';	}

	}else{
		$checkupdatenow=false;
	}
	if(($checkupdatenow&&$criticalupdate)||$update_done)
		return true;
	else
		return false;
}

function performUpdate($newversion,$filename,$updatesql,$key){
	global $message;
	$s1=$_SERVER['SCRIPT_FILENAME'];
	$s2=strpos($s1,'/index.php');
	$s3=substr($s1,0,$s2);
	$fileextract=false;
	$datetime=time();
	$nextupdate_date = strtotime("+10 day");	// ----------Set Next Automatic Update check to be after 10 Days
	$url0='http://www.wappcloud.com/APPCENTER/index.php?components=update&action=update_version_info&version='.$newversion.'&key='.$key;
	include('config.php');

	$source='http://www.wappcloud.com/APPCENTER/updates/'.$filename;
	$destination = $s3.'/download/'.$filename;

	if ( copy($source, $destination ) ) {
	    //echo "Copy success!";
	    $zip = new ZipArchive;
		$res = $zip->open('download/'.$filename);
		if ($res === TRUE) {
		  if($zip->extractTo('.')) $fileextract=true;
		  $zip->close();
		} else {
			$message='Update Error!: Zip file Could not be Opened!';
		}
	}else{
		$message='File Copying Failed!';
	}
	
	if($fileextract){
		if($updatesql!=''){
			$sqlexecute='';
			$fh = fopen('download/'.$updatesql,'r');
			while ($line = fgets($fh)) {
			  $sqlexecute.=$line;
			}
			fclose($fh);
			$result3 = $conn->query($sqlexecute);
		}else $result3=true;
	}
	
	if($fileextract&&$result3){
		$message='The Update was Completed Successfully!';
		unlink('download/'.$filename);
		if($updatesql!='') unlink('download/'.$updatesql);
		$query1="INSERT INTO `update` ( `update_id`,`updated_date`) VALUES ('$newversion','$datetime')";
		$result1 = $conn->query($query1);
		$query2="UPDATE `setting` SET `value`='$nextupdate_date' WHERE `setting`='next_update'";
		$result2 = $conn->query($query2);
		availableUpdate('delete',$newversion);
		$xmlDo = new DOMDocument();			//Update version Infomation on Remote Server
		$xmlDo->load($url0);				//Update version Infomation on Remote Server
		return true;
	} else{
		$message='Update Error: File could not be Extracted!';
		return false;
	}
}

function availableUpdate($action,$update_id){
	$nextupdate_date = strtotime("+10 day");	// ----------Set Next Automatic Update check to be after 10 Days
	$id='';
	include('config.php');
	$query0="SELECT id FROM available_update WHERE `update_id`='$update_id'";
	$result0 = $conn->query($query0);
	while($row= $result0->fetch_assoc()) {
		$id=$row['id'];
		if($action=='delete'){
			$query1="DELETE FROM `available_update` WHERE id='$id'";
			$result1 = $conn->query($query1);
		}
	}
	if($id==''){
		if($action=='add'){
			$query1="INSERT INTO `available_update` ( `update_id`) VALUES ('$update_id')";
			$result1 = $conn->query($query1);
		}
	}
		$query2="UPDATE `setting` SET `value`='$nextupdate_date' WHERE `setting`='next_update'";
		$result2 = $conn->query($query2);
}

function listUpdate(){
	global $up_id,$up_uid,$up_note;
	include('config.php');
	$query0="SELECT id,update_id FROM available_update";
	$result0 = $conn->query($query0);
	while($row= $result0->fetch_assoc()) {
		$up_id[]=$row['id'];
		$up_uid[]=$row['update_id'];
		$up_note[]='Release_Note_'.str_replace('.','_',$row['update_id']);
	}
}
?>