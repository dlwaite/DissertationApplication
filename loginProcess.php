<?php //start the session
ini_set("session.save_path", "/var/www/vhosts/numyspace.co.uk/web_users/home/~unn_w13027707/sessiondata");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Log In</title>
	<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<form id="logIn">
		<h1>Log In</h1>
		<?php
		// include functions
		include 'functions.php';
		
	// run the logIn fuction	
	echo logIn ();						
	?>
    <br />
    <p><a href="index.php">Back to Homepage</a></p>
	</form>

</body>
<a href="http://www.beyondsecurity.com/vulnerability-scanner-verification/phpmyapp-dlwaite.rhcloud.com"><img src="https://seal.beyondsecurity.com/verification-images/phpmyapp-dlwaite.rhcloud.com/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>
</html>