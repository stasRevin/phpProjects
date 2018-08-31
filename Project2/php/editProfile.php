<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

  <div class="base">
    <div class="background-image"></div>
    <div class="container">
  <?php
      require_once("menu.html");
      require_once("connectvars.php");

      session_start();

      if (session_id() === $_SESSION['session_id'])
      {

          error_log("IN SESSION");
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                  or die("Error connection to DB_NAME server.");

          $user_id = $_SESSION['user_id'];

          $query = "SELECT id, username, first_name, last_name, gender, birthdate, "
                 . "weight FROM exercise_user WHERE id = '$user_id'";
          $data = mysqli_query($dbc, $query)
                  or die("Error queryin DB_NAME");


          if (mysqli_num_rows($data) == 1)
          {
              error_log("HAS ROWS");
              $row = mysqli_fetch_array($data);
              $username = $row['username'];
              $firstName = $row['first_name'];
              $lastName = $row['last_name'];
              $gender = $row['gender'];
              $birthdate = $row['birthdate'];
              $weight = $row['weight'];
          }


          if (isset($_POST['submit']))
          {

              $updatedFirstName = $_POST["firstName"];
              $updatedLastName = $_POST["lastName"];
              $updatedGender = $_POST["gender"];
              $updatedBirthdate = $_POST["birthdate"];
              $updatedWeight = $_POST["weight"];
              $updatedUsername = $_POST["username"];

              $query = "UPDATE exercise_user SET username = '$updatedUsername', "
                  . "first_name = '$updatedFirstName', "
                  . "last_name = '$updatedLastName', gender = '$updatedGender', "
                  . "birthdate = '$updatedBirthdate', weight = '$updatedWeight' "
                  . "WHERE id = $user_id";


              error_log("QUERY: " . $query);

              if (mysqli_query($dbc, $query))
              {
                  $_SESSION['username'] = $updatedUsername;

              }
              else
              {
                  die("Error updating DB_NAME");
              }

              header("Refresh:0");

          }


          mysqli_close($dbc);

      }

  ?>


  <img class="mainImage" src="images/" alt="">
  <h1>Exercise Tracker</h1>
  <h4>Edit Your Profile</h4>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    Username:<br/>
    <input name="username" type="text" value="<?php echo $username; ?>">
    <br/><br/>
    First name:<br/>
    <input name="firstName" type="text" value="<?php echo $firstName; ?>">
    <br/><br/>
    Last name:<br/>
    <input name="lastName" type="text" value="<?php echo $lastName; ?>">
    <br/><br/>
    Gender:<br/>
    Current value (to change, select another value):
                   <?php
                       $gender === 'm' ? $genderValue = "male" : $genderValue = "female";
                       echo $genderValue;
                   ?>
        <br/>
        <input type="radio" name="gender" value="f" checked>Female<br/>
        <input type="radio" name="gender" value="m">Male

    <br/><br/>
    Birthdate:<br/>
    <input name="birthdate" type="date" min="1900-01-01" max="2100-01-01" value="<?php echo $birthdate;?>">
    <br/><br/>
    Weight:<br/>
    <input name="weight" type="text" value="<?php echo $weight; ?>">
    <br/><br/>
    <input type="submit" name="submit" value="Update Profile">
  </form>

</div>
  </div>
</body>
</html>