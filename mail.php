<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data safely
    $name          = isset($_POST['name']) ? trim($_POST['name']) : '';
    $company       = isset($_POST['company']) ? trim($_POST['company']) : '';
    $email         = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone         = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $practice_area = isset($_POST['practice_area']) ? trim($_POST['practice_area']) : '';
    $message       = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Validation
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        echo "<script>alert('Please fill all required fields.'); window.location.href=document.referrer;</script>";
        exit;
    }

    // Recipient email
    $to = "saji@spjlegal.com"; // <-- change to your email
    $subject = "New Contact Form Submission from Website";

    // Email Body
    $body = "
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; color: #333; }
            .container { padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
            h2 { color: #0066cc; }
            p { margin: 8px 0; font-size: 15px; }
            .label { font-weight: bold; color: #444; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>📩 New Contact Form Submission</h2>
            <p><span class='label'>Full Name:</span> {$name}</p>
            <p><span class='label'>Company/Organization:</span> {$company}</p>
            <p><span class='label'>Email Address:</span> {$email}</p>
            <p><span class='label'>Phone Number:</span> {$phone}</p>
            <p><span class='label'>Practice Area of Interest:</span> {$practice_area}</p>
            <p><span class='label'>Brief Description of Legal Matter:</span><br>" . nl2br($message) . "</p>
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
        echo "<script>alert('Something went wrong. Please try again later.'); window.location.href=document.referrer;</script>";
    }
} else {
    echo "Invalid request.";
}
?>
