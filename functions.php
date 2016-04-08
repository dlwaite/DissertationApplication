<?php
function loginStatus () {
	// if the user was logged in and there was a logged in session in the session
	if (isset($_SESSION['logged-in']) && ($_SESSION['logged-in'])) {
		// create a variable to store the username of the user who is logged in
		$username = $_SESSION['username'];
		?>
		<div align="right">
        <!-- after aligning it to the right, say hello user and then include the username 
        of the user logged in, and next to it have a log out button -->
        <?php 
		echo "<p>Hello: $username"; echo "<input type=\"submit\" value=\"Log Out\" action=\"logout.php\"/></p>"; 
		?></div>
		
		<?php
	}
	// else if there is no user logged in 
	else {
		?>
		<div align="right"> 
        <!-- after aligning it to the right, include a log in button for the user to be able to log in -->
		<?php 
		echo "<p>Log In: "; echo "<input type=\"submit\" value=\"Log In\" formaction=\"login.php\"/></p>"; 
		?>
		</div> <?php
	}
}

function logIn () {
	// check to see that a password and username was entered in the 
	// log in page and they were not left empty and request the values
	$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
	$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

	include('./inc/connection.inc.php');
	connect();

    // if the username field was left empty then echo out an error 
	if (empty($username)) {													
		 echo "<p>You must enter an E-Mail Address.</p> ";							
		 // inlcude a button that allows the user to return to the previous page
		 echo "<a href = \"login.php?username=$username\">Please enter a username.</a>";	
		 die (mysql_error());  
	}
	
	// else if the password field was left empty then echo out an error
	else if (empty($password)) {											
		 echo "<p>You must enter a Password.</p> ";							
		 // inlcude a button that allows the user to return to the previous page
		 echo "<a href = \"login.php?username=$username\">Please enter a password.</a>";	
		 die (mysql_error());  
	}
	// else if the fields are not left empty
	else {																	
		//select password and salt from the users table where the username matches the username entered
		$sql = "SELECT password, salt FROM tbl_users WHERE username = ?";		
	
		//prepare the sqli statement with the connection and sql statement
		$stmt = mysqli_prepare($conn, $sql); 
		
		//bing the parameters together and then execute the statement
		mysqli_stmt_bind_param($stmt, 's', $username);
		mysqli_stmt_execute($stmt); 
		
		//bind the results together 
		mysqli_stmt_bind_result($stmt, $passwordfromDB, $saltfromDB);
		
		// if there was a result
		if (mysqli_stmt_fetch($stmt)) {									
	
			//create a password hash variable with the hashed value of the
			//password entered
			$passwordhash = hash('sha256', $password);

			//make the salt variable = the salt gathered from the DB
			$salt = $saltFromDB;

			//make a final hash by hashing the passwordhash created before whilst
			//also binding that with the salt value 
			$finalHash = hash('sha256', $salt.$passwordhash);
	
			// if the passwords match
			if ($finalhash == $passwordfromDB) {								
				// store the value of the user logged in in the session
				$_SESSION['username'] = $username;	
				// make the session logged in as true					
				$_SESSION['logged-in'] = true;								
				// tell the user they have logged in and include a link to the admin page
				echo "<p>You have successfully signed in.</p>";				
				echo "<a href = \"admin.php?username=$username\">Continue to Admin Page</a>";
			}	
			// else if the hashed passwords do not match
			else {				
				// create an error message with a link to log in page
				echo "<p>Sorry the password doesn't match.</p>";			
				echo "<a href = \"login.php\">Please try again.</a>";		
				die (mysql_error());
			}
		}
		// else if there was not a result from the search
		else { 											
			// create an error message with a link back to the login page		
			echo "<p>Sorry that username is not in our system.</p> ";		
			echo "<a href = \"login.php\">Please try again.</a>";			
			die (mysql_error());
		}
	}
}

function itineraryStatus() {
	//set the cart variable with the details of the cart that is held in the session
	$cart = $_SESSION['cart'];
	//if cart is empty 
	if (!$cart) {
		//show a link to the itinerary page under the works "Your Itinerary:" and add a 0
		return '<p><a href="./itinerary.php">Your Itinerary:</a> 0</p>';
	} else {
		//if the cart does existis not empty then create a variable and put all the venues in the
	    //cart into the variable.. before doing this remove all of the commas from the cart
		$items = explode(',',$cart);
		//count the number of venues in the items variable. If it is greater than 1 then add an s
		//if the number of venues in the items variable is not greater than then leave as a count
		$s = (count($items) > 1) ? 's':'';
		//show a link to the itinerary page under the works "Your Itinerary:" and add the count from above
		return '<p><a href="./itinerary.php">Your Itinerary:</a>' .count($items). ' venue' .$s.'</p>';
	}
}

function itineraryContents() {
	//set the cart variable with the details of the cart that is held in the session
	$cart = $_SESSION['cart'];
	//if cart is not empty
	if ($cart) {
		//create a variable and put all the venues in the cart into the variable
	    //before doing this remove all of the commas from the cart
		$items = explode(',',$cart);
	
		// create a table
		echo "<table border='1'>";
		// with headings
		echo "<tr><th>Name</th><th>Category</th><th>Postal Code</th><th>Latitude</th><th>Longitude</th><th>Remove</th></tr>";
		
		//foreach item in the items variable
		foreach ($items as $id) {
			
			//use the foursquareapi.php file
			require_once("FoursquareApi.php");

			//set the new FoursquareAPI search with the client key and secret
			$foursquare = new FoursquareApi("OZ2IWKQWSXNOA5IUR2ZOBNL3O340CIFZ0DYBQFOG54CUAL0Q", "VRJAMLKNAWZKT5SVJ0TCR0SRQ4DDKCOGSAPE4BUKICXUGKW1");
			
			//Create the endpoint which will be the id of the venues
			$endpoint = "venues/$id";
			
			// Prepare parameters
			$params = array();
			
			// Perform a request to a public resource
			$response = $foursquare->GetPublic($endpoint,$params);
			
			//decode the response
			$venues = json_decode($response);
			
			//put the name of the venue in the first data row
			echo "<tr><td>";
			echo $venues->response->venue->name.'<br>';
			echo "</td><td>";
			
			//if the category is not blank
			if(isset($venues->response->venue->categories['0']))
                {
					//and if the cateogory name exists
					if(property_exists($venues->response->venue->categories['0'],"name"))
					{ 
					//put the category name in the next column in the row
					echo $venues->response->venue->categories['0']->name.'<br>';
					echo "</td><td>";
					}
				}
			//add the latitude in the next column and the longitude in the one after
			echo "".$venues->response->venue->location->postalCode."";
			echo "</td><td>";
			echo "".$venues->response->venue->location->lat."";
			echo "</td><td>";
			echo "".$venues->response->venue->location->lng."";
			echo "</td><td>";
			//in the last column before ending the row add the "Remove" text. This text will be a link
			//to reload the itinerary page but running the "delete" case in the action switch function. 
			//As the page loads pass through the id of the venue the user wishes to remove
			echo "<a href=\"itinerary.php?action=delete&id=".$venues->response->venue->id."\">Remove</a>";
		    echo "</td></tr>";	  
		}	
		//show the table
		echo "</table>";
		//create a link called "Clear Itinerary" which when clicked reloads the itinerary page but runs the
		//removeAll case in the action switch function
		echo "<a href=\"itinerary.php?action=removeAll\">Clear Itinerary</a>";
	} else {
		//else if the cart is empty leave a message to say
		echo '<p>Your itinerary is empty.</p>';
	}
}

?>