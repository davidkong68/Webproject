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
    <title>Homepage</title>
    <link rel='stylesheet' type="text/css" href="properties.css">

    <!-- box icons link -->
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

</head>

<body>
    <!--header-->
    <header>
      <a href="homepage.html" class="logo">
        <img src="images/logo.png" alt="logo">
      </a>
    

      <ul class="navbar">
        <li><a href="homepage.php">Home</a></li>
        <li><a href="properties.php">Properties</a></li>
        <li><a href="donation.php">Donation</a></li>
        <li><a href="leaderboard.php">Leaderboard</a>
        <li><a href="contactus.php">Contact us</a>
        <li><a href="aboutus.php">About us</a></li>
      </ul>

      <div class="h-btn">
        <a href="account.php" class="h-btn1"><?= htmlspecialchars($user["name"]) ?></a>
        <a href="logout.php" class="h-btn2">Log Out</a>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>

    </header>
    <h1>Properties</h1>
   
    <div class="row">
      <div class="leftcolumn">
        <div class="card">
          <!--<div class="fakeimg" style="height:200px;">Image</div>-->
          <img src="images/eco-house 2.jpg" alt="image" class="imagenews1"> 
          <div class="word"><h4>
            This eco-conscious home embraces sustainable design, utilizing natural materials, solar energy, and smart technology to minimize its environmental impact. Its thoughtful construction and eco-friendly features not only create a harmonious relationship with nature but also reduce energy consumption, promote a healthier indoor environment, conserve water, and inspire sustainable living practices. This house stands as a prime example of how modern comfort and eco-consciousness can coexist, offering a blueprint for a more sustainable and environmentally friendly way of living.
            </h4></div>
            <div class="heading11"><h4>
               Marshville house
              </h4></div>
        </div>

        <div class="card">
          <!--<div class="fakeimg" style="height:200px;">Image</div>-->
          <img src="images/eco-house 3.jpg" alt="image" class="imagenews"> </a>
          <div class="word2"><h4>
            Parril home, built entirely from eco-friendly materials like reclaimed wood and recycled steel, showcases a commitment to the environment. Its solar panel-equipped roof generates renewable energy, reducing reliance on non-renewable sources and cutting down on electricity bills. The house promotes a healthier indoor environment with non-toxic materials while offering a comfortable and stylish living space, demonstrating that modern comfort and sustainability go hand in hand. </h4></div>
        </div>
        <div class="heading12"><h4>
           Parril house
         </h4></div>

        <div class="card">
          <!--<div class="fakeimg" style="height:200px;">Image</div>-->
          <img src="images/eco-house4.jpeg" alt="image" class="imagenews"> </a>
          <div class="word3"><h4>
            This eco-conscious villa house is an emblem of sustainability, clad in recycled materials like reclaimed wood and utilizing solar panels atop the roof. Beyond powering the residence, these panels also generate surplus energy stored in high-capacity batteries specifically designed to charge electric cars. This thoughtful integration not only reduces the home's carbon footprint by relying on renewable energy but also promotes eco-friendly transportation. </h4></div>
        </div>
        <div class="heading13"><h4>
          Villa house
         </h4></div>
      </div>
    </div>
</body>
</html>