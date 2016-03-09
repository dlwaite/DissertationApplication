<?php //start the session
ini_set("session.save_path", "/var/www/vhosts/newnumyspace.co.uk/web_users/home/~unn_w13027707/sessiondata");
session_start();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Welcome to Plan your Night Out</title>
  <link href="stylesheet.css" rel="stylesheet" type="text/css" media="all" id="styleSheet" />

</head>
<body>
<form id="Homepage" action="searchResults.php" method="get">

<h1>Plan your Night Out</h1>

<?php
include('./inc/connection.inc.php');	  // make database connection
include 'functions.php';	  // make database connection

//show login status in top right of page ?>
<div align="right"><?php echo loginStatus()?></div> 

    
<p class="field"><label for="searchPlace">Please Enter the Search Location:</label> 
      <input type="text" name="searchPlace" id="searchPlace" maxlength="254" />
</p>

<div>
 Select Activity:
 <select name="category">
   <option value="">Please Select</option>
   <option value="4bf58dd8d48988d1e4931735">Bowling Alley</option>
   <option value="4bf58dd8d48988d18e941735">Comedy Club</option>
  </select>
</div>

<p class="field">
            <label for="date">Select Date</label> 
            <input type="date" name="date" id="date" maxlength="60" />
        </p>


<p class="action"><input type="submit" name="submit" value="Search Places" /></p>

</body>
</html>
