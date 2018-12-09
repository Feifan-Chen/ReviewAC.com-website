<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="../style.css">
    <title>Welcome message</title>
  <head>
  <body>
  <p>
  Welcome 
  <!--information used from:-->
  <!--https://stackoverflow.com/questions/24026250/the-difference-between-n-and-br-in-php-->
  <?php
  //list of names declared as array
  $namelist = array("Minsung", "Diana", "Jack", "Joe", "Feifan", "Vlad", "Lilin");
  //checks if given name is in array
  if (in_array($_GET["name"], $namelist))
  {
    echo $_GET["name"]." to my webpage!";
  } 
  else 
  {
    echo $_GET["name"];
  }
  ?>
  <br>
  Your email address is: 
  <!--information used from:-->
  <!--https://stackoverflow.com/questions/4366730/how-do-i-check-if-a-string-contains-a-specific-word-->
  <?php 
  if (strpos($_GET["mail"], '@') !== false)
  {
    echo $_GET["mail"];
  }
  else
  {
    echo "Invalid email address";
  }
  ?>
  <br>
  <a href="index.php">Back to PHP welcome page</a>
  </p>
  <p>
  <a href="../index.html">Back to main page</a>
  </p>
