<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
</head>

<body>
<form id="SearchResults" action="searchResults.php" method="get">

<h1>Search Results</h1>

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
<br>
<br>
<b><a href='index.php'>Back to Search Criteria</a></b>

</body>
</html>
