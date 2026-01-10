<?php
// =========================
// RESSINIQ – Contact Form Mailer
// =========================

// CHANGE THIS EMAIL
$to = "ressiniq@gmail.com";   // <-- PUT YOUR EMAIL HERE

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
  http_response_code(403);
  echo "Forbidden";
  exit;
}

function clean($data) {
  return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$message = clean($_POST['message'] ?? '');

if (!$name || !$email || !$message || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Invalid input";
  exit;
}

$subject = "New Enquiry – RESSINIQ";

$body = "
New enquiry received:

Name: $name
Email: $email

Message:
$message
";

$headers = "From: RESSINIQ <no-reply@ressiniq.com>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

if (mail($to, $subject, $body, $headers)) {
  echo "success";
} else {
  http_response_code(500);
  echo "Mail failed";
}
