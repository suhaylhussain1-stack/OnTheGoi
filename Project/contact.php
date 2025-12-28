<?php
// contact.php - VERY simple mail sender.
// IMPORTANT: This is a basic example. Harden for production (sanitize inputs,
// validate email properly, add CSRF protections, use SMTP auth, etc.)

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
  header('Location: /');
  exit;
}

$to = 'info@brightwayremovals.co.uk'; // <-- change to your business email
$name = strip_tags(trim($_POST['name'] ?? ''));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = strip_tags(trim($_POST['phone'] ?? ''));
$from = strip_tags(trim($_POST['from'] ?? ''));
$to_loc = strip_tags(trim($_POST['to'] ?? ''));
$size = strip_tags(trim($_POST['size'] ?? ''));
$date = strip_tags(trim($_POST['date'] ?? ''));
$details = strip_tags(trim($_POST['details'] ?? ''));

$subject = "Website Quote Request from " . ($name ?: 'Website visitor');
$body = "Name: $name\nEmail: $email\nPhone: $phone\nFrom: $from\nTo: $to_loc\nSize: $size\nDate: $date\n\nDetails:\n$details\n";

$headers = "From: " . ($email ?: 'no-reply@'.$_SERVER['SERVER_NAME']) . "\r\n";
$headers .= "Reply-To: $email\r\n";

if($email && mail($to, $subject, $body, $headers)){
  // Redirect to a thank-you page (create thank-you.html) or back with success
  header('Location: /thank-you.html');
  exit;
} else {
  // Basic error handling (improve in production)
  header('Location: /?sent=0');
  exit;
}
?>
