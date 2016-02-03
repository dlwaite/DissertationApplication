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
// $POST defaults to false
$venues = $foursquare->GetPublic($endpoint ,$params, $POST=false);

$queryresult = mysql_query($venues) or die (mysql_error());

while ($row = mysql_fetch_assoc($queryresult)) {
	$one = $row['id'];
	$two = $row['name'];
	$three = $row['contact'];
	$four = $row['location'];
	$five = $row['address'];
	$six = $row['lat'];
	$seven = $row['lng'];
	$eight = $row['postalCode'];
	$nine = $row['cc'];
	$ten = $row['city'];
	$eleven = $row['country'];
	$twelve = $row['formattedAddress'];
	
	echo "<div class=\"Venues\">";
	echo "<span class=\"id\">$one. </span>";
	echo "<span class=\"name\">$two. </span>";
	echo "<span class=\"contact\">$three. </span>";
	echo "<span class=\"location\">$four. </span>";
	echo "<span class=\"address\">$five. </span>";
	echo "<span class=\"lat\">$six. </span>";
	echo "<span class=\"lng\">$seven. </span>";
	echo "<span class=\"postalCode\">$eight. </span>";
	echo "<span class=\"cc\">$nine. </span>";
	echo "<span class=\"city\">$ten. </span>";
	echo "<span class=\"country\">$eleven. </span>";
	echo "<span class=\"formattedAddress\">$twelve. </span>";
 	echo "</div>";
	
}

mysql_free_result($queryresult);

?>
<br>
<br>
<b><a href='homepage.php'>Back to Search Criteria</a></b>

</body>
</html>
