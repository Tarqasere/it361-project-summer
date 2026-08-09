<?php

$filePath = "data_registrations.csv";

$registrations = array();

if (file_exists($filePath)) {

    $file = fopen($filePath, "r");

    while (($row = fgetcsv($file)) != false) {

        if (count($row) >= 5) {
            $registrations[] = $row;
        }

    }

    fclose($file);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration List</title>

    <link rel="stylesheet" href="club-style-sheet.css">
</head>

<body>

<div class="list-box">

    <h1>Registration List</h1>

    <?php

    if (count($registrations) == 0) {

        echo "<p>No registrations found.</p>";

    } else {

    ?>

    <div class="table-box">

        <table>

            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Email</th>
                <th>Event ID</th>
                <th>Date</th>
            </tr>

            <?php

            foreach ($registrations as $row) {

                echo "<tr>";

                echo "<td>" . $row[0] . "</td>";
                echo "<td>" . $row[1] . "</td>";
                echo "<td>" . $row[2] . "</td>";
                echo "<td>" . $row[3] . "</td>";
                echo "<td>" . $row[4] . "</td>";

                echo "</tr>";
            }

            ?>

        </table>

    </div>

    <?php

    }

    ?>

    <br>

    <a class="btn" href="register.php">Back to Registration</a>

</div>

</body>

</html>