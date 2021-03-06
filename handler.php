<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer-5.2.28/src/Exception.php';
require 'php/PHPMailer-5.2.28/src/PHPMailer.php';
require 'php/PHPMailer-5.2.28/src/SMTP.php';

$mail = new PHPMailer(true);
$mail_subject = 'Subject';
$mail_to_email = 'info@workanything.in'; // your email
$mail_to_name = 'Workanything';

try {

	$mail_from_name = isset( $_POST['name'] ) ? $_POST['name'] : '';
	$mail_from_email = isset( $_POST['email'] ) ? $_POST['email'] : '';
	$mail_subject = isset( $_POST['subject'] ) ? $_POST['subject'] : '';
	// $mail_file = isset( $_POST['file'] ) ? $_POST['file'] : '';
	$mail_message = isset( $_POST['message'] ) ? $_POST['message'] : '';

	// Server settings
	$mail->isSMTP(); // Send using SMTP
	$mail->Host = 'mail.privateemail.com'; // Set the SMTP server to send through
	$mail->SMTPAuth = true; // Enable SMTP authentication
	$mail->Username = 'info@workanything.in'; // SMTP username
	$mail->Password = '8!zW3)O3fUqwI2'; // SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	$mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	$mail->setFrom($mail_from_email, $mail_from_name); // Your email
	$mail->addAddress($mail_to_email, $mail_to_name); // Add a recipient

	// for($ct=0; $ct<count($_FILES['file_attach']['tmp_name']); $ct++) {
	// 	$mail->AddAttachment($_FILES['file_attach']['tmp_name'][$ct], $_FILES['file_attach']['name'][$ct]);
	// }

	// Content
	$mail->isHTML(true); // Set email format to HTML

	$mail->Subject = $mail_subject;
	$mail->Body = '
		<strong>Name:</strong> ' . $mail_from_name . '<br>
		<strong>Email:</strong> ' . $mail_from_email . '<br>
		<strong>Subject:</strong> ' . $mail_subject . '<br>
		<strong>File:</strong> ' . $mail_file . '<br>
		<strong>Message:</strong> ' . $mail_message;

	$mail->Send();

	echo 'Message has been sent';

} catch (Exception $e) {

	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

}