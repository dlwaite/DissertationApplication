<?php
// Includes
include('./inc/connection.inc.php');;
include('functions.php');

// Start the session
session_start();

//Process Action
$cart = $_SESSION['cart'];
$lat = $_SESSION['lat'];
$lng = $_SESSION['lng'];
$action = $_GET['action'];

switch ($action) {
	case 'add':
	if ($cart) {
		$cart .= ','.$_GET['id'];
		$lat .= ','.$_GET['lat'];
		$lng .= ','.$_GET['lng'];
	} else {
		$cart = $_GET['id'];
		$lat = $_GET['lat'];
		$lng = $_GET['lng'];
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
$_SESSION['lng'] = $lng;
$_SESSION['lat'] = $lat;

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Itinerary Page</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
</head>

<body>
<form id="Itineray" action="searchResults.php" method="get">

<div align="center"><h1>Your Itinerary</h1></div>

<?php
//show login status in top right of page ?>
<div align="right"><?php echo loginStatus()?></div>

<div id="shoppingcart">

<div align="right">
<?php
echo itineraryStatus();
?>
</div>
</div>

<div id="searchBar">
<div align="left">
<p><h2>Search for Further Venues</h2></p>
<label for="searchPlace">Please Enter the Search Location</label>
<input type="text" name="searchPlace" id="searchPlace" maxlength="254" size="30" />
&nbsp;&nbsp;
<label for="category">Select Activity</label> 
<select name="category" >
   <option value="">Please Select</option>
   <option value="4bf58dd8d48988d1e4931735">Bowling Alley</option>
   <option value="4bf58dd8d48988d18e941735">Comedy Club</option>
</select>
&nbsp;&nbsp;
<label for="date">Select Date</label>
<input type="date" name="date" id="date" maxlength="60" size="15" />
&nbsp;&nbsp;
<input type="submit" name="submit" class="action" value="Search Places" />
</div>
</div>


<div id="contents">

<h2>Please check your Itinerary...</h2>

<?php
echo itineraryContents();

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

</body>
</html>