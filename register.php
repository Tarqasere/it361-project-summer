<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet" href="club-style-sheet.css">
</head>

<body>

<div class="register-box">

    <h1>Event Registration</h1>

    <form action="process_registration.php" method="POST">

        <label>Student Name</label>
        <input type="text" name="student_name" required>

        <label>Student ID</label>
        <input type="text" name="student_id" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Select Event</label>

        <select name="event_id" required>
            <option value="">Choose Event</option>
            <option value="1">Math Event</option>
            <option value="2">Physics Event</option>
            <option value="3">Robotics Event</option>
        </select>

        <input type="submit" value="Register">

    </form>

    <br>

    <a href="registrations.php">View Registration List</a>

</div>

</body>

</html>