<?php

//Start sessions
include('./inc/security.inc.php');
authorise();

// If user is still logged in destroy the session and send them to the homepage
session_reset();
$_SESSION['msg'] = "<div class=\"success\"><p>You have successfully logged out.</p></div>";
header("Location: ./index.php");

?>