<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 1;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'aravindancadet@gmail.com';                 // SMTP username
            $mail->Password = '311199818wow';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('aravindancadet@gmail.com', 'Bus System');
            // $mail->addAddress($_POST['collegeemail']);     // Add a recipient
            // $mail->addAddress('aravindancadet@gmail.com');
            $data = json_decode(stripslashes($_POST['collegeemail']));
                foreach ($data as $key) {
                    // echo $key;
                    $mail->addAddress($key);
                };
            // foreach (($_POST['collegeemail']) as $emailrow) {
            //     $mail->addAddress($emailrow['user_email']);
            // }
            // $mail->addAddress('aravindannichu007@gmail.com');
            // $mail->addAddress('aravindannatarajan31@gmail.com');
            // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('aravindancadet@gmail.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Bus Route Changes';
            $mail->Body    = 'Your Bus Route has been changed for the date '.$_POST['changed_date'];
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // print_r($_POST['collegeemail']);
                
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }