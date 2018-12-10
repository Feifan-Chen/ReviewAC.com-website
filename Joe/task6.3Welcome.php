
<?php 
$name = ($_POST["name"]);
$email = ($_POST["email"]);

//Checks to see if name is empty
if (empty($name))
{
  echo "Please input a name <br>";
}


//Checks to see if name is valid
else if (ctype_alpha(str_replace(" ", "", $name)) === false)
{
  echo "Name is not considered valid <br>";
}

//Checks to see if email is empty
if (empty($email))
{
  echo "Please input an email <br>";
}

//Checks to see if name or email is a valid input
else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
{
  echo "Email address is not considered valid <br>";
}

//Checks to see if the below names are the ones that were entered
switch ($name) {
  case "Joe" || "Vlad" || "Jack" || "Diana" || "Fiefan" || "Minsung" || "Lilin":
    echo "You are part of the team <br>";
    break;

  default:
    echo "You are not part of the team <br>";

}

?>
