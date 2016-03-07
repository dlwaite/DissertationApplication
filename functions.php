<?php

function loginStatus () {
	// if the user was logged in and there was a logged in session in the session
	if (isset($_SESSION['logged-in']) && ($_SESSION['logged-in'])) {
		// create a variable to store the username of the user who is logged in
		$username = $_SESSION['username'];
		?>
		<div align="right"> <?php 		// after aligning it to the right, say hello user and then include the username of the user logged in, and next to it have a log out button
			echo "<p>Hello user: $username"; echo "<input type=\"submit\" value=\"Log Out\" action=\"logout.php\"/></p>"; ?>
		</div>
		
		<?php
	}
	// else if there is no user logged in 
	else {
		?>
		<div align="right"> <?php		// after aligning it to the right, include a log in button for the user to be able to log in
			echo "<p>Log In: "; echo "<input type=\"submit\" value=\"Log In\" formaction=\"login.php\"/></p>"; ?>
		</div> <?php
	}
}

function logIn () {
	// check to see that a password and username was entered in the log in page and they were not left empty and request the values
	$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
	$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : null;

	include 'database_conn.php';	  // make db connection

	if (empty($username)) {													// if the username field was left empty then echo out an error and 
		 echo "<p>You must enter an E-Mail Address.</p> ";							// inlcude a button that allows the user to return to the previous page
		 echo "<a href = \"login.php?username=$username\">Please enter a username.</a>";	
		 die (mysql_error());  
	}
	
	else if (empty($password)) {											// else if the password field was left empty then echo out an error and 
		 echo "<p>You must enter a Password.</p> ";							// inlcude a button that allows the user to return to the previous page
		 echo "<a href = \"login.php?username=$username\">Please enter a password.</a>";	
		 die (mysql_error());  
	}
	else {																	// else if the fields are not left empty
		$sql = "SELECT password FROM tbl_users WHERE emailAddress = " & $username & "";		// select the password and salt from the users table where the username matches the username entered

		$stmt = mysqli_prepare($conn, $sql); 
		
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt); 
		
		mysqli_stmt_bind_result($stmt, $passwordfromDB);

		if (mysqli_stmt_fetch($stmt)) {										// if there was a result
	
			if ($password == $passwordfromDB) {								// if the passwords match
				$_SESSION['username'] = $username;							// store the value of the user logged in in the session
				$_SESSION['logged-in'] = true;								// make the session logged in as true
				echo "<p>You have successfully signed in.</p>";				// tell the user they have logged in and include a link to the admin page
				echo "<a href = \"admin.php?username=$username\">Continue to Admin Page</a>";
			}	
			else {															// else if the hashed passwords do not match
				echo "<p>Sorry the password doesn't match.</p>";			// create an error message
				echo "<a href = \"login.php\">Please try again.</a>";		// with a link back to the login page
				die (mysql_error());
			}
		}
		else { 																// else if there was not a result from the search
			echo "<p>Sorry that username is not in our system.</p> ";		// create an error message
			echo "<a href = \"login.php\">Please try again.</a>";			// with a link back to the login page
			die (mysql_error());
		}
	}
}

?>