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

print_r($venues);

//$queryresult = mysql_query($venues) or die (mysql_error());

//while ($row = mysql_fetch_assoc($queryresult)) {
//	$movieID = $row['movieID'];
//	$title = $row['title'];
//	$certificate = $row['certificate'];
//	$category = $row['category'];
//	$year = $row['year'];
	
//	echo "<div class=\"movie\">";
//	echo "<span class=\"movieID\">$movieID. </span>";
//	echo "<span class=\"title\">$title. </span>";
//	echo "<span class=\"certificate\">$certificate. </span>";
//	echo "<span class=\"category\">$category. </span>";
//	echo "<span class=\"year\">$year. </span>";
// 	echo "</div>";
	
//}

//mysql_free_result($queryresult);

?>
<br>
<br>
<b><a href='homepage.php'>Back to Search Criteria</a></b>

</body>
</html>
