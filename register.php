<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
</head>

<body>

<h1>Event Registration</h1>

<form action="process_registration.php" method="POST">

    <label>Student Name</label><br>
    <input type="text" name="student_name"><br><br>

    <label>Student ID</label><br>
    <input type="text" name="student_id"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Select Event</label><br>
    <select name="event_id">
        <option value="1">Math Event</option>
        <option value="2">Physics Event</option>
        <option value="3">Robotics Event</option>
    </select>

    <br><br>

    <input type="submit" value="Register">

</form>

</body>
</html>