<?php
session_start();

// Check if the user is logged in, if not, redirect to the home page
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit;
}

// Assume you have a database connection
$mysqli = require __DIR__ . "/database.php";

$user_id = $_SESSION["user_id"];

// Retrieve user details from the database
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donation</title>
    <link rel='stylesheet' type="text/css" href="donation.css">
</head>

<body>

    <header>
        <a href="homepage.php" class="logo">
            <img src="images/logo.png" alt="logo">
        </a>
    
        <ul class="navbar">
            <li><a href="homepage.php">Home</a></li>
            <li><a href="properties.php">Properties</a></li>
            <li><a href="donation.php">Donation</a></li>
            <li><a href="leaderboard.php">Leaderboard</a>
            <li><a href="contactus.php">Contact us</a></li>
            <li><a href="aboutus.php">About us</a></li>
        </ul>
    
        <div class="h-btn">
            <a href="account.php" class="h-btn1"><?= htmlspecialchars($user["name"]) ?></a>
            <a href="logout.php" class="h-btn2">Log Out</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    
    </header>

    <div class="container">
        <div class="time">
            <span>Donate</span>
        </div>
        <br>
        <p>Select payment type</p>

        <form action="donate.php" method="post">
            <div class="confirm">
                <select id="paymentType" name="paymentType">
                    <option value="creditCard">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>

            <div class="input">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>
            </div>

            <div class="input">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>
            </div>

            <div class="input">
                <label for="amount">Amount:</label>
                <input type="text" id="amount" name="amount" placeholder="Enter donation amount" required>
            </div>

            <br>
            <br>

            <button type="submit">Donate</button>

            <p id="success-message" style="display: none; color: green;">Donated successfully!</p>
            <p id="errorMessage" style="color: red;"></p>
            
            <p>By donating, you agree to our <span class="blue">terms of services</span> and <span
                    class="blue">privacy policy</span></p>
        </form>
    </div>

</body>

</html>

<?php
// Close the database connection
$mysqli->close();
?>