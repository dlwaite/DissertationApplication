<?php //connect to the database
$conn = mysql_connect ('newnumyspace.co.uk', 'unn_w13027707', 'iaS9yZPb')
	or die("Could Not Connect to MySQL!");
mysql_select_db("unn_w13027707")
	or die("Could Not Open Database:".mysql_error());
?>