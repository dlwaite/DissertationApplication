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
   <optgroup label="Entertainment">
   <option value="4fceea171983d5d06c3e9823">Aquarium</option>
   <option value="4bf58dd8d48988d1e1931735">Arcade</option>
   <option value="4bf58dd8d48988d1e2931735">Art Gallery</option>
   <option value="4bf58dd8d48988d1e4931735">Bowling Alley</option>
   <option value="4bf58dd8d48988d17c941735">Casino</option>
   <option value="4bf58dd8d48988d18e941735">Comedy Club</option>   
   <option value="5032792091d4c4b30a586d5c">Concert Hall</option>
   <option value="52e81612bcbc57f1066b79ea">Go Kart Track</option>
   <option value="52e81612bcbc57f1066b79eb">Mini Golf</option>
   <option value="4bf58dd8d48988d17f941735">Movie Theater</option>
   <option value="4bf58dd8d48988d181941735">Museum</option>
   <option value="4bf58dd8d48988d1e5931735">Music Venue</option>
   <option value="4bf58dd8d48988d1e3931735">Pool Hall</option>
   <option value="56aa371be4b08b9a8d573514">Racecourse</option>
   <option value="4bf58dd8d48988d184941735">Stadium</option>  
   <option value="4bf58dd8d48988d182941735">Theme Park</option>
   <option value="4bf58dd8d48988d193941735">Water Park</option>
   <option value="4bf58dd8d48988d17b941735">Zoo</option>
   </optgroup>
   <optgroup label="Bars">
   <option value="56aa371ce4b08b9a8d57356c">Beer Bar</option>
   <option value="4bf58dd8d48988d117941735">Beer Garden</option>
   <option value="52e81612bcbc57f1066b7a0e">Champagne</option>
   <option value="4bf58dd8d48988d11e941735">Cocktail</option>
   <option value="4bf58dd8d48988d1d8941735">Gay Bar</option>
   <option value="4bf58dd8d48988d120941735">Karaoke</option>   
   <option value="4bf58dd8d48988d11b941735">Pub</option>
   <option value="4bf58dd8d48988d11d941735">Sorts Bar</option>   
   <option value="4bf58dd8d48988d122941735">Whisky Bar</option>
   <option value="4bf58dd8d48988d123941735">Wine Bar</option>
   </optgroup>
   <optgroup label="Food Restaurants">
   <option value="4bf58dd8d48988d14e941735">American</option>
   <option value="4bf58dd8d48988d16b941735">Brazillian</option>
   <option value="52e81612bcbc57f1066b79f4">Buffets</option>
   <option value="4bf58dd8d48988d144941735">Carribean</option>
   <option value="4bf58dd8d48988d145941735">Chinese</option>
   <option value="4bf58dd8d48988d1d0941735">Desert Shop</option>
   <option value="4bf58dd8d48988d109941735">Eastern European</option>   
   <option value="52e81612bcbc57f1066b7a05">English</option>
   <option value="4bf58dd8d48988d10c941735">French</option>
   <option value="4bf58dd8d48988d10d941735">German</option>
   <option value="4bf58dd8d48988d10e941735">Greek</option>
   <option value="4bf58dd8d48988d10f941735">Indian</option>   
   <option value="4deefc054765f83613cdba6f">Indonesian</option>
   <option value="4bf58dd8d48988d110941735">Italian</option>
   <option value="4bf58dd8d48988d111941735">Japanese</option>
   <option value="4bf58dd8d48988d113941735">Korean</option>  
   <option value="4bf58dd8d48988d1c1941735">Mexican</option> 
   <option value="4bf58dd8d48988d1d1941735">Noodles</option>
   <option value="4bf58dd8d48988d150941735">Spanish</option>
   <option value="4bf58dd8d48988d149941735">Thai</option>
   <option value="4f04af1f2fb6e1c99f3db0bb">Turkish</option>
   <option value="4bf58dd8d48988d14a941735">Vietnamese</option>
   </optgroup>
   <optgroup label="Extras">
   <option value="4bf58dd8d48988d1e0931735">Coffee Shop</option>
   <option value="4bf58dd8d48988d11f941735">Nightclub</option>
   <option value="4bf58dd8d48988d1d6941735">Strip Club</option>
   <option value="4d4b7105d754a06377d81259">Outdoors Activities</option>
   <option value="4bf58dd8d48988d175941735">Gym</option>
   <option value="4d4b7105d754a06378d81259">Shops</option>
   <option value="4d4b7105d754a06379d81259">Travel</option>
   </optgroup>
</select>
&nbsp;&nbsp;
<label for="date">Select Date</label>
<input type="date" name="date" id="date" maxlength="60" size="15" />
&nbsp;&nbsp;
<input type="submit" name="submit" class="action" value="Search Places" />
</div>
</div>


<div id="contents">
<br>
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

</body>
</html>