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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" type="text/css" href="homepage.css">

    <!-- box icons link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <!-- google fonts link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<body>
    <!--header-->
    <header>
      <a href="homepage.php" class="logo">
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

    <!--home section-->
    <section class="home">
      <div class = "home-text">
          <h1>Discover Your Dream Home Where Comfort and Dreams Unite</h1>
          <!--<p>Where Comfort and Dreams Unite</p>-->

          <div class="h-search">
          </div>
      </div>

      <div class="home-img">
        <img src="images/house11.jpg">
      </div>
    </section>

    <!--property section-->
    <section class="property">
      <div class="center-left">
        <h2>Popular Eco-house</h2>
      </div>
      <div class="property-content">
        <div class="row">
            <img src="images/eco-house.jpg">
            <h3>Luettgenton House</h3>
            <p> Abbott Courts, East Titusburgh, WV 43916</p>
            <div class="list">
              <a href="#" class="Residence-list">
                <i class='bx bx-bed' ></i>
                4 Bed
              </a>

              <a href="#" class="Residence-list">
                <i class='bx bx-bath' ></i>
                2 Bath
              </a>

              <a href="#" class="Residence-list">
                <i class='bx bx-shape-square'></i>
                1200 sqft
              </a>
            </div>
        </div>

        <div class="row">
          <img src="images/house3.png">
          <h3>Jaymeshire house</h3>
          <p>Maryjo Plain, North Arturo, NH 32900</p>
          <div class="list">
            <a href="#" class="Residence-list">
              <i class='bx bx-bed' ></i>
              4 Bed
            </a>

            <a href="#" class="Residence-list">
              <i class='bx bx-bath' ></i>
              3 Bath
            </a>

            <a href="#" class="Residence-list">
              <i class='bx bx-shape-square'></i>
              2200 sqft
            </a>
          </div>
      </div>

      <div class="row">
        <img src="images/eco-house7.webp">
        <h3>Villa house</h3>
        <p>Dion Summit, West Alexfort, VT 66823</p>
        <div class="list">
          <a href="#" class="Residence-list">
            <i class='bx bx-bed' ></i>
            5 Bed
          </a>

          <a href="#" class="Residence-list">
            <i class='bx bx-bath' ></i>
            4 Bath
          </a>

          <a href="#" class="Residence-list">
            <i class='bx bx-shape-square'></i>
            2500 sqft
          </a>
        </div>
      </div>



      </div>

      <div class="center-btn">
        <a href="properties.html" class="btn">View All Properties</a>
      </div>
    </section>

    <!--js file-->
    <script src="js/script.js"></script>

    <div class="Blogpost">
      <h2>Blog post</h2>
    </div>

    <div class="row">
      <div class="leftcolumn">
        <div class="card">
          <h5>What is an eco-friendly house, 9 DEC 2023</h5>
          <!--<div class="fakeimg" style="height:200px;">Image</div>-->
          <a href="https://strata.co.uk/homes/advice/sustainable-living/what-is-an-eco-friendly-house/" target="_blank"><img src="images/eco-house 2.jpg" alt="image" class="imagenews"> </a>
          <div class="word"><h4>
            Eco-friendly homes are built to help protect our planet by using special features like good insulation and renewable energy sources such as solar panels. They save energy, cut bills, 
            and often use reclaimed wood and smart technology to reduce waste and make living more comfortable while being kinder to the environment. With unique designs and technology, these homes make
             it easier for us to live greener lives.
            </h4></div>
        </div>

        <div class="card">
          <h5>What will eco-friendly homes look like in the future, 27 Aug 2021</h5>
          <!--<div class="fakeimg" style="height:200px;">Image</div>-->
          <a href="https://www.theguardian.com/environment/2021/aug/27/what-will-our-eco-friendly-homes-of-the-future-look-like" target="_blank"><img src="images/eco-house 3.jpg" alt="image" class="imagenews"> </a>
          <div class="word2"><h4>
            Experts from the Centre for Alternative Technology provided insight into the future of environmentally friendly homes. These homes are designed to efficiently absorb both heat
            and light from the sun by utilizing innovative designs. </h4></div>
        </div>
      </div>
    </div>
</body>


</html>

<?php
// Close the database connection
$mysqli->close();
?>