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

?>