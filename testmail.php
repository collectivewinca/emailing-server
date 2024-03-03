<?php

function sendemails($to, $from, $subject, $message, $headers) {
    $to = trim($to);
    $from = trim($from);
    $subject = trim($subject);
    $message = trim($message);
    $headers = trim($headers);

    if ($smtp = fsockopen("127.0.0.1", 2525)) {
        fputs($smtp, "helo \r\n");
        $line = fgets($smtp, 1024);
        fputs($smtp, "mail from: $from\r\n");
        $line = fgets($smtp, 1024);
        fputs($smtp, "rcpt to: $to\r\n");
        $line = fgets($smtp, 1024);
        fputs($smtp, "data\r\n");
        $line = fgets($smtp, 1024);
        fputs($smtp, "$headers\r\n"); 
        fputs($smtp, "$message\r\n");
        fputs($smtp, ".\r\n");

        $line = fgets($smtp, 1024);
        fputs($smtp, "QUIT\r\n");
        fclose($smtp);  
        return 1;    
    } else {
        return 0;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $to = $_POST["eto"];
    $from = $_POST["efrom"];
    $subject = $_POST["esubject"];
    $message = $_POST["htmlcode"];
    $headers = $_POST["headerstext"];

    // Call sendemails function
    $result = sendemails($to, $from, $subject, $message, $headers);

    if ($result) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email!";
    }
}




?>