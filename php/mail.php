<?php
require_once "Mail.php";



// $headers = array ('From' => $from,
// 'To' => $to,
// 'Subject' => $subject);
$smtp = Mail::factory('smtp',
array ('host' =>"smtp.google.com",
'auth' => true,
'username' => "$username@gmail.com",
'password' => "$password"));

// $mail = $smtp->send($to, $headers, $body);
// if (PEAR::isError($mail)) {
// echo("<p>" . $mail->getMessage() . "</p>");
// } else {
// echo("<p>Message successfully sent!</p>");
// }
?>