<?php

namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;


class Email {
  protected $email;
  protected $name;
  protected $token;

  public function __construct($email, $name, $token) {
    $this->email = $email;
    $this->name = $name;
    $this->token = $token;
  }

  public function sendConfirmation() {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['MAIL_PORT'];
    $mail->Username =   $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASS'];

    $mail->setFrom('account@tasuku.com');
    $mail->addAddress('account@tasuku.com', 'tasuku.com');
    $mail->Subject = 'Verify your account';
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';

    $content = '<html>';
    $content .= "<p>Hello, <strong>" . $this->name . " (" . $this->email . ").</strong></p>";
    $content .= "<p>Your account on Tasuku is correctly created. You only need to verify it in order to start using the features of this site.</p>";
    $content .= "<p>Click here: <a href='http://localhost:3000/verified?token=" . $this->token . "'>Verify account</a></p>";
    $content .= "<p>If you didn't create this account, you can ignore this message.</p>";
    $content .= '<html>';

    $mail->Body = $content;

    $mail->send();
  }

  public function sendInstructions() {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'f968e4f24d49b0';
    $mail->Password = 'a24c3fd23f02f1';

    $mail->setFrom('account@tasuku.com');
    $mail->addAddress('account@tasuku.com', 'tasuku.com');
    $mail->Subject = 'Recover your password';
    $mail->isHTML(TRUE);
    $mail->CharSet = 'UTF-8';

    $content = '<html>';
    $content .= "<p>Hello, <strong>" . $this->name . " (" . $this->email . ").</strong></p>";
    $content .= "<p>Seems that you forgot your password. Don't worry! Click on the link below to recover your password:</p>";
    $content .= "<p><a href='http://localhost:3000/restorepassword?token=" . $this->token . "'>Recover password</a></p>";
    $content .= "<p>If you didn't make this request, you can ignore this message.</p>";
    $content .= '<html>';

    $mail->Body = $content;

    $mail->send();
  }
}
