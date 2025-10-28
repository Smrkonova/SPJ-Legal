<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name    = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone   = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "<script>alert('Please fill all required fields.'); window.history.back();</script>";
        exit;
    }

    // Recipient email
    $to = "ssuryareddy2277@gmail.com"; // <-- change to your email
    $subject = "New Internship Form Submission from Website";


    // Email body (HTML)
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; }
            .container { padding: 20px; border: 1px solid #ddd; border-radius: 8px; background: #f9f9f9; }
            h2 { color: #0066cc; }
            p { margin: 8px 0; font-size: 15px; }
            .label { font-weight: bold; color: #444; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>📩 New Contact Form Submission</h2>
            <p><span class='label'>Full Name:</span> {$name}</p>
            <p><span class='label'>Email Address:</span> {$email}</p>
            <p><span class='label'>Phone Number:</span> {$phone}</p>
            <p><span class='label'>Message:</span><br>" . nl2br($message) . "</p>
        </div>
    </body>
    </html>
    ";

    // Headers
    $headers  = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: {$email}\r\n";
    $headers .= "Reply-To: {$email}\r\n";

    // Send mail
    if (mail($to, $subject, $body, $headers)) {
        header("Location: thank-you.html");
        exit;
    } else {
        echo "<script>alert('Something went wrong. Please try again later.'); window.history.back();</script>";
    }
} else {
    echo "Invalid request.";
}
?>
