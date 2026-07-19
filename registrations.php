<?php
$filePath = __DIR__ . "/data/registrations.csv";
$registrations = [];

// Read registrations from the CSV file
if (file_exists($filePath)) {
    $file = fopen($filePath, "r");

    if ($file !== false) {
        // Skip the first row because it contains column headings
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            if (count($row) >= 5) {
                $registrations[] = $row;
            }
        }

        fclose($file);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration List</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            background-color: #f4f6f8;
        }

        main {
            max-width: 1100px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #cccccc;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #1f4e78;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .message {
            padding: 15px;
            background-color: #fff3cd;
            border: 1px solid #ffe69c;
        }
    </style>
</head>

<body>
    <main>
        <h1>Registration List</h1>

        <?php if (empty($registrations)): ?>

            <p class="message">No registrations have been submitted yet.</p>

        <?php else: ?>

            <table>
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Event ID</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($registrations as $registration): ?>
                        <tr>
                            <td><?= htmlspecialchars($registration[0]) ?></td>
                            <td><?= htmlspecialchars($registration[1]) ?></td>
                            <td><?= htmlspecialchars($registration[2]) ?></td>
                            <td><?= htmlspecialchars($registration[3]) ?></td>
                            <td><?= htmlspecialchars($registration[4]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

        <p>
            <a href="index.php">Return to Home Page</a>
        </p>
    </main>
</body>
</html>
