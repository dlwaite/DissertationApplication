<?php
	function connect()
    {
    	define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
		define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
		define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
		define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
		define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));
		
		$dbhost = constant("DB_HOST"); // Host name 
		$dbport = constant("DB_PORT"); // Host port
		$dbusername = constant("DB_USER"); // Mysql username 
		$dbpassword = constant("DB_PASS"); // Mysql password 
		$db_name = constant("DB_NAME"); // Database name 
		
		//connect via the mysqli connection with the details gathered above else show error
		$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, "", $dbport) or die("Error: " . mysqli_error($conn));
		mysqli_select_db($conn, $db_name) or die("Error: " . mysqli_error($conn));
		
		
		//Root User: adminQTSXp5f
		//  Root Password: agISJEaCtxUB
		//  Database Name: phpmyapp
		
		//Connection URL: mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/
		
		//Please make note of these MySQL credentials again:
		//  Root User: adminQTSXp5f
		//  Root Password: agISJEaCtxUB
		//URL: https://phpmyapp-dlwaite.rhcloud.com/phpmyadmin/
    }
?>