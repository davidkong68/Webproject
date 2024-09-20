<?php

$mysqli = require __DIR__ . "/database.php";

// Using a prepared statement to prevent SQL injection
$stmt = $mysqli->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $_GET["email"]);
$stmt->execute();
$stmt->store_result();

$is_available = $stmt->num_rows === 0;

$stmt->close();

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);

?>