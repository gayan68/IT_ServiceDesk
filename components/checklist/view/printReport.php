<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Print Report</title>

</head>

<body style="background-color:white; background-image:none;">
 
<!-- #PORTLETS START -->
<?php
print '<h1>'.$se_appname.'</h1>';
print '<h3>'.$se_company.'</h3>';
print '<hr /><br />';
	if($_GET['action']=='print_report'){
		if($_GET['type']=='cl_missing') include_once  'components/checklist/view/tpl/cl_missing.php';
		if($_GET['type']=='device_down'){
			print '<table width="300px"><tr><td>';
			include_once  'components/checklist/view/tpl/device_failures.php';
			print '</td></tr></table>';
		}
	}
?>
<!--  END #PORTLETS -->

<br />
	
</body>
</html>