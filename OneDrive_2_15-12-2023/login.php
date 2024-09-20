<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: homepage.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' type="text/css" href="signup_login.css">
    

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
      <a href="index.html" class="logo">
        <img src="images/logo.png" alt="logo">
      </a>
    

      <ul class="navbar">
        <li><a href="index.html">Home</a></li>
        <li><a href="properties.html">Properties</a></li>
        <li><a href="Donation.html">Donation</a></li>
        <li><a href="contactus.html">Contact us</a></li>
        <li><a href="aboutus.html">About us</a></li>
      </ul>

      <div class="h-btn">
        <a href="login.php" class="h-btn1">Login</a>
        <a href="signup.html" class="h-btn2">Sign up</a>
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>

    </header>

    <section class="login">
    
        <h1>Login</h1>
        
        <?php if ($is_invalid): ?>
            <em>Invalid login</em>
        <?php endif; ?>
        
        <form method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            
            <button>Log in</button>
        </form>

    </section>
    
</body>
</html>







