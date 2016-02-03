<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Search Results</title>
</head>

<body>

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

//$sql = "SELECT name, id FROM" & $venues & "";

//$queryresult = mysql_query($sql) or die (mysql_error());

//while ($row = mysql_fetch_assoc($venues)) {
//	$id = $row['id'];
//	$name = $row['name'];
	
//	echo "<div class=\"Venues\">";
//	echo "<span class=\"id\">$id. </span>";
//	echo "<span class=\"name\">$name. </span>";
// 	echo "</div>";
//	
//}

//mysql_free_result($venues);

//print_r($venues)

?>
<br>
<br>
<b><a href='homepage.php'>Back to Search Criteria</a></b>

</body>
</html>
