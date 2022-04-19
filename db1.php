<!-- db1.php
     A PHP script to access the database
     through MySQL
     -->
     <html>
<head>
<title> Access the database with MySQL </title>
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
     print "Error - Could not connect to MySQL ".$conn;
     exit;
}

$dbname = "bw_db42";

$db = mysql_select_db($dbname, $conn);
if (!$db) {
    print "Error - Could not select the database ".$dbname;
    exit;
}

$entity = $_POST['entity'];

// Clean up the given query (delete leading and trailing whitespace)
trim($entity);

// remove the extra slashes
$entity = stripslashes($entity);

$query = 'select * from '.$entity.';';

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

// Get the first row
$row = mysql_fetch_array($result);

// Display the results in a table
print "<table><caption> <h2> $entity </h2> </caption>";
print "<tr align = 'center'>";

// Produce the column labels
$keys = array_keys($row);
for ($index = 0; $index < $num_fields; $index++) 
    print "<th>" . $keys[2 * $index + 1] . "</th>";

print "</tr>";

// Output the values of the fields in the rows
for ($row_num = 0; $row_num < $num_rows; $row_num++) {

    print "<tr align = 'center'>";
    $values = array_values($row);
	
    for ($index = 0; $index < $num_fields; $index++){
        $value = htmlspecialchars($values[2 * $index + 1]);
        print "<td>" . $value . "</td> ";
    }

    print "</tr>";
    $row = mysql_fetch_array($result);
}

print "</table>";

mysql_close($conn);
?>

<br /><br />
<a href="http://css1.seattleu.edu/~lngo1/dbtest/db.html"> Go to Main Page </a>

</body>
</html>
