<?php

$errors = [];

if (empty($_POST["name"])) {
    $errors[] = "Name is required";
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Valid email is required";
}

if (!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/", $_POST["password"])) {
    $errors[] = "Password must have at least one letter, at least one number, and there have to be 6-12 characters";
}

if ($_POST["password"] !== $_POST["pwd_confirmation"]) {
    $errors[] = "Password must match";
}

if (!empty($errors)) {
    // Display error message for 5 seconds before redirecting back to signup.html
    echo implode('<br>', $errors);
    echo "<script>setTimeout(function(){window.location.href='signup.html';}, 5000);</script>";
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
    header("Location: signup_success.html");
    exit;
} else {
    if ($mysqli->errno === 1062) {
        // Display email already taken message for 5 seconds before redirecting back to signup.html
        echo "Email already taken";
        echo "<script>setTimeout(function(){window.location.href='signup.html';}, 5000);</script>";
        exit;
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>
