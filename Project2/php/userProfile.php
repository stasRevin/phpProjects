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
  <img class="profileImage" src="${photoPath}" alt="test">
  <h1>Exercise Tracker</h1>
  <h4>Hello, ${user.firstName}</h4>
    <c:set var="gender" value="Male"/>
    <c:if test="${user.gender == 'f'}">
      <c:set var="gender" value="Female"/>
    </c:if>
  <table id="userInfo">
    <tr>
      <td>Username:</td>
      <td>${user.username}</td>
    </tr>
    <tr>
      <td>First name:</td>
      <td>${user.firstName}</td>
    </tr>
    <tr>
      <td>Last name:</td>
      <td>${user.lastName}</td>
    </tr>
    <tr>
      <td>Gender:</td>
      <td>${gender}</td>
    </tr>
    <tr>
      <td>Birthdate:</td>
      <td>${user.birthdate}</td>
    </tr>
    <tr>
      <td>Weight:</td>
      <td>${user.weight}</td>
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
    </tr>
    <c:forEach var="item" items="${workoutList.workoutList}">
      <tr class="userWorkout">
        <td>${item.date}</td>
        <td>${item.type}</td>
        <td>${item.time}</td>
        <td>${item.heartRate}</td>
        <td>${item.caloriesBurned}</td>
      </tr>
    </c:forEach>
  </table>
</div>
  </div>
</body>
</html>