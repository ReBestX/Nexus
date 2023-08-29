<?php
include "db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        $username = $row['user_username'];
        $token = bin2hex(openssl_random_pseudo_bytes(50));
        $sql2 = "UPDATE users SET token = '$token' WHERE user_email = '$email'";
        $result2 = mysqli_query($connection, $sql2);

        //Load Composer's autoloader
        require '../vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io'; //Set the SMTP server to send through (Update this)
            $mail->SMTPAuth = true; //Enable SMTP authentication
            $mail->Username = '9e8636b2cc1f09'; //SMTP username (Update this)
            $mail->Password = '92b092b6210de7'; //SMTP password (Update this)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
            $mail->Port = 2525; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // if you're using SSL
            $mail->SMTPSecure = 'ssl';
            // OR use TLS
            $mail->SMTPSecure = 'tls';

            //Recipients
            $mail->setFrom('admin@Nexus.com', 'Nexus');
            $mail->addAddress($email, $username); //Add a recipient
            $mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('cc@example.com');
            $mail->addBCC('bcc@example.com');

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Reset Password';
            $mail->Body = '
            <html>
            <head>
                <title>Reset Password</title>
            </head>
            <body style="font-family: Arial, sans-serif; background-color: #f2f2f2; text-align: center; padding: 20px;">
                <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 10px; padding: 20px;">
                    <h1 style="color: #007BFF;">Reset Your Password</h1>
                    <p style="font-size: 16px;">Hi ' . $username . ',</p>
                    <p style="font-size: 16px;">Click the link below to reset your password:</p>
                    <p style="font-size: 16px;"><a href="http://localhost:8080/Nexus%20Project/dist/SetNewPassword/' . $token . '">Reset Password</a></p>
                    <p style="font-size: 16px;">If you didn\'t request a password reset, you can ignore this email.</p>
                    <p style="font-size: 16px;">Thank you!</p>
                    <p style="font-size: 16px;">Nexus Team</p>
                </div>
            </body>
            </html>
            ';
            $mail->SMTPDebug = false;
            $mail->send();

            // Redirect the user after sending the email
            header("Location: ../dist/Forget_Password/success");
            exit(); // Terminate the script immediately after the redirect

        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: ../dist/Forget_Password/error2");
            exit(); // Terminate the script immediately after the redirect
        }
    } else {
        header("Location: ../dist/Forget_Password/error");
        exit(); // Terminate the script immediately after the redirect
    }
}
?>
