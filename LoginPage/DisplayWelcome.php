<html>
<body>

<meta charset="UTF-8">

<head>
  <link rel="stylesheet" href="./styles.css">
  <title>DisplayWelcome</title>
</head>
  

<body>

<ul>
  <li><a class="active" href="./index.html">Home</a></li>
  <li><a href="./implementation.html">Implementation</a></li>
</ul>

<div style="padding:20px;margin-top:30px;background-color:#1abc9c;
            height:1500px;">


<!-- Code adapted and learnt from www.w3schools.com -->

<?php
//Database handling

// Load the configuration file containing your database credentials
require_once('./config.inc.php');
require_once('./GroupDBNames.php');

// Connect to the group database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);

// Check for errors before doing anything else
if($mysqli -> connect_error) 
{
  die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  // get fields
  $email = $_POST['email'];
  $name = $_POST['name'];
  $isMember = 0;
  
  $error = 0;
  $newUser = 1;
  $newEmail = 1;
  
  
  
  
  //NAME CHECKS
  
  //check if no name was given
  if (empty($name))
  {
    echo "Name is required <br>";
    $error = 1;
  }
  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$name))
  {
    echo "Only letters and white space allowed in name <br>";
    $error = 1;
  }

  
  //EMAIL CHECKS
    
  //check if no email was given
  if (empty($email))
  {
    echo "Email is required <br>";
    $error = 1;
    echo "error = " . $error . "<br>";
  }
  //check if the email is valid
  else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
    echo "Invalid email format <br>";
    $error = 1;
    echo "error = " . $error . "<br>";
  }

    
  
  //tell user to correct errors before continuing
  if ($error == 1)
  {
    echo "Correct above errors. <br>";
  }
  
  //continue if there are no errors
  elseif ($error == 0)
  {
    //check to see if record already exists, based on full name  and email
  
    $sql = "SELECT ID, Name, Email, Group_Member FROM People";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) 
    {
      // search data of each row
      while($row = $result->fetch_assoc()) 
      {
        if ($row["Email"] == $email)
        {
          $newUser = 0;
          
          if ($row["Name"] != $name)
          {
            $error = 1;
            echo "User with different name already created with this email. <br>"; 
          }
          elseif ($row["Group_Member"] == 1)
          {
            switch ($row["ID"])
            {
              case "1";
                echo '<a href="../Jack/index.html">Jack</a> <br>';
                break;
              case "2";  
                echo '<a href="../Diana/index.html">Diana</a> <br>';
                break;
              case "3";
                echo '<a href="../Vlad/index.html">Vlad</a> <br>';
                break;
              case "4";
                echo '<a href="../Lilin/index.html">Lilin</a> <br>';
                break;
              case "5";
                echo '<a href="../Feifan/index.html">Feifan</a> <br>';
                break;
              case "6";
                echo '<a href="../Minsung/index.html">Minsung</a> <br>';
                break;
              case "7";
                echo '<a href="../Joe/index.html">Joe</a> <br>';
                break;
              default;
      	        echo "error <br>";
      	        break;
            }//end switch
          
            echo "Click the above link to be redirected to your personal page. <br>";
            
          }//end elseif ($row["Group_Member"] == 1)
          
      	  //if email and name is same, but not group member
      	  //> existing non-member user
      	  else
          {
            echo "welcome back " . $name . ", you've been here before! <br>";
          }
          	
        }//end if ($row["Name"] != $name)
      }//end while
    }//end if ($result->num_rows > 0) 


    //prepare to insert into table
    $sql = "INSERT INTO People (Name, Email)
            VALUES ('$name', '$email')";
    
    //if there's no errors, and it's a new user, insert new record into table
    if ($error == 0)
    {
      //write data to table
      if ($newUser == 1)
      {
        if ($mysqli->query($sql) === TRUE) 
        {
          echo "Registration successfull, please go back and log in <br>";
        }//end if
         
        else 
        {
          echo "Error: " . $sql . "<br>" . $mysqli->error;
        }//end else ($mysqli->query($sql) === TRUE)
        
      }//end ($newUser == 1)
    }//end if ($error == 0)
  
    //catch weird errors
    else
    {
      echo "error unknown";
    }//end else $error
      
    //print table for testing purposes.
      
    echo "<br> <br> <br> <br> <br>";
    $sql = "SELECT ID, Name, Email, Group_Member FROM People";
    $result = $mysqli->query($sql);
    
    if ($result->num_rows > 0) 
    {
      // output data of each row
      while($row = $result->fetch_assoc()) 
      {
        echo "id: " . $row["ID"] . " - Name:  " . $row["Name"] . "<br>" . 
             "..........Email: " . $row["Email"] . 
             "<br>" . "is member? " . $row["Group_Member"] . "<br> <br>";
      }//end while
    }//end if
    else 
    {
      echo "0 results";
    }//end else
  
  }//end if ($error == 0)
}//end if ($_SERVER["REQUEST_METHOD"] == "POST") 
// Always close your connection to the database cleanly!
$mysqli -> close();
?>

</div>
</body>
</html>
