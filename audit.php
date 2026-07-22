<?php
header('Content-Type: application/json');

$to      = 'info@yammtech.com';
$name    = isset($_POST['name'])    ? trim(strip_tags($_POST['name']))    : '';
$email   = isset($_POST['email'])   ? trim(strip_tags($_POST['email']))   : '';
$website = isset($_POST['website']) ? trim(strip_tags($_POST['website'])) : '';

if (!$name || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'error' => 'Invalid input']);
    exit;
}

$subject = "Free Website Audit Request from $name";
$body    = "Name: $name\nEmail: $email\nWebsite: $website";
$headers = "From: noreply@yammtech.com\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

$sent = mail($to, $subject, $body, $headers);
echo json_encode(['ok' => (bool)$sent]);
