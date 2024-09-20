<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $amount = $_POST["amount"];
    $paymentType = $_POST["paymentType"];

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($amount)) {
        echo json_encode(["error" => "Please fill in all the fields."]);
        exit;
    }

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["error" => "Please enter a valid email address."]);
        exit;
    }

    // Validate the amount is a positive integer
    if (!ctype_digit($amount) || $amount <= 0) {
        echo json_encode(["error" => "Please enter a valid positive integer amount."]);
        echo "<script>setTimeout(function(){window.history.back();}, 5000);</script>";
        exit;
    }

    // Insert data into the database
    $query = "INSERT INTO transactions (name, email, amount, payment_type, date_donated) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssis", $name, $email, $amount, $paymentType);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo json_encode("Donated successfully!");

        // Redirect back to the previous page after 5 seconds
        echo "<script>setTimeout(function(){window.history.back();}, 5000);</script>";
        exit;
    } else {
        echo json_encode(["error" => "Failed to donate. Please try again."]);
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>


