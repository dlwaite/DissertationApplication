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
		include 'functions.php'; 			// include functions
		include 'database_conn.php';	  // make db connection
		
	echo logIn ();						// run the logIn fuction
	?>
    <br />
    <p><a href="index.php">Back to Homepage</a></p>
	</form>
	<!-- add the w3 validator to the bottom right of the page -->
	<div align="right"><p>
		<a href="http://validator.w3.org/check?uri=referer"><img
    	src="http://www.w3.org/Icons/valid-xhtml10"
    	alt="Valid XHTML 1.0!" height="31" width="88" /></a>
	</p></div>

</body>
</html>