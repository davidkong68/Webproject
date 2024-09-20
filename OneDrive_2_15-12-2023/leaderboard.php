<?php
session_start();

// Check if the user is logged in, if not, redirect to the home page
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit;
}

include 'database.php';

// Fetch the user details from the database
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch the top 3 donors with their names
$query = "SELECT name, SUM(amount) AS total_amount 
          FROM transactions
          GROUP BY email 
          ORDER BY total_amount DESC 
          LIMIT 3";
$result = $mysqli->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="leaderboard.css">

    <!-- box icons link -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

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
            <li><a href="contactus.php">Contact us</a>
            <li><a href="aboutus.php">About us</a></li>
        </ul>

        <div class="h-btn">
            <a href="account.php" class="h-btn1"><?= htmlspecialchars($user["name"]) ?></a>
            <a href="logout.php" class="h-btn2">Log Out</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    
    </header>

    <div class="leaderboard">
        <h1>Leaderboard</h1>

        <?php if ($result) : ?>
            <ol>
                <?php
                $rank = 1;
                while ($row = $result->fetch_assoc()) :
                    $name = $row['name'];
                    $totalAmount = $row['total_amount'];
                ?>
                    <li>
                        <span class="rank"><?= $rank ?></span>
                        <span class="player"><?= $name ?></span>
                        <span class="score"><?= $totalAmount ?></span>
                    </li>
                <?php
                    $rank++;
                endwhile;
                ?>
            </ol>
        <?php else : ?>
            <p>Error fetching leaderboard.</p>
        <?php endif; ?>

        <br>
        <br>
        <h1>Top 1 donantor will able to get eye-catching rewards!!!</h1>
        <br>
        <br>
        <p>Every 6 months top 1 donators will able to get rewards like PS5 or even an iPhone. The more you donate, the greater the chances of getting valuable items available on our website. Stay tuned for updates.</p>
    </div>

</body>

</html>

<?php
// Close the database connection
$mysqli->close();
?>
