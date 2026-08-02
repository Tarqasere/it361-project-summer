<?php

date_default_timezone_set("Asia/Riyadh");

$messageStatus = "";
$messageType = "";

$name = "";
$email = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {

        $messageStatus = "Please fill in all fields.";
        $messageType = "error";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $messageStatus = "Please enter a valid email address.";
        $messageType = "error";

    } else {

        $filePath = __DIR__ . "/contact-messages.csv";
        $file = fopen($filePath, "a");

        if ($file !== false) {

            fputcsv($file, [
                date("Y-m-d H:i:s"),
                $name,
                $email,
                $message
            ]);

            fclose($file);

            header("Location: About.php?sent=1");
            exit;

        } else {

            $messageStatus = "Unable to save the message.";
            $messageType = "error";
        }
    }
}

if (isset($_GET["sent"]) && $_GET["sent"] === "1") {
    $messageStatus = "Your message was sent successfully.";
    $messageType = "success";
}

/*
    These variables can be used inside header.php
    to change the title and active navigation link.
*/
$pageTitle = "About and Contact";
$activePage = "about";

include "header.php";

?>

<main class="about-page">

    <section class="about-section">

        <h1>Campus Events Hub</h1>

        <h2>About Us</h2>

        <p>
            Campus Events Hub is a website for university events.
            Students can explore upcoming campus activities,
            view event details, and register for events online.
        </p>

    </section>

    <hr>

    <section class="team-section">

        <h2>Team Members</h2>

        <div class="team-members">

            <div class="member">Student Name 1</div>
            <div class="member">Student Name 2</div>
            <div class="member">Student Name 3</div>
            <div class="member">Student Name 4</div>

        </div>

    </section>

    <hr>

    <section class="contact-section">

        <h2>Contact Us</h2>

        <p>
            Have a question or suggestion? Send us a message using
            the form below.
        </p>

        <?php if ($messageStatus !== ""): ?>

            <p class="message-status <?php echo $messageType; ?>">
                <?php
                echo htmlspecialchars(
                    $messageStatus,
                    ENT_QUOTES,
                    "UTF-8"
                );
                ?>
            </p>

        <?php endif; ?>

        <form action="About.php" method="post">

            <label for="name">Full Name:</label>

            <input
                type="text"
                id="name"
                name="name"
                maxlength="100"
                value="<?php
                    echo htmlspecialchars(
                        $name,
                        ENT_QUOTES,
                        "UTF-8"
                    );
                ?>"
                required
            >

            <label for="email">Email:</label>

            <input
                type="email"
                id="email"
                name="email"
                maxlength="150"
                value="<?php
                    echo htmlspecialchars(
                        $email,
                        ENT_QUOTES,
                        "UTF-8"
                    );
                ?>"
                required
            >

            <label for="message">Message:</label>

            <textarea
                id="message"
                name="message"
                rows="5"
                maxlength="1000"
                required
            ><?php
                echo htmlspecialchars(
                    $message,
                    ENT_QUOTES,
                    "UTF-8"
                );
            ?></textarea>

            <button type="submit">Send</button>
            <button type="reset">Clear</button>

        </form>

    </section>

</main>

<?php include "footer.php"; ?>