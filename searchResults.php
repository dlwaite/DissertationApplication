<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
<link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />
</head>

<body>
<form id="SearchResults" action="" method="post">
<?php
include 'database_conn.php';	  // make database connection
include 'functions.php';	  // make database connection

$searchPlace = $_GET['searchPlace'];
$activity = $_GET['category'];
$date = $_GET['date'];

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

// create a table
echo "<table border='1'>";
// with headings
echo "<tr><th></th><th>Name</th><th>Category</th><th>Location: Latitude</th><th>Location: Longitude</th></tr>";

foreach($venues->response->venues as $venue): ?>
			<div class="venue">
				<?php 
					
					if(isset($venue->categories['0']))
					{
						echo "<tr><td>";
						echo $row['<image class="icon" src="'.$venue->categories['0']->icon->prefix.'88.png"/>'];
						echo "</td><td>";
					}
					else
						echo "<tr><td>";
						echo $row['<image class="icon" src="https://foursquare.com/img/categories/building/default_88.png"/>'];
						echo "</td><td>";
					echo "<tr><td>";
					echo $row['<a href="https://foursquare.com/v/'.$venue->id.'" target="_blank"/><b>'];
					echo "</td><td>";
					echo "<tr><td>";
					echo $venue->name;
					echo "</td><td>";
					//echo "</b></a><br/>";
					
                    if(isset($venue->categories['0']))
                    {
						if(property_exists($venue->categories['0'],"name"))
						{
							echo "<tr><td>";
							echo $row[' <i> '.$venue->categories['0']->name.'</i><br/>'];
							echo "</td><td>";
						}
					}
					
					echo "<tr><td>";
                    echo $row['.$venue->location->lat.'];
					echo "</td><td>";
					echo "<tr><td>";
					echo $row['.$venue->location->lng.'];
					echo "</td><td>";
					
				echo "<tr><td>";
				?><p class="action"><input type="submit" name="submit" value="Add to Itinerary" /></p><?php
				echo "</td></tr>";				
				?>
			</div>
<?php endforeach;
echo "</table>";


require_once("Client.php");
require_once("Session.php");

$client = Ents24\Api\Client::factory(
    [
        'client_id'     => 'e5cb720f71f55be8e448f3a5956ac8b9d0249c9d',
        'client_secret' => '06a69663a2f99b1080ffeea4c942e7a82fd0c10c;',
    ]
);

$listRequest = $client->getCommand('ListArtists');
$artistList = $listRequest->execute();
$firstArtist = current($artistList);

echo $firstArtist['name'], "\n";
echo $firstArtist['description'], "\n"; 



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
