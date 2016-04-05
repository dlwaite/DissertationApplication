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
   <option value="56aa371be4b08b9a8d5734db">Amphitheater</option>
   <option value="4fceea171983d5d06c3e9823">Aquarium</option>
   <option value="4bf58dd8d48988d1e1931735">Arcade</option>
   <option value="4bf58dd8d48988d1e2931735">Art Gallery</option>
   </optgroup>
   <option value="4bf58dd8d48988d116941735">Bar</option>
   <option value="4bf58dd8d48988d1e4931735">Bowling Alley</option>
   <option value="4bf58dd8d48988d17c941735">Casino</option>
   <option value="4bf58dd8d48988d18e941735">Comedy Club</option>   
   <option value="5032792091d4c4b30a586d5c">Concert Hall</option>
   <option value="4d4b7105d754a06374d81259">Food Venue</option>
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
