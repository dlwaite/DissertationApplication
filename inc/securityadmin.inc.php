<?php
function authorise()
{
	// Start Sessions
	ini_set('session.cookie_httponly', true);

session_start();

if (isset($_SESSION['last_ip']) === false){
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}

if ($_SESSION['last_ip'] !== $_SERVER['REMOTE_ADDR']){
	session_unset();
	session_destroy();
}
	
	// Check if a session exists with a username variable
	// WARNING: This is not the most secure method of authentication
	if (!isset($_SESSION['username'])) {
		//$_SESSION['name'] .= "<a href=./login.php>Please Log In</a>";
		
		header("Location: ./index.php");
		exit();
	}
}

function session_reset()
{
	session_destroy();
	session_start();
}
?>