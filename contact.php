<?php
header('Content-Type: application/json');

$to   = 'info@yammtech.com';
$name = isset($_POST['name'])    ? trim(strip_tags($_POST['name']))    : '';
$email= isset($_POST['email'])   ? trim(strip_tags($_POST['email']))   : '';
$co   = isset($_POST['company']) ? trim(strip_tags($_POST['company'])) : '';
$msg  = isset($_POST['message']) ? trim(strip_tags($_POST['message'])) : '';

if (!$name || !$email || !$msg || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['ok' => false, 'error' => 'Invalid input']);
    exit;
}

$subject = "New Contact Form Submission from $name";
$body    = "Name: $name\nEmail: $email\nCompany: $co\n\nMessage:\n$msg";
$headers = "From: noreply@yammtech.com\r\nReply-To: $email\r\nX-Mailer: PHP/" . phpversion();

$sent = mail($to, $subject, $body, $headers);
echo json_encode(['ok' => (bool)$sent]);
