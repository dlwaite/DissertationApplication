<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
</head>

<body>
<form id="SearchResults" action="searchResults.php" method="get">

<div align="center"><h1>Search Results</h1></div>

<?php
include('./inc/connection.inc.php');	  // make database connection
include 'functions.php';	  // make database connection

$searchPlace = $_GET['searchPlace'];
$activity = $_GET['category'];
$date = $_GET['date'];

//show login status in top right of page ?>
<div align="right"><?php echo loginStatus()?></div>

<div id="shoppingcart">
<div align="right"><?php echo itineraryStatus()?></div>
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

<div id="searchResults">
<br>
<h2>Search Results...</h2>
<?php

If (strlen($searchPlace)>0) {
	
	If (strlen($activity)>0) {
	
require_once("FoursquareApi.php");

$foursquare = new FoursquareApi("OZ2IWKQWSXNOA5IUR2ZOBNL3O340CIFZ0DYBQFOG54CUAL0Q", "VRJAMLKNAWZKT5SVJ0TCR0SRQ4DDKCOGSAPE4BUKICXUGKW1");

// Searching for venues nearby Montreal, Quebec
$endpoint = "venues/search";

// Prepare parameters
$params = array("near"=>$searchPlace, "categoryId"=>$activity);

// Perform a request to a public resource
$response = $foursquare->GetPublic($endpoint,$params);

$venues = json_decode($response);

foreach($venues->response->venues as $venue) { ?>
			<div class="venue">
				<?php 
					
					if(isset($venue->categories['0']))
					{
						echo '<image class="icon" src="'.$venue->categories['0']->icon->prefix.'88.png"/>';
					}
					else
						'<image class="icon" src="https://foursquare.com/img/categories/building/default_88.png"/>';
						
					echo'<a href="https://foursquare.com/v/'.$venue->id.'" target="_blank"/><b>';
					echo $venue->name;
					echo "</b></a><br/>";
					
                    if(isset($venue->categories['0']))
                    {
						if(property_exists($venue->categories['0'],"name"))
						{
							echo ' <i> '.$venue->categories['0']->name.'</i><br/>';
						}
					}

                    echo "Location Information: ".$venue->location->lat." latitude , ".$venue->location->lng." longitude";
					
				echo "<div class=\"row\">
                <a href=\"itinerary.php?action=add&id=".$venue->id."&lat=".$venue->location->lat."&lng=".$venue->location->lng."\">Add to Itinerary</a>
				<div class=\"cell\">&nbsp;</div>
						    <div class=\"cell\">
						    </div>
						  </div>";
						  ?>
			
			</div>
			
<?php }

}
else {
echo "Please select an activity before searching for venues";
}
}
else {
echo "Please enter a location before searching for venues";
}

?>
</div>
<br>
<br>
<b><a href='index.php'>Back to Search Criteria</a></b>

</body>
</html>
