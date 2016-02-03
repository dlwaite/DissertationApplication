<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
</head>

<body>
<form id="Search Results" method="post">
<?php
$searchPlace = $_GET['searchPlace'];

require_once("FoursquareApi.php");

$foursquare = new FoursquareApi("OZ2IWKQWSXNOA5IUR2ZOBNL3O340CIFZ0DYBQFOG54CUAL0Q", "VRJAMLKNAWZKT5SVJ0TCR0SRQ4DDKCOGSAPE4BUKICXUGKW1");

// Searching for venues nearby Montreal, Quebec
$endpoint = "venues/search";

// Prepare parameters
$params = array("near"=>$searchPlace);

// Perform a request to a public resource
$response = $foursquare->GetPublic($endpoint,$params);

// Returns a list of Venues
$venues = $foursquare->GetPublic($endpoint ,$params, $POST=true);

echo $_POST

//$data = json_decode($_POST, false);
//$numrows = count($data);

//print_r($data);

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

?>

<br>
<br>
<b><a href='homepage.php'>Back to Search Criteria</a></b>

</body>
</html>
