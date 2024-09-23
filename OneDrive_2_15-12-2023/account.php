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

// Retrieve transaction history from the database
$transactionSql = "SELECT * FROM transactions WHERE user_id = ?";
$transactionStmt = $mysqli->prepare($transactionSql);
$transactionStmt->bind_param("i", $user_id);
$transactionStmt->execute();
$transactionResult = $transactionStmt->get_result();
$transactions = $transactionResult->fetch_all(MYSQLI_ASSOC);

// Check if the user is an admin
$isAdmin = $user['role'] === 'admin';

// Handle form submission for updating the name
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_name"])) {
    $newName = $_POST["new_name"];

    // Update the user name in the database using prepared statements
    $updateNameSql = "UPDATE user SET name = ? WHERE id = ?";
    $updateNameStmt = $mysqli->prepare($updateNameSql);
    $updateNameStmt->bind_param("si", $newName, $user_id);
    $updateNameStmt->execute();

    // Redirect back to the account page after updating
    header("Location: account.php?success=1");
    exit;
    }

// Handle form submission for updating the password
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update_password"])) {
    $newPassword = $_POST["new_password"];
  

    // Update the user password in the database using prepared statements
    $updatePasswordSql = "UPDATE user SET password_hash = ? WHERE id = ?";
    $updatePasswordStmt = $mysqli->prepare($updatePasswordSql);
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    $updatePasswordStmt->bind_param("si", $hashedPassword, $user_id);
    $updatePasswordStmt->execute();

    // Redirect back to the account page after updating
    header("Location: account.php?success=1");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="account.css">

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

    <section class="account">

        <h1>Account</h1>

        <?php if (isset($_GET["success"]) && $_GET["success"] == 1): ?>
            <p>Details updated successfully!</p>
        <?php endif; ?>

        <!-- Update Name Form -->
        <form method="post">
            <label for="new_name">New Name:</label>
            <input type="text" id="new_name" name="new_name" value="<?= htmlspecialchars($user["name"]) ?>">
            <button type="submit" name="update_name">Update Name</button>
        </form>

        <!-- Update Password Form -->
        <form method="post">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password">
            <button type="submit" name="update_password">Update Password</button>
        </form>

        <section class="transaction-history">
            <h2>Transaction History</h2>
            <?php if (!empty($transactions)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Donation Amount</th>
                            <th>Payment Type</th>
                            <th>Date Donate</th>
                            <?php if ($isAdmin): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction): ?>
                            <tr>
                                <td><?= $transaction['transaction_id'] ?></td>
                                <td><?= $transaction['amount'] ?></td>
                                <td><?= $transaction['payment_type'] ?></td>
                                <td><?= $transaction['date_donated'] ?></td>
                                <?php if ($isAdmin): ?>
                                    <td><a href="refund.php?transaction_id=<?= $transaction['transaction_id'] ?>">Refund</a></td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No transaction history available.</p>
            <?php endif; ?>
        </section>
    </section>
</body>
</html>


