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
//include 'datasbase_conn.php';	  // make database connection
//include 'functions.php';	  // make database connection

$searchPlace = $_GET['searchPlace'];
$activity = $_GET['category'];
$date = $_GET['date'];

require_once("FoursquareApi.php");

$foursquare = new FoursquareApi("OZ2IWKQWSXNOA5IUR2ZOBNL3O340CIFZ0DYBQFOG54CUAL0Q", "VRJAMLKNAWZKT5SVJ0TCR0SRQ4DDKCOGSAPE4BUKICXUGKW1");

// Searching for venues nearby Montreal, Quebec
$endpoint = "venues/search";

// Prepare parameters
$params = array("near"=>$searchPlace, "categoryId"=>$activity);

// Perform a request to a public resource
$response = $foursquare->GetPublic($endpoint,$params);

$venues = json_decode($response);

foreach($venues->response->venues as $venue): ?>
			<div class="venue">
				<?php 
					
					if(isset($venue->categories['0']))
					{
						echo '<image class="icon" src="'.$venue->categories['0']->icon->prefix.'88.png"/>';
					}
					else
						echo '<image class="icon" src="https://foursquare.com/img/categories/building/default_88.png"/>';
					echo '<a href="https://foursquare.com/v/'.$venue->id.'" target="_blank"/><b>';
					echo $venue->name;
					echo "</b></a><br/>";
					
                    if(isset($venue->categories['0']))
                    {
						if(property_exists($venue->categories['0'],"name"))
						{
							echo ' <i> '.$venue->categories['0']->name.'</i><br/>';
						}
					}

                    echo '<b><i>Location Information</i></b> :'.$venue->location->lat." latitude , ".$venue->location->lng." longitude";
					

				?>
                <br>
                <p class="action"><input type="submit" name="submit" value="Add to Itinerary" /></p
				><br>
			
			</div>
			
		<?php endforeach;

require_once("Ents24Api.php");

$client = Ents24\Api\Client::factory(
    [
        'client_id'     => 'e5cb720f71f55be8e448f3a5956ac8b9d0249c9d',
        'client_secret' => '06a69663a2f99b1080ffeea4c942e7a82fd0c10c;',
    ]
);

?>

<br>
<br>
<b><a href='index.php'>Back to Search Criteria</a></b>

</body>
</html>
