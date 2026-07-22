<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false]);
    exit;
}

$fname   = strip_tags(trim($_POST['fname']    ?? ''));
$lname   = strip_tags(trim($_POST['lname']    ?? ''));
$email   = filter_var(trim($_POST['email']    ?? ''), FILTER_SANITIZE_EMAIL);
$company = strip_tags(trim($_POST['company']  ?? ''));
$service = strip_tags(trim($_POST['service']  ?? ''));
$budget  = strip_tags(trim($_POST['budget']   ?? ''));
$message = strip_tags(trim($_POST['message']  ?? ''));

if (empty($fname) || empty($lname) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    http_response_code(400);
    echo json_encode(['ok' => false]);
    exit;
}

$to      = 'info@yammtech.com';
$subject = "New Enquiry from $fname $lname";

$body  = "Name:    $fname $lname\n";
$body .= "Email:   $email\n";
$body .= "Company: $company\n";
$body .= "Service: $service\n";
$body .= "Budget:  $budget\n\n";
$body .= "Message:\n$message\n";

$headers  = "From: no-reply@yammtech.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

header('Content-Type: application/json');

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(['ok' => true]);
} else {
    http_response_code(500);
    echo json_encode(['ok' => false]);
}
