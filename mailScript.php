<?php
  session_start();

  $to       = "yourEmailAdress@yourDomain.com";
  $subject  = $_POST['subject'];
  $message  = $_POST['firstname']." ".$_POST['lastname']."\r\n".
              $_POST['mail']."\r\n".
              $_POST['message']."\r\n";
  $headers  = 'From: '.$_POST['mail']."\r\n".
              'Reply-To: '.$_POST['mail']."\r\n".
              'X-Mailer: PHP/'.phpversion();
  $errors   = [];
// Verification of fields
  if(!array_key_exists('lastname', $_POST) || empty($_POST['lastname'])) {
    $errors = "The lastname field is incorrect.";
  }
  if(!array_key_exists('firstname', $_POST) || empty($_POST['firstname'])) {
    $errors = "The firstname field is incorrect.";
  }
  if(!array_key_exists('subject', $_POST) || empty($_POST['subject'])) {
    $errors = "The subject field is incorrect.";
  }
  if(!array_key_exists('mail', $_POST) || empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    $errors = "The e-mail field is incorrect.";
  }
  if(!array_key_exists('message', $_POST) || empty($_POST['message'])) {
    $errors = "Your message is incorrect.";
  }
// If nothing is incorrect, the mail is send.
  if(empty($errors)) {
    mail($to,$subject,$message,$headers);
    session_destroy();
    session_start();
    $_SESSION['sucess']= "Your email have been sent";
    header('Location: mailForm.php');
  } else {
    $_SESSION['errors'] = $errors;
    header('Location: mailForm.php');
  }
?>
