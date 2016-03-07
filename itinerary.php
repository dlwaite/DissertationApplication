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

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Itinerary Page</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
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


</body>
</html>