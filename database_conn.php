<?php //connect to the database
define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
define('DB_PORT', getenv('OPENSHIFT_MYSQL_DB_PORT'));
//define('DB_USER', getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
//define('DB_PASS', getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
//define('DB_NAME', getenv('OPENSHIFT_GEAR_NAME'));
define('DB_USER', 'adminQTSXp5f');
define('DB_PASS', 'agISJEaCtxUB');
define('DB_NAME', 'phpmyapp');

$dbhost = constant("DB_HOST"); // Host name 
$dbport = constant("DB_PORT"); // Host port
$dbusername = constant("DB_USER"); // Mysql username 
$dbpassword = constant("DB_PASS"); // Mysql password 
$db_name = constant("DB_NAME"); // Database name 

$mysqlCon = mysqli_connect($dbhost, $dbusername, $dbpassword, "", $dbport) or die("Error: " . mysqli_error($mysqlCon));
mysqli_select_db($mysqlCon, $db_name) or die("Error: " . mysqli_error($mysqlCon));


//Root User: adminQTSXp5f
//  Root Password: agISJEaCtxUB
//  Database Name: phpmyapp

//Connection URL: mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/

//Please make note of these MySQL credentials again:
//  Root User: adminQTSXp5f
//  Root Password: agISJEaCtxUB
//URL: https://phpmyapp-dlwaite.rhcloud.com/phpmyadmin/

//$conn = mysql_connect ('mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/', 'adminQTSXp5f', 'agISJEaCtxUB')
//	or die("Could Not Connect to MySQL!");
//	mysql_select_db("phpmyapp")
//	or die("Could Not Open Database:".mysql_error());


?>