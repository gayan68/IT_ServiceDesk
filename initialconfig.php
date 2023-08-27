<?php
function setupDB($mysql_host,$mysql_username,$mysql_password,$mysql_database,$filename){
$conn=mysqli_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
if ($conn->query("CREATE DATABASE $mysql_database") === TRUE) {
	mysqli_select_db($conn,$mysql_database);
	$templine = '';
	$lines = file($filename);
	foreach ($lines as $line){
	if (substr($line, 0, 2) == '--' || $line == '')
	    continue;
	$templine .= $line;
	if (substr(trim($line), -1, 1) == ';'){
	    if(!$conn->query($templine)) mysqli_error($conn);
	    $templine = '';
	}
	}
	 return true;
}
}

if($_GET['action']=='check_db'){
	$database='wappcloud';
		$fh = fopen('config.php','r');
		while ($line = fgets($fh)) {
			$s1=strpos($line,"'",0);
			$s2=strpos($line,"'",($s1+1));
			$s3=strpos($line,"'",($s2+1));
			$s4=strpos($line,"'",($s3+1));
			$s5=strpos($line,"'",($s4+1));
			$s6=strpos($line,"'",($s5+1));
		  	$server=substr($line,($s1+1),($s2-$s1-1));
		  	$username=substr($line,($s3+1),($s4-$s3-1));
		  	$password=substr($line,($s5+1),($s6-$s5-1));
		}
		fclose($fh);
		$conn2=new mysqli($server, $username, $password);
		if ($conn2->connect_error) {
    		print 'credentialfail';
		}else{
			if(mysqli_select_db($conn2,$database)){
				print 'dbpass';
				//header('Location: index.php?action=initial_setup');
			}else{
				mysqli_close($conn2);
				if(($username!='root')&&($password=='')) print 'credentialfail';
				else
					if(setupDB($server,$username,$password,$database,'initialDB.sql'))
						print 'dbpass';
						//header('Location: index.php?action=initial_setup');
			}
		}
}

if($_GET['action']=='initial_setup'){
	if((isset($_REQUEST['se_company']))&&(isset($_REQUEST['key']))){
		$se_company=$_REQUEST['se_company'];
		$key=$_REQUEST['key'];
		include('config.php');
		$query1="UPDATE `setting` SET `value`='$se_company' WHERE `setting`='company_name'";
		$result1 = $conn->query($query1);
		$query2="UPDATE `setting` SET `value`='$key' WHERE `setting`='key'";
		$result2 = $conn->query($query2);
		
		if($result1&&$result2){
			unlink('index.php');
			rename("index.php(backup)","index.php");
			header('Location: index.php');
		}
	}
}

if($_GET['action']=='db_credentials'){
	if((isset($_REQUEST['dbserver']))&&(isset($_REQUEST['dbuser']))){
		$dbserver=$_REQUEST['dbserver'];
		$dbuser=$_REQUEST['dbuser'];
		$dbpass=$_REQUEST['dbpass'];
		$myfile = fopen('config.php', "w") or die("Unable to open file!");
		$txt = '<?php	$conn=mysqli_connect'."('".$dbserver."','".$dbuser."','".$dbpass."','wappcloud'); ?>";
		fwrite($myfile, $txt);
		fclose($myfile);
		header('Location: index.php');
	}
}
?>
