<html>
<body>

<?php
$tutorial = array("Vlad", "Diana", "Jack", "Joe", "Feifan", "Lilin");
$name = $_POST["name"];
if (!preg_match("/^[a-zA-Z ]*$/",$name))
echo " Only letters and spaces are allowed";

else if(in_array($name,$tutorial))
echo "$name you are part of X2";
else
echo "$name you are not part of X2";
?>
<br>
<!-- The code for validation is from https://www.w3schools.com/php/php_form_url_email.asp -->
<?php
$email = $_POST["email"];
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
echo "Invalid email format";
else
echo" Your email is $email";
?>

</body>
</html>
