<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<?php
    require_once('connectvars.php');

    if (!empty($_POST['username']) && !empty($_POST['password']))
    {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die("Error connection to DB_NAME server.");

        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password = mysqli_real_escape_string($dbc, trim($_POST['password']));

        $query = "SELECT id, username FROM exercise_user WHERE "
                . "username = '$username' AND password = SHA1('$password')";
        $data = mysqli_query($dbc, $query);
        $willDisplayErrorMessage = false;

        if (mysqli_num_rows($data) == 1)
        {

            $row = mysqli_fetch_array($data);
            $user_id = $row['id'];
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            header('Location: userProfile.php');
            exit();
        }

    }
    else
    {
        $willDisplayErrorMessage = true;

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
        <button type="submit" class="btn">Login</button>

      </form>
      <?php
            if ($willDisplayErrorMessage)
            {
                echo '<p>Please provide your complete username and password or follow '
                . 'the "Register" link below to create a new account</p>';
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

