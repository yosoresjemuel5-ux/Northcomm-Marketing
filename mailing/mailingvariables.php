<?php
// Mailing configuration - read from environment variables where possible.
// Do NOT commit real credentials to source control. Use the example file
// `mailingvariables.example.php` as a template and add this file to .gitignore.

    $mail_host = getenv('MAIL_HOST') ?: 'smtp.gmail.com';
    $mail_port = getenv('MAIL_PORT') ?: '587';
    // Sender credentials should be set as environment variables on the server
    // MAIL_SENDER_EMAIL and MAIL_SENDER_PASSWORD
    $mail_sender_email = getenv('MAIL_SENDER_EMAIL') ?: '';
    $mail_sender_password = getenv('MAIL_SENDER_PASSWORD') ?: '';
    $mail_sender_name = getenv('MAIL_SENDER_NAME') ?: 'Website Form';

?>