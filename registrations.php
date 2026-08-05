<?php

$filePath = "data_registrations.csv";

$registrations = array();

if (file_exists($filePath)) {

    $file = fopen($filePath, "r");

    if ($file != false) {

        while (($row = fgetcsv($file)) != false) {

            if (count($row) >= 5) {
                $registrations[] = $row;
            }

        }

        fclose($file);
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Registration List</title>
    <meta charset="UTF-8">

    <style>

        body {
            font-family: Arial;
            margin: 30px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: lightgray;
        }

    </style>

</head>

<body>

<h1>Registration List</h1>

<?php

if (count($registrations) == 0) {

    echo "<p>No registrations found.</p>";

} else {

?>

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

<?php

}

?>

<br>

<a href="register.php">Back to Registration</a>

</body>

</html>
