<?php //start the session
ini_set("session.save_path", "/var/www/vhosts/numyspace.co.uk/web_users/home/~unn_w13027707/sessiondata");
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>My Account</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
    <form id="admin">
        <h1>My Account</h1>
        
		<?php
		
		include('./inc/connection.inc.php'); // include database connection
		include 'functions.php';			 // include functions
		
		// if someone is logged in and the logged in session is active
        if (isset($_SESSION['logged-in']) && ($_SESSION['logged-in'])) {
			// create the username variable with the username which is logged in		
			$username = $_SESSION['username'];									
			?>	
			<div align="right">
            	<!-- echo out the username of who is logged in with a log out button next to it -->
				<?php echo "<p>Hello user: $username"; 
				echo "<input type=\"submit\" value=\"Log Out\" formaction=\"logout.php\"/></p>"; ?>
			</div>
			<?php
			// 	include links to home page
			echo "<a href=\"index.php\">Homepage</a>";							
		}
        else {
			// if noone is logged in then show error message with a link to the log in page
            echo "<p>You must be logged in to access this page</p>\n";						
			echo "<input type=\"submit\" value=\"Log In\" formaction=\"login.php\" />";	 
        }
        ?>
    
</body>
</html>
</form>
<a href="http://www.beyondsecurity.com/vulnerability-scanner-verification/phpmyapp-dlwaite.rhcloud.com"><img src="https://seal.beyondsecurity.com/verification-images/phpmyapp-dlwaite.rhcloud.com/vulnerability-scanner-2.gif" alt="Website Security Test" border="0" /></a>