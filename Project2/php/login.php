<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<h1>Exercise Activity Tracker</h1>
<h2>Login Here</h2>

<div id="formContainer">
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

    <div class="container">
      <label for="username"><b>Username</b></label>
      <input type="text" placeholder="User Name" name="username">

      <br/><br/>

      <label for="password"><b>Password</b></label>
      <input type="password" name="password" placeholder="Password">

      <br/><br/>
      <input type="button" class="btn" value="Login">

    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" id="cancelButton" class="btn">Cancel</button>
    </div>
  </form>
</div>
</body>
</html>

