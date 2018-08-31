<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<?php
    require_once('connectvars.php');

    $willDisplayErrorMessage = false;
    $errorMessage = "";
    if (isset($_POST['submit']))
    {
        if (!empty($_POST['username']) || !empty($_POST['password']))
        {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die("Error connection to DB_NAME server.");

            $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
            $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

            $query = "SELECT id, username, gender, birthdate, weight FROM exercise_user WHERE "
                    . "username = '$username' AND password = SHA1('$password')";
            $data = mysqli_query($dbc, $query);
            mysqli_close($dbc);

            if (mysqli_num_rows($data) == 1)
            {
                session_start();
                $row = mysqli_fetch_array($data);
                $user_id = $row['id'];
                $gender = $row['gender'];
                $weight = $row['weight'];
                $birthdate = $row['birthdate'];
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['gender'] = $gender;
                $_SESSION['birthdate'] = $birthdate;
                $_SESSION['weight'] = $weight;
                $_SESSION['session_id'] = session_id();
                header('Location: userProfile.php');

                error_log("birthdate on index page: " . $birthdate);
                exit();
            }
            else
            {
                $willDisplayErrorMessage = true;
                $errorMessage = '<p>Please ensure that your username and password are correct. '
                        . '<br/>If you don\'t have an account, please click on the "Register" '
                        . ' link below to create a new account.</p>';
            }

        }
        else
        {
            $willDisplayErrorMessage = true;
            $errorMessage = '<p>Please provide your complete username and password or follow '
                . 'the "Register" link below to create a new account.</p>';
        }
    }

?>
  <div class="base">
    <div class="background-image"></div>
    <div class="container">
      <img class="mainImage"src="images/main.jpg"alt="Bikes on coast">
      <h1>Welcome to Exercise Tracker</h1>
      <h4>Keep track of your activity starting today!</h4>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="User Name" name="username">

        <br/><br/>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Password">
        <br/><br/>
        <input type="submit" name="submit" class="btn" value="Login">

      </form>
      <?php
            if ($willDisplayErrorMessage)
            {
                echo $errorMessage;
            }

      ?>
    <h5><a href="registerUser.jsp">Register</a></h5>
    </div>
  </div>
</body>
<footer>
  <p>Photo by Keghan Crossland on Unsplash</p>
</footer>
</html>

