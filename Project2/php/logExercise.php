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
      $errorMessage = "";
      $successMessage = "";

      if (session_status() === PHP_SESSION_ACTIVE && isset($_POST['submit']))
      {
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                  or die("Error connection to DB_NAME server.");

          $username = $_SESSION['username'];
          $user_id = $_SESSION['user_id'];
          $exercise_type = $_POST['type'];
          $exercise_date = $_POST['date'];
          $exercise_time = $_POST['time'];
          $heartRate = $_POST['heartRate'];
          $weight = $_SESSION['weight'];
          $birthdate = $_SESSION['birthdate'];
          $gender = $_SESSION['gender'];

          $user_variables = array("exercise_type", "exercise_date",
                                  "exercise_time", "heartRate");

          $user_entries = compact($user_variables);

          $_isFormComplete = true;


          foreach($user_entries as $entry)
          {
              if (empty($entry))
              {
                  $_isFormComplete = false;
                  break;
              }

          }

          if ($_isFormComplete)
          {
              $timeZone = new DateTimeZone('America/Chicago');
              $birthdate = new DateTime($birthdate);
              $today = new DateTime("now", $timeZone);
              $today->format('Y/m/d');
              $age = intval(date_diff($birthdate, $today)->y);

              $caloriesBurned = 0;

              if ($gender === "f")
              {
                  $caloriesBurned  = round(((-20.4022 + (0.4472 * $heartRate) - (0.057288 * $weight)
                    + (0.074 * $age)) / 4.184) * $exercise_time, 0);

              }
              elseif ($gender === "m")
              {
                  $caloriesBurned = round(((-55.0969 + (0.6309 * $heartRate) + (0.090174 * $weight)
                        + (0.2017 * $age)) / 4.184) * $exercise_time, 0);

              }

              $query = "INSERT INTO exercise_log (user_id, date, type, time_in_minutes, "
                      . "heartrate, calories) VALUES ('$user_id', '$exercise_date', "
                      . "'$exercise_type', '$exercise_time', '$heartRate', '$caloriesBurned')";

              error_log("Exercise log query: " . $query);

              mysqli_query($dbc, $query)
                    or die("Error querying DB_NAME.");

              $successMessage = "<p>Your exercise has been successfully logged. "
                      . "You have burned {$caloriesBurned} calories. Add a new exercise!</p>";

              mysqli_close($dbc);
          }
          else
          {
              $errorMessage = "<p>Please complete all the fields of the form.</p>";
          }

      }


  ?>
  <div id="logExerciseForm">
      <h3>Log a New Exercise</h3>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="col-25">
        <label for="type">Type:</label>
      </div>
      <div class="col-75">
          <select name="type">
            <option value="1" selected>Running</option>
            <option value="2">Walking</option>
            <option value="3">Swimming</option>
            <option value="4">Weightlifting</option>
            <option value="5">Yoga</option>
            <option value="6">Dancing</option>
            <option value="7">Sport</option>
            <option value="8">Other</option>
          </select>
      </div>
      <br/><br/>
      <div class="col-25">
       <label for="date">Date:</label>
      </div>
      <div class="col-75">
        <input type="date" name="date" min="1900-01-01" max="2100-01-01" placeholder="Exercise Date">
      </div>
      <br/><br/>
      <div class="col-25">
        <label for="time">Time (in minutes):</label>
      </div>
      <div class="col-75">
        <input type="text" name="time">
      </div>
      <br/><br/>
      <div class="col-25">
        <label for="heartRate">Average Heart Rate:</label>
      </div>
      <div class="col-75">
        <input type="text" name="heartRate">
      </div>
      <br/><br/><br/>
      <input name="submit" type="submit" value="LOG EXERCISE">
      </form>
  </div>
  <?php if (!empty($errorMessage)) {echo $errorMessage;}  ?>
  <?php if (!empty($successMessage)) {echo $successMessage;} ?>
</div>
  </div>
</body>
</html>