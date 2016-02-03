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

//$count = 0;
//foreach($_POST as $value)
//{
//	if(!empty($value))
//	{
//		?>
      <tr>
        	<td>
            ID: <input type="text" value="<?php echo $_POST["id"] ?>">
            Name: <input type="text" value="<?php echo $_POST["name"] ?>">
        	</td>
        
        </tr>
//      <?php
//		$count++;
//	}
	
//	if($count == $populatedrows)
//	break;
//}
            

//print_r($venues)

echo $_POST;

?>

<br>
<br>
<b><a href='homepage.php'>Back to Search Criteria</a></b>

</body>
</html>
