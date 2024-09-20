<?php
// Assume you have a database connection
$mysqli = require __DIR__ . "/database.php";

// Check if transaction_id is provided
if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    // Delete the transaction from the database
    $delete_sql = "DELETE FROM transactions WHERE transaction_id = ?";
    $delete_stmt = $mysqli->prepare($delete_sql);
    $delete_stmt->bind_param("i", $transaction_id);

    if ($delete_stmt->execute()) {
        // Redirect back to the account page with success message
        header("Location: account.php?refund_success=1");
        exit;
    } else {
        // Redirect back to the account page with error message
        header("Location: account.php?refund_error=1");
        exit;
    }
} else {
    // Redirect back to the account page if transaction_id is not provided
    header("Location: account.php");
    exit;
}
?>
