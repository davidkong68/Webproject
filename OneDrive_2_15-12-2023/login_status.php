<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    // User is logged in
    $user_name = htmlspecialchars($_SESSION["user_name"]);
    $logout_link = '<li><a href="logout.php">Logout</a></li>';
} else {
    // User is not logged in
    $user_name = "";
    $logout_link = "";
}
?>