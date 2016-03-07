<?php
// Includes
include('database_conn.php');
include('functions.php');


// Start the session
session_start();

//Process Action
$cart = $_SESSION['cart'];
$action = $_GET['action'];

switch ($action) {
	case 'add':
	if ($cart) {
		$cart .= ','.$_GET['id'];
	} else {
		$cart = $_GET['id'];
	}
	break;
		case 'delete':
	if ($cart) {
		$items = explode(',',$cart);
		$newcart = '';
		
		foreach ($items as $item) {
			if ($_GET['id'] !=$item) {
				if ($newcart != '') {
					$newcart .= ','.$item;
				} else {
					$newcart = $item;
				}
			}
		}
		$cart = $newcart;
	}
	break;
}
$_SESSION['cart'] = $cart;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
<style type="text/css">
body {
	background-color: #FFFFFF;
	text-align: left;
	height: auto;
	width: 960px;
}
</style>
<title>Itinerary Page</title>
</head>
<body>
<form id="Itineray" action="" method="post">

<div id="shoppingcart">

<h1>Your Itinerary</h1>

<?php
echo cartStatus();
?>

</div>

<div id="contents">

<h1>Please check your Itinerary...</h1>

<?php
echo cartContents();
?>

<p>|| <a href="./homepage.php">Add Further Venues</a> || <a href="./proceed.php">Save to Account Itinerary</a> ||

</div>
<div id="bottombanner"> <p align="center" class ="normal"><img src="images/ScreenHunter_01 May. 22 18.07.jpg" alt="header" width="659" height="58" align="absmiddle" /></a></div>
</body>
</html>