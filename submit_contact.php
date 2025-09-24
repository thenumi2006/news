<?php
include 'include/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);
    $submitted_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO contact_messages (name, email, message, submitted_at)
            VALUES ('$name', '$email', '$message', '$submitted_at')";

    if ($conn->query($sql) === TRUE) {
        header("Location: contact.php?status=success");
    } else {
        
        header("Location: contact.php?status=error");
    }
    exit;
} else {
    header("Location: contact.php");
    exit;
}
?>
