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
  <ul>
    <li><a href="/java114">Home</a></li>
    <li><a href="/java114/logExerciseForward">Log Exercise</a></li>
    <li><a href="/java114/userProfile">View Profile</a></li>
    <li><a href="/java114/editprofile">Edit Profile</a></li>
    <li><a href="/java114/logOut">Log Out</a></li>
</ul>
  <img class="mainImage" src="images/" alt="">
  <h1>Exercise Tracker</h1>
  <h4>Edit Your Profile</h4>

  <form action="/java114/updateProfile" method="post">

    Username:<br/>
    <input name="username" type="text" value="${user.username}">
    <br/><br/>
    First name:<br/>
    <input name="firstName" type="text" value="${user.firstName}">
    <br/><br/>
    Last name:<br/>
    <input name="lastName" type="text" value="${user.lastName}">
    <br/><br/>
    Gender:<br/>
    <c:set var="currentGender" scope="session" value="female"/>
    Current value (to change, select another value):
                   <c:if test="${user.gender eq 'm'}">
                     <c:set var="currentGender" scope="session" value="male"/>
                   </c:if>
        <c:out value="${currentGender}"/><br/>
        <input type="radio" name="gender" value="f" checked>Female<br/>
        <input type="radio" name="gender" value="m">Male

    <br/><br/>
    Birthdate:<br/>
    <input name="birthdate" type="date" min="1900-01-01" max="2100-01-01" value="${user.birthdate}">
    <br/><br/>
    Weight:<br/>
    <input name="weight" type="text" value="${user.weight}">
    <br/><br/>
    <input type="submit" value="Update Profile">
  </form>

</div>
  </div>
</body>
</html>