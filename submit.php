<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "Error: All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit;
    }

    // Email parameters
    $to = "aportilloworks@gmail.com"; // Replace with your email
    $subject = "New Contact Form Submission";
    $emailBody = "You have received a new message:\n\n";
    $emailBody .= "Name: $name\n";
    $emailBody .= "Email: $email\n\n";
    $emailBody .= "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $emailBody, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: Unable to send the message. Please try again later.";
    }
} else {
    echo "Error: Invalid request.";
}
?>
