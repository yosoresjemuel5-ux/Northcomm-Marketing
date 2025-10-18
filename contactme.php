<?php   
    require("./mailing/mailfunction.php");

    // Basic sanitization and validation
    $name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
    $phone = isset($_POST['phone']) ? preg_replace('/[^0-9\+\-\s]/', '', $_POST['phone']) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if(empty($name) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo '<center><h1>Invalid input. Please provide a valid name and email.</h1></center>';
        exit;
    }

    $body = "<ul>".
            "<li>Name: ".htmlspecialchars($name)."</li>".
            "<li>Phone: ".htmlspecialchars($phone)."</li>".
            "<li>Email: ".htmlspecialchars($email)."</li>".
            "<li>Message: ".nl2br($message)."</li>".
            "</ul>";

    // Replace empty receiver with configured recipient if needed
    $receiverEmail = getenv('MAIL_RECIPIENT_EMAIL') ?: '';
    if(empty($receiverEmail)){
        // If no recipient configured, respond with an error instead of sending
        echo '<center><h1>Message received. Admin contact not configured.</h1></center>';
        exit;
    }

    $status = mailfunction($receiverEmail, "Company", $body);
    if($status)
        echo '<center><h1>Thanks! We will contact you soon.</h1></center>';
    else
        echo '<center><h1>Error sending message! Please try again later.</h1></center>';
?>