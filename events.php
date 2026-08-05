<?php
// store all events here after reading the file
$events = [];
$csvFile = 'data/events.csv';

// if the CSV file exists, load the data from it
if (file_exists($csvFile)) {
    $file = fopen($csvFile, 'r');
    
    // read each row and add it to the events array
    while (($row = fgetcsv($file)) !== FALSE) {
        $events[] = $row;
    }
    fclose($file);
    
    // remove the first row since it's just the column titles
    if (count($events) > 0) {
        array_shift($events);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Events - Campus Events Hub</title>
</head>
<body>
    <header class="header">
        <img class="logo" src="images/LogoPT.png" alt="Campus Hub Logo" width="100" />
        <nav class="header-links">
            <a href="index.php">Home</a>
            <a href="events.php" class="active">Events</a>
            <a href="About.php">About Us</a>
            <button class="btn btn-signin">Sign in</button>
        </nav>
    </header>

    <main>
        <br>
        <div class="container">
            <?php if (count($events) == 0): ?>
                <p>No events available at the moment.</p>
            <?php else: ?>
                <?php 
                // go through each event and display its info
                foreach ($events as $event): 
                    $id = $event[0];
                    $title = $event[1];
                    $description = $event[2];
                    $image = $event[3];
                ?>
                    <div class="div1">
                        <h2><?php echo $title; ?></h2>
                        <p><?php echo $description; ?></p>
                        
                        <!-- show the image only if it exists -->
                        <?php if ($image != ""): ?>
                            <img src="<?php echo $image; ?>" class="mathImg" alt="Event Image">
                        <?php endif; ?>

                        <br><br>
                        <a href="event.php?id=<?php echo $id; ?>">
                            <button id="btn">View Details</button>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-about">
                <h3>Campus Events Hub</h3>
                <p>Your campus platform to stay updated with the latest events and academic activities.</p>
            </div>
            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="events.php">Events</a></li>
                    <li><a href="About.php">About us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Campus Events Hub - All rights reserved</p>
        </div>
    </footer>
</body>
</html>