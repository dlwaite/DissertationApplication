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
include 'functions.php';	  // make database connection

$searchPlace = $_GET['searchPlace'];
$activity = $_GET['category'];
$date = $_GET['date'];

require_once("FoursquareApi.php");

// Searching for venues nearby Montreal, Quebec
$endpoint = "venues/search";

// Prepare parameters
$params = array("near"=>$searchPlace, "categoryId"=>$activity);

// Perform a request to a public resource
//$response = $foursquare->GetPublic($endpoint,$params);

// Returns a list of Venues
$venues = $foursquare->GetPublic($endpoint ,$params, $POST=true);

echo $venues;

$presponse = json_decode($venues);

var_dump($presponse);

//extract($_POST);
//var_dump(get_defined_vars());

//echo $_POST;

//$numrows = count($_POST);

//echo "<table>";
//	echo "<tr><td>ID</td><td>Name</td></tr>";
//	for($i = 0; $i < $numrows; $i++)
//	{
//		echo "<tr>";
//		echo "<td>" . $data[$i]['id'] . "</td>";
//    	echo "<td>" . $data[$i]['name'] . "</td>";
//		echo "</tr>";
//	}
//	echo "</table>";

//require_once("https://www.github.com/Ents24/ents24-api-client.git");

//$foursquare = new FoursquareApi("OZ2IWKQWSXNOA5IUR2ZOBNL3O340CIFZ0DYBQFOG54CUAL0Q", "VRJAMLKNAWZKT5SVJ0TCR0SRQ4DDKCOGSAPE4BUKICXUGKW1");

//$client = Ents24\Api\Client::factory(
//    [
//        'client_id'     => 'e5cb720f71f55be8e448f3a5956ac8b9d0249c9d',
//        'client_secret' => '06a69663a2f99b1080ffeea4c942e7a82fd0c10c;',
//    ]
//);

?>

<br>
<br>
<b><a href='index.php'>Back to Search Criteria</a></b>

</body>
</html>
