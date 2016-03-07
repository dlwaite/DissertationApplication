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
            
	</form>

</body>
</html>