<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Create data table</title>
</head>

<body>
<?php
//The following codes are modified from the examples in the "The w3schools PHP MySQL tutorial"

$servername = "dbhost.cs.man.ac.uk";
$username = "q06722lh";
$password = "0819RewQ";
$dbname = "q06722lh";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// test connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
// use sql to create datatable MyGroup
$sql = "CREATE TABLE MyGroup (
name VARCHAR(30) NOT NULL,
email VARCHAR(50)
)";
 
if ($conn->query($sql) === TRUE) {
    echo "Table MyGroup created successfully";
} else {
    echo "BD creation error: " . $conn->error;
}
 
$conn->close();
?>
</body>
</html>
