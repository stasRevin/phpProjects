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

       require_once('menu.html');
       require_once('connectvars.php');

       session_start();

       $firstName = "";
       $lastName = "";
       $gender = "";
       $username = "";
       $birthdate = "";
       $weight = "";
       $photoLocation = "";
       $user_id = "";
       $exercises = array();

       if (session_status() == PHP_SESSION_ACTIVE)
       {
           $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("Error connection to DB_NAME server.");

           $username = $_SESSION['username'];
           $user_id = $_SESSION['user_id'];
           $query = "SELECT first_name, last_name, gender, birthdate, weight, photo_location "
                    . "FROM exercise_user WHERE username = '$username'";

           $data = mysqli_query($dbc, $query);

           if (mysqli_num_rows($data) == 1)
           {
               $row = mysqli_fetch_array($data);
               $firstName = $row['first_name'];
               $lastName = $row['last_name'];
               $gender = $row['gender'];
               $birthdate = $row['birthdate'];
               $weight = $row['weight'];
               $photoLocation = $row['photo_location'];
           }

           $query = "SELECT date, exercise_id, exercise_name, time_in_minutes, "
                   . "heartrate, calories FROM exercises_view WHERE user_id = '$user_id'";


           $data = mysqli_query($dbc, $query);

           while ($row = mysqli_fetch_array($data))
           {
               $exercises[] = $row;
               error_log("exercise_name: " . $row['exercise_name']);

           }

       }

   ?>
  <img class="profileImage" src="<?php echo $photoLocation; ?>" alt="test">
  <h1>Exercise Tracker</h1>
  <h4>Hello, <?php echo $firstName; ?></h4>
    <c:set var="gender" value="Male"/>
    <c:if test="${user.gender == 'f'}">
      <c:set var="gender" value="Female"/>
    </c:if>
  <table id="userInfo">
    <tr>
      <td>Username:</td>
      <td><?php echo $username; ?></td>
    </tr>
    <tr>
      <td>First name:</td>
      <td><?php echo $firstName; ?></td>
    </tr>
    <tr>
      <td>Last name:</td>
      <td><?php echo $lastName; ?></td>
    </tr>
    <tr>
      <td>Gender:</td>
      <td>
          <?php $displayGender = $gender == "f" ? "Female" : "Male";
                echo $displayGender;
          ?>
      </td>
    </tr>
    <tr>
      <td>Birthdate:</td>
      <td><?php echo $birthdate; ?></td>
    </tr>
    <tr>
      <td>Weight:</td>
      <td><?php echo $weight; ?></td>
    </tr>
  </table>
  <br/><br/>
  <table id="userWorkout">
    <tr>
      <th>Date</th>
      <th>Type</th>
      <th>Time in Minutes</th>
      <th>Heart Rate</th>
      <th>Calories Burned</th>
    <?php


        foreach($exercises as $exercise)
        {

            echo "<tr>";
            echo "<td>" . $exercise['date'] . "</td>";
            echo "<td>" . $exercise['exercise_name'] . "</td>";
            echo "<td>" . $exercise['time_in_minutes'] . "</td>";
            echo "<td>" . $exercise['heartrate'] . "</td>";
            echo "<td>" . $exercise['calories'] . "</td>";
            echo "<td class='deleteColumn'><a href='/php/removeExercise.php?id='" . $exercise['exercise_id'] . "'><img id='trashCan' src='images/trashCan.png' alt='trash can'></a></td>";
            echo "<tr/>";

        }


    ?>
  </table>
</div>
  </div>
</body>
</html>