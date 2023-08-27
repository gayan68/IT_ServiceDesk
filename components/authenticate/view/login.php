<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title><?php print $se_appname; ?></title>

<link href="css/960.css" rel="stylesheet" type="text/css" media="all">
<link href="css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="css/text.css" rel="stylesheet" type="text/css" media="all">
<link href="css/login.css" rel="stylesheet" type="text/css" media="all">

</head>


<body>

<div class="container_16">
  <div class="grid_6 prefix_5 suffix_5">
  
   	  <h1 style="position:relative; top:-40px;"><img height="84px" src="images/logo.jpg" /><br /><br /><?php print $se_appname; ?></h1>
    	<div id="login">
<?php  	if(!isset($_REQUEST['message'])){
    	  print '<p class="tip">Please Enter your Username and Password!</p>';
    	  }else{
    	  print '<p class="error">'.$_REQUEST['message'].'</p>';
    	  }
?>              
    	  <form method="post" action="index.php?components=authenticate&action=login"  onsubmit="return validateLogin()">
    	 	<p><label><strong>Username</strong><input name="uname" class="inputText" id="uname" type="text" /></label></p>
    	    <p><label><strong>Password</strong><input name="passwd" class="inputText" id="passwd" type="password" /></label></p>
      	    <input class="black_button" value="Authentification" style="width: 111px;" type="submit" />
            <label><input name="remember" id="remember" type="checkbox" />Remember me</label>            
    	  </form>
		  <br clear="all">
    	</div>
        <div id="forgot">
        <a href="#" class="forgotlink"><span>Forgot your username or password?</span></a></div>
  </div>
</div>
<br clear="all">

</body></html>