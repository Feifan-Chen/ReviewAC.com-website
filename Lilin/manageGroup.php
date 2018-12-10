<!DOCTYPE HTML> 
<html>
<head>
<style>
 .error {color: #FF0000;}
</style>
</head>
 <body>
 <h2>Group Member Database</h2>
<?php

//The following codes are modified from part of the examples 
//in the "The w3schools PHP & MySQL tutorial"
//Basic info
$servername = "dbhost.cs.man.ac.uk";
$username = "q06722lh";
$password = "0819RewQ";
$dbname = "q06722lh";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die($conn->connect_error);
		

//Data input Validation,code from "The w3schools PHP & MySQL tutorial"
$nameErr = $emailErr = "";	
if (!isset($_POST['delete']) &&  isset($_POST['name']))	
{
	if (empty($_POST["name"])) 
		$nameErr = "<br/><span class='error'>Name is required</span>";
	else {
		$name = test_input($_POST["name"]);
		// Only letters and white space allowed
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "<br/><span class='error'>Only letters and white space allowed</span>"; 
		}
	}
	if (empty($_POST["email"])) 
		$emailErr = "<br/><span class='error'>Email is required</span>";
	else {
		$email = test_input($_POST["email"]);
		// Validation of Email format
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$emailErr = "<br/><span class='error'>Invalid email format</span>"; 
		}
	}
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<h3>Add Group Member</h3>
<p><span class="error">* Required field</span></p>
<form method="post" action="manageGroup.php"> 
   Name: <input type="text" name="name">
   <span class="error">* <?php echo $nameErr;?></span>
   <br><br>
   Email：<input type="text" name="email">
   <span class="error">* <?php echo $emailErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="ADD RECORD">  
</form>

<?php
//Check for new member
if (isset($_POST['name']) && isset($_POST['email']) && $nameErr == "" && $emailErr == "") 
{
	$name = $_POST['name'];
	$query = "SELECT * FROM MyGroup WHERE name='$name' AND email='$email'";
	$result = $conn->query($query);
	if (!$result) die ("Database access failed: " . $conn->error);
	$rows = $result->num_rows;
    
	//Insert new members
	if ($rows == 0) 
	{  
/*	//Typical use of  "INSERT INTO"
		$name = $_POST['name'];
		$email =$_POST['email'];
		$query = "INSERT INTO MyGroup VALUES" ."('$name', '$email')";
		$result = $conn->query($query);
*/
		
// To aviod SQL Injection Attack, 
// Here we use preparation and parameter binding.
// code from "The w3schools PHP & MySQL tutorial"
		$stmt = $conn->prepare("INSERT INTO MyGroup (name, email) VALUES (?, ?)");
		$stmt->bind_param("ss",  $name, $email);// parameter binding
		$name = $_POST['name'];
		$email =$_POST['email'];
		$result = $stmt->execute();		
		if (!$result) echo "INSERT failed: $query<br>" . $conn->error . "<br><br>";
		else echo"<span class='error'>" . $name . " is added to the Group sucessfully! </span>";
	}
	else echo"<span class='error'>" . $name . " was in the Group! </span>";
}
?>

<h3>Delete Group Member</h3>
       <form action="manageGroup.php" method="post">
            <input type="hidden" name="delete" value="yes">
            Name: <input type="text" name="name" >
             <input type="submit" value="DELETE RECORD">
        </form>

<?php

//To delete a  member
if (isset($_POST['delete']) && isset($_POST['name']))
{
    $name = $_POST['name'];
    $query = "DELETE FROM MyGroup WHERE name='$name'";
    $result = $conn->query($query);
    if (!$result) echo "DELETE failed: $query<br>" . $conn->error . "<br><br>";
	
}


// List all members
$query = "SELECT * FROM MyGroup";
$result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
$rows = $result->num_rows;
?>

<h3>List Group Members</h3>
<table width="580" border="1">
  <tr>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
  </tr>
<?php
for ($j = 0 ; $j < $rows ; ++$j)
{
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);
    echo "  <tr><td>" . $row[0] . "</td>";
	echo "<td>" . $row[1] . "</td> </tr>";	
}
echo "</table>" ; 
$result->close();
$conn->close();
?>
  
</body>
</html>
