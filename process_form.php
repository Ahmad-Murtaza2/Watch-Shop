<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    
    $pdo = new PDO("mysql:host=localhost;dbname=watchshop", "your_username", "your_password");

    try {
        $stmt = $pdo->prepare("INSERT INTO contact_form_data (name, email, message) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $message]);

        // Set a success message in the session
        $_SESSION['success_message'] = "Message successfully sent!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null; // Close the database connection
}

// Redirect back to the contactus.php page with success status
header('Location: ./contactus.php?status=success');
?>
