<?php
// Includes
include('./inc/connection.inc.php');;
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
	case 'update':
	if ($cart) {
		$newcart = '';
		foreach ($_POST as $key=>$value) {
			if (stristr($key,'qty')) {
				$id = str_replace('qty','',$key);
				$items = ($newcart != '') ? explode(',',$newcart) : explode(',',$cart);
				$newcart = '';
				foreach ($items as $item) {
					if ($id != $item) {
						if ($newcart != '') {
							$newcart .= ','.$item;
						} else {
							$newcart = $item;
						}
					}
				}
				for ($i=1;$i<=$value;$i++) {
					if ($newcart != '') {
						$newcart .= ','.$id;
					} else {
						$newcart = $id;
					}
				}
			}
		}
	}
	$cart = $newcart;
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
echo itineraryStatus();
print $cart
?>

</div>

<div id="contents">

<h1>Please check your Itinerary...</h1>

<?php
echo itineraryContents();

$lat = $_GET['searchPlace'];
$long = $_GET['category'];
$id = $_GET[$venue->id];

?>

<br><br>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> 
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script> 
<script type="text/javascript"> 
    $(document).ready(function() { initialize(); });

    function initialize() {
        var map_options = {
            center: new google.maps.LatLng(33.84659,-84.35686),
            zoom: 14,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var google_map = new google.maps.Map(document.getElementById("map_canvas"), map_options);

        var info_window = new google.maps.InfoWindow({
            content: 'loading'
        });

        var t = [];
        var x = [];
        var y = [];
        var h = [];

        t.push('Location Name 1');
        x.push(33.84659);
        y.push(-84.35686);
        h.push('<p><strong>Location Name 1</strong><br/>Address 1</p>');

        t.push('Location Name 2');
        x.push(33.846253);
        y.push(-84.362125);
        h.push('<p><strong>Location Name 2</strong><br/>Address 2</p>');

        var i = 0;
        for ( item in t ) {
            var m = new google.maps.Marker({
                map:       google_map,
                animation: google.maps.Animation.DROP,
                title:     t[i],
                position:  new google.maps.LatLng(x[i],y[i]),
                html:      h[i]
            });

            google.maps.event.addListener(m, 'click', function() {
                info_window.setContent(this.html);
                info_window.open(google_map, this);
            });
            i++;
        }
    }
</script> 
<div id="map_canvas" style="width:400px;height:400px;">Google Map</div> 



<p>|| <a href="./index.php">Add Further Venues</a> ||


<?php 
echo $_SESSION['lat'];
?>

</body>
</html>