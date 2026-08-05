<?php
// check if an event id was passed in the URL
$selectedId = null;
if (isset($_GET['id'])) {
    $selectedId = $_GET['id'];
}

$selectedEvent = null;
$csvFile = 'data/events.csv';

// if we have an id and the file exists, try to find the event
if ($selectedId != null && file_exists($csvFile)) {
    $file = fopen($csvFile, 'r');
    
    // skip the header row (first line)
    fgetcsv($file);
    
    // go through each row until we find a match
    while (($row = fgetcsv($file)) !== FALSE) {
        if ($row[0] == $selectedId) {
            $selectedEvent = $row;
            break; // stop once we find the event
        }
    }
    fclose($file);
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
    <title>Event Details</title>
</head>
<body>
    <!-- main header (shared across pages) -->
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
            <div class="event-details-card">
                <a href="events.php" class="back-link">Back to Events</a>
                
                <?php if ($selectedEvent != null): ?>
                    
                    <?php 
                        // assign each value from the CSV row to a readable variable
                        $id = $selectedEvent[0];
                        $title = $selectedEvent[1];
                        $description = $selectedEvent[2];
                        $image = $selectedEvent[3];
                        $isOpen = $selectedEvent[4];
                    ?>

                    <h2><?php echo $title; ?></h2>
                    <p><?php echo $description; ?></p>

                    <!-- only show the image if one is available -->
                    <?php if ($image != ""): ?>
                        <img src="<?php echo $image; ?>" class="mathImg" alt="Event Image">
                    <?php endif; ?>

                    <br><br>

                    <!-- show register button if the event is open, otherwise show closed message -->
                    <?php if ($isOpen == "1"): ?>
                        <a href="register.php?event_id=<?php echo $id; ?>">
                            <button id="btn">Register For This Event</button>
                        </a>
                    <?php else: ?>
                        <p class="closed-msg">
                            Registration for this event is closed (Announcement Only)
                        </p>
                    <?php endif; ?>

                <?php else: ?>
                    
                    <!-- fallback if no event was found -->
                    <h2>Event Not Found!</h2>
                    <p>Please select a valid event from the main events page.</p>

                <?php endif; ?>

            </div>
        </div>
    </main>

    <!-- footer section (same across the site) -->
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