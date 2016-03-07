<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Log In</title>
    <link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<form id="logIn" action="loginProcess.php" method="post">									
		<h1>Log In</h1>
            <p class="field"> <label for="username">Username: </label >
                <input type="text" name="username" id="username" maxlength="254" />
            </p>
          
            <p class="field">
                <label for="password">Password</label>: 
                <input type="password" name="password" id="password" maxlength="16" /></p>
            <div><p class="action"><input type="submit" name="submit" value="Log In" /></p></div>
            <p><a href="index.php">Back to Homepage</a></p>
            
            <?php
			include 'database_conn.php';	  // make db connection
				$sql = "SELECT * FROM tbl_users";
	
	// store the result 
	$queryresult = mysql_query($sql) or die (mysql_error());
	// create a table
	echo "<table border='1'>";
	// with headings
	echo "<tr><th>userID</th><th>Email</th><th>password</th></tr>";
	while($row = mysql_fetch_array($queryresult)){			// whilst there is another record that matched the query result
		echo "<tr><td>";									// echo out the record under
		echo $row['userID'];							// the heading with the 
		echo "</td><td>";									// data that is stored
		echo $row['emailAddress'];						// within the database
		echo "</td><td>";
		echo $row['password'];
		echo "</td></tr>";
	}
	echo "</table>";									// close the table
	?>
            
            
	</form>

</body>
</html>