<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

  <div class="base">
    <div class="background-image"></div>
    <div class="container">
      <img class="mainImage"src="images/main.jpg"alt="Bikes on coast">
      <h1>Welcome to Exercise Tracker</h1>
      <h4>Keep track of your activity starting today!</h4>

      <form action="/java114/loginUser" method="post">

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="User Name" name="username">

        <br/><br/>

        <label for="password"><b>Password</b></label>
        <input type="password" name="password" placeholder="Password">
        <br/><br/>
        <button type="submit" class="btn">Login</button>

      </form>
    <h5><a href="registerUser.jsp">Register</a></h5>
    </div>
  </div>
</body>
<footer>
  <p>Photo by Keghan Crossland on Unsplash</p>
</footer>
</html>

