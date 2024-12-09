<?php

// Set the email address where the form submissions will be sent
$receiving_email_address = 'contact@example.com'; // Replace with your actual email address

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from POST
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    
    // Check if all required fields are filled
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        // Set the email headers
        $headers = "From: " . $name . " <" . $email . ">\r\n";
        $headers .= "Reply-To: " . $email . "\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
        
        // Prepare the email body
        $email_body = "Name: " . $name . "\n";
        $email_body .= "Email: " . $email . "\n";
        $email_body .= "Subject: " . $subject . "\n";
        $email_body .= "Message:\n" . $message . "\n";
        
        // Send the email
        if (mail($receiving_email_address, $subject, $email_body, $headers)) {
            echo 'Your message has been sent. Thank you!';
        } else {
            echo 'Sorry, there was an error sending your message. Please try again later.';
        }
    } else {
        echo 'Please fill out all required fields.';
    }
}
?>
