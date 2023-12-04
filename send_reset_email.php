<?php
// Database connection parameters
$host = "localhost"; // database host
$username = "root"; // database username
$password = ""; // database password
$database = "dis_db"; // database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include Composer autoloader for PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Check if the email exists in the database
    $check_email_sql = "SELECT * FROM login WHERE email = '$email'";
    $result = $conn->query($check_email_sql);
    
    if ($result->num_rows > 0) {
        // The email exists in the database, send the reset email

        // Send the email with the reset link
        $mail = new PHPMailer(true);

        try {
            // Configure your mailer here
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'd.o.omollo007@gmail.com'; // Your SMTP username
            $mail->Password = 'jglk bewc uctw docz'; // Your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Encryption type (can be STARTTLS or SSL)
            $mail->Port = 587; // SMTP port (use 587 for STARTTLS or 465 for SSL)
            $mail->setFrom('d.o.omollo007@gmail.com', 'reset_password'); // Sender information
            $mail->addAddress($email); // Recipient's email

            $mail->isHTML(true); // Enable HTML emails
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "To reset your password, click the following link: <a href='localhost/DIST/new_password.html'>Reset Password</a>";

            $mail->send();

            // Email sent successfully
            echo '<script>alert("Email sent to your email address.");</script>';
            echo '<script>window.location.href = "forgot_password.html";</script>';
        } catch (Exception $e) {
            // Handle any exceptions thrown by PHPMailer
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    } else {
        // The email doesn't exist in the database, provide an error message
        echo '<script>alert("Email does not exist in our database.");</script>';
        echo '<script>window.location.href = "forgot_password.html";</script>';
    }
}

// Close the database connection
$conn->close();
?>
