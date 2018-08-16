<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="user.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>Exercise Activity Tracker</h1>
<h2>Register Here</h2>

<?php

    require_once('appvars.php');
    require_once('connectvars.php');

    if (isset($_POST['submit']))
    {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die("Error connection to DB_NAME server.");
        $username = $_POST['username'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $birthdate = $_POST['birthdate'];
        $gender = $_POST['gender'];
        $weight = $_POST['weight'];
        $password = $_POST['password'];
        $passwordConfirmation = $_POST['passwordConfirm'];
        $image = $_FILES['image']['name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];

        $user_variables = array("username", "firstName", "lastName", "birthdate",
                              "gender", "weight", "password", "passwordConfirmation");

        $user_entries = compact($user_variables);

        $_isFormComplete = true;

        error_log("user_entries count: " . count($user_entries));

        foreach($user_entries as $entry)
        {
            error_log("entry: " . $entry);
            if (empty($entry))
            {
                error_log("Current empty entry: " . $entry);
                $_isFormComplete = false;
                break;
            }
        }

        if ($_isFormComplete && $password == $passwordConfirmation)
        {
            $firstName = mysqli_real_escape_string($dbc, trim($firstName));
            $lastName = mysqli_real_escape_string($dbc, trim($lastName));
            $birthdate = mysqli_real_escape_string($dbc, trim($birthdate));
            $gender = mysqli_real_escape_string($dbc, trim($gender));
            $weight = mysqli_real_escape_string($dbc, trim("$weight"));
            $password = mysqli_real_escape_string($dbc, trim($password));

            $query = "SELECT username FROM exercise_user WHERE username = '$username'";
            $data = mysqli_query($dbc, $query);

            if (mysqli_num_rows($data) == 0)
            {

                if (($image_type == 'image/gif' || $image_type == 'image/jpeg'
                    || $image_type == 'image/pjpeg' || $image_type == 'image/png')
                    && $image_size > 0 && $image_size <= SC_MAXFILESIZE)
                {

                    if ($_FILES['image']['error'] == 0)
                    {
                        $target = SC_UPLOADPATH . $image;

                        if (move_uploaded_file($_FILES['image']['tmp_name'], $target))
                        {

                            $query = "INSERT INTO exercise_user (first_name, last_name, "
                                   . "gender, birthdate, weight, password, photo_location, "
                                   . "username) VALUES ('$firstName', '$lastName', "
                                   . "'$gender', '$birthdate', '$weight', SHA1('$password'), "
                                   . "'$target', '$username')";

                            error_log("QUERY: " . $query);
                            mysqli_query($dbc, $query)
                                    or die("Error querying DB_NAME.");

                            $username = "";
                            $firstName = "";
                            $lastName = "";
                            $birthdate = "";
                            $gender = "";
                            $weight = "";
                            $password = "";
                            $image = "";

                            echo '<p>Your new account has been successfully created. '
                                . ' You are now ready to login </p>';
                            mysqli_close($dbc);
                            exit();

                        }
                        else
                        {
                            echo '<p>Sorry, there was a problem uploading your photo.</p>';
                        }
                    }
                }
                else
                {
                   echo '<p>The image must be a GIF, JPEG, or PNG image file no greater than '
                         . (SC_MAXFILESIZE / 1024) . ' KB in size.</p>';
                }

                if (file_exists($_FILES['image']['tmp_name']))
                {
                    unlink($_FILES['image']['tmp_name']);
                }


            }
            else
            {
                echo '<p>An account already exists for this username. '
                    . 'Please select a different username.</p>';
                $username = "";

            }

        }
        else
        {
            echo 'Please complete all the fields in the registration form '
                . 'including password and password confirmation.';
        }

    }
?>

<div id="formContainer">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="User Name" name="username"
            value="<?php if (!empty($username)) {echo $username;} ?>">

      <label for="firstName"><b>First Name</b></label>
      <input type="text" placeholder="First Name" name="firstName"
            value="<?php if (!empty($firstName)) {echo $firstName;} ?>">

      <label for="lastName"><b>Last Name</b></label>
      <input type="text" placeholder="Last Name" name="lastName"
            value="<?php if (!empty($lastName)) {echo $lastName;} ?>">

      <label for="birthdate"><b>Birthdate</b></label><br/>
      <input type="date" name="birthdate" min="1900-01-01" max="2100-01-01" placeholder="birthdate"
        value="<?php if (!empty($birthdate)) {echo $birthdate;} ?>">

      <br/><br/>

      <label for="gender"><b>Gender</b></label><br/>
      <input type="radio" name="gender" value="f"
            <?php if (empty($gender) || ($gender == "f")) {echo "checked";}?>>Female<br/>
      <input type="radio" name="gender" value="m"
            <?php if (!empty($gender) && ($gender == "m")) {echo "checked";} ?>>Male

      <br/><br/>

      <label for="weight"><b>Weight (in pounds)</b></label><br/>
      <input type="number" name="weight" placeholder="Weight in pounds"
            value="<?php if (!empty($weight)) {echo $weight;}?>">

      <br/><br/>

      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo SC_MAXFILESIZE; ?>">
      <label for="userPhoto"><b>Upload Your Profile Picture:</b></label><br/>
      <input type="file" name="image" size="100">

      <br/><br/>

      <label for="password"><b>Password</b></label>
      <input type="password" name="password" placeholder="Password">

      <br/><br/>

      <label for="passwordConfirm"><b>Confirm Password</b></label>
      <input type="password" name="passwordConfirm" placeholder="Retype Password">

      <br/><br/>

      <input type="submit" value="Register" name="submit" class="btn">

    </div>

  </form>
</div>
</body>
</html>

