<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form input
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'labh.k2003@gmail.com';
        $mail->Password = 'moiwoyerqgmlcyio';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient settings
        $mail->setFrom('labh.k2003@gmail.com', 'Labh Dev');
        $mail->addAddress($email); // Add a recipient
        $mail->addReplyTo('info@example.com', 'Information');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        // Send email
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: demo.html");
    exit;
}
?>
