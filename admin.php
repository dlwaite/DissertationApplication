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
		
		include('./inc/connection.inc.php');										// include database connection
		include 'functions.php';											// include functions
		
        if (isset($_SESSION['logged-in']) && ($_SESSION['logged-in'])) {		// if someone is logged in and the logged in session is active
			$username = $_SESSION['username'];									// create the username variable with the username which is logged in
			?>	
			<div align="right">
            	<!-- echo out the username of who is logged in with a log out button next to it -->
				<?php echo "<p>Hello user: $username"; echo "<input type=\"submit\" value=\"Log Out\" formaction=\"logout.php\"/></p>"; ?>
			</div>
			<?php
			echo "<a href=\"index.php\">Homepage</a>";							// 	include links to home page and edit events page
			echo "<br>";
			echo "<br>";
			echo "<a href=\"chooseEditEvent.php\">Edit Events</a>";
		}
        else {
            echo "<p>You must be logged in to access this page</p>\n";						// if noone is logged in then show error message
			echo "<input type=\"submit\" value=\"Log In\" formaction=\"login.php\" />";		// with a link to the log in page 
        }
        ?>
    </form>

    
</body>
</html>