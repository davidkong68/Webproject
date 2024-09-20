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
<html lang="=en">
<head>
    <link rel="stylesheet" href ="contactus.css">
    <link rel="icon" type="image/x-icon" href="lockpic.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Contact Us</title>
    <meta charset="utf=8">
    <meta name="viewpoint" content = "width= device-width, initial-scale= 1">

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
    
   
    <div id="contactform">
        <form onsubmit="event.preventDefault(); validateForm()">
            <br>
            <br>
            <br>
            <h1>Contact us</h1>
            <br>

            <div class="label1">
            <label for="name">Name: </label>
            <input type="text" id="name" placeholder="Enter your name">
            <small class="error"></small>
             </div>

             <div class="label1">
            <label for="email">Email: </label>
            <input type="text" id="email" placeholder="Enter your email">
            <small class="error"></small>
             </div>

             <div class="label1">
            <label for="message">Message: </label>
            <textarea id="message" placeholder="Message" row="6"></textarea>
            <small class="error"></small>
             </div>

            <div class="submitbutton">

                <input type="submit" value="Send">
                <p id="Success"></p>
                
            </div>
        </form>
        <br>



    </div>

    <script src="contactus.js"></script>
</body>
</html>

<?php
// Close the database connection
$mysqli->close();
?>