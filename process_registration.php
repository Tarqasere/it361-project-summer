<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["student_name"];
    $id = $_POST["student_id"];
    $email = $_POST["email"];
    $event = $_POST["event_id"];

    if ($name == "" || $id == "" || $email == "" || $event == "") {

        echo "Please fill in all fields.";

    } else {

        $file = fopen("data_registrations.csv", "a");

        $date = date("Y-m-d");

        fputcsv($file, array($name, $id, $email, $event, $date));

        fclose($file);

        echo "<h2>Registration completed successfully.</h2>";
        echo "<a href='register.php'>Register another student</a><br><br>";
        echo "<a href='registrations.php'>View Registration List</a>";

    }

} else {

    echo "Invalid request.";

}

?>