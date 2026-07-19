<?php
// Allow this page to receive form data using POST only
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

// Receive and clean the form data
$studentName = trim($_POST["student_name"] ?? "");
$studentId   = trim($_POST["student_id"] ?? "");
$email       = trim($_POST["email"] ?? "");
$eventId     = trim($_POST["event_id"] ?? "");

// Store validation errors
$errors = [];

if ($studentName === "") {
    $errors[] = "Student name is required.";
}

if ($studentId === "") {
    $errors[] = "Student ID is required.";
} elseif (!preg_match('/^[0-9]+$/', $studentId)) {
    $errors[] = "Student ID must contain numbers only.";
}

if ($email === "") {
    $errors[] = "Email address is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if ($eventId === "") {
    $errors[] = "Please select an event.";
}

// Display errors and stop if the data is invalid
if (!empty($errors)) {
    echo "<h1>Registration Error</h1>";

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }

    echo '<a href="javascript:history.back()">Go Back</a>';
    exit;
}

// Create the data folder if it does not exist
$dataDirectory = __DIR__ . "/data";

if (!is_dir($dataDirectory)) {
    mkdir($dataDirectory, 0777, true);
}

$filePath = $dataDirectory . "/registrations.csv";
$isNewFile = !file_exists($filePath) || filesize($filePath) === 0;

// Open the CSV file and append the registration
$file = fopen($filePath, "a");

if ($file === false) {
    exit("Unable to save the registration.");
}

// Prevent two registrations from writing at the same time
flock($file, LOCK_EX);

if ($isNewFile) {
    fputcsv($file, [
        "Student Name",
        "Student ID",
        "Email",
        "Event ID",
        "Registration Date"
    ]);
}

fputcsv($file, [
    $studentName,
    $studentId,
    $email,
    $eventId,
    date("Y-m-d H:i:s")
]);

flock($file, LOCK_UN);
fclose($file);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
</head>
<body>
    <main>
        <h1>Registration Successful</h1>

        <p>
            Thank you,
            <?= htmlspecialchars($studentName) ?>.
            Your registration has been saved successfully.
        </p>

        <a href="index.php">Return to Home Page</a>
    </main>
</body>
</html>
