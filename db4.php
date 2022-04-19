<!-- db4.php
     A PHP script to access the database
     through MySQL
     -->
     <html>
<head>
<title> Access the cars database with MySQL </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<?php

// Connect to MySQL

$servername = "cs100.seattleu.edu";
$username = "user42";
$password = "1234abcdF!";

$conn = mysql_connect($servername, $username, $password);

if (!$conn) {
     print "Error - Could not connect to MySQL ".$servername;
     exit;
}

$dbname = "bw_db42";

$db = mysql_select_db($dbname, $conn);
if (!$db) {
    print "Error - Could not select that database ".$dbname;
    exit;
}


$cid = $_POST['cid'];
$cname = $_POST['cname'];

trim($cid);
trim($cname);

$cid = stripslashes($cid);
$cname = stripslashes($cname);


$query = "update customers set cname = '$cname' where cid = '$cid';";

// Execute the query
$result = mysql_query($query);
if (!$result) {
   print "Error - the query could not be executed";
   $error = mysql_error();
   print "<p>" . $error . "</p>";
   exit;
}

// Get the number of rows in the result
$num_rows = mysql_num_rows($result);

// Get the number of fields in the rows
$num_fields = mysql_num_fields($result);

print "<table border='border'><caption> <h2> The information has been successfully updated. </h2> </caption>";

mysql_close($conn);
?>

<br /><br />
<a href="http://css1.seattleu.edu/~lngo1/dbtest/db.html"> Go to Main Page </a>

</body>
</html>
