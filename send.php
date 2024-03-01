<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Function to generate a unique ID
// Function to generate a unique ID
function generateUID() {
    return uniqid() . '_' . time();
}


// Function to log email sending
function logEmail($uid, $recipient, $status, $errorMessage = null) {
    // Database connection details
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phplogin';

    $conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind SQL statement
    $stmt = $conn->prepare("INSERT INTO email_logs (id, recipient_email, sent_datetime, status, error_message) VALUES (?, ?, NOW(), ?, ?)");
    $stmt->bind_param("ssss", $uid, $recipient, $status, $errorMessage);

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form input
    $sendingType = $_POST["sending_type"];
    $fromEmail = $_POST["from_email"];
    $fromName = $_POST["from_name"];
    $subject = $_POST["subject"];
    $testEmail = $_POST["test_email"];
    $contentType = $_POST["content_type"];
    $contentEncoding = $_POST["content_encoding"];
    $characterEncoding = $_POST["character_encoding"];
    $dataFile = $_POST["data_file"];
    $count = $_POST["count"];
    $emailBody = $_POST["email_body"];

    // Read data file
    $emails = file("emails-folder/$dataFile", FILE_IGNORE_NEW_LINES);

    // Slice the first $count emails
    $emailsToSend = array_slice($emails, 0, $count);

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'labh.k2003@gmail.com'; // Update with your email
        $mail->Password = 'moiwoyerqgmlcyio'; // Update with your password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender settings
        $mail->setFrom($fromEmail, $fromName);

        // Content
        $mail->isHTML($contentType == 'html');
        $mail->Subject = $subject;
        $mail->Body = $emailBody;

        // Send test email
        $mail->addAddress($testEmail);
        $mail->send();
        

        // If sending type is bulk, send emails to the first $count recipients
        if ($sendingType == "bulk") {
            // Update data file with remaining emails
            $remainingEmails = array_slice($emails, $count);
            file_put_contents("emails-folder/$dataFile", implode("\n", $remainingEmails));

            foreach ($emailsToSend as $email) {
                // Generate unique ID
                $uid = mt_rand(100000, 999999) . '_' . time();;
                // Add recipient
                $mail->addAddress($email);

                // Send email
                $mail->send();

                // Log the email with unique ID
                logEmail($uid, $email, "Sent");

                // Clear recipients for next email
                $mail->ClearAddresses();
            }

            echo 'Message has been sent to test email and first ' . $count . ' emails.';
            header("Location: logs.php");
        } else {
            echo 'Message has been sent to test email only.';
        }
    } catch (Exception $e) {
        // Log the error
        logEmail(generateUID(), $testEmail, "Failed", $mail->ErrorInfo);
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirect to the form page if accessed directly
    header("Location: index.html");
    exit;
}
?>
