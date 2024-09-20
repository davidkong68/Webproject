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
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>About us</title>
    <link rel='stylesheet' type="text/css" href="aboutus.css">

    <!-- box icons link -->
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

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


    <br>
    <br>
    <br>
    <h1>About Us</h1>

    <div class="home-img">
        <img src="images/eco house 5.jpg">
    </div>
      

    <p> WCH is a passionate non-profit organization dedicated to creating meaningful change in the lives of low-income individuals and families.
         Committed to the United Nations Sustainable Development Goal 11, we focus on building sustainable cities and communities.
        At the heart of our mission lies a profound commitment to making housing affordable for everyone, regardless of their income level.
    </p>
    <br>
    <br>
</body>

<?php
// Close the database connection
$mysqli->close();
?>