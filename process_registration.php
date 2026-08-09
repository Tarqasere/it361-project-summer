<?php include "header.php"; ?>

<main>
    <div class="register-box">

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["student_name"];
    $id = $_POST["student_id"];
    $email = $_POST["email"];
    $event = $_POST["event_id"];

    if ($name == "" || $id == "" || $email == "" || $event == "") {

        echo "<h2>Registration Error</h2>";
        echo "<p>Please fill in all fields.</p>";
        echo "<a class='btn' href='register.php'>Go Back</a>";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        echo "<h2>Registration Error</h2>";
        echo "<p>Please enter a valid email address.</p>";
        echo "<a class='btn' href='register.php'>Go Back</a>";

    } else {

        $file = fopen("data_registrations.csv", "a");
        $date = date("Y-m-d");

        fputcsv($file, array($name, $id, $email, $event, $date));
        fclose($file);

        echo "<h2>Registration completed successfully.</h2>";
        echo "<p><a class='btn' href='register.php'>Register Another Student</a></p>";
        echo "<p><a class='btn' href='registrations.php'>View Registration List</a></p>";
    }

} else {

    echo "<h2>Invalid Request</h2>";
    echo "<a class='btn' href='register.php'>Return to Registration</a>";
}

?>

    </div>
</main>

<?php include "footer.php"; ?>