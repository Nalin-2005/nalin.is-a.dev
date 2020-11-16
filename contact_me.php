<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require_once 'mail/Exception.php';
    require_once 'mail/PHPMailer.php';
    require_once 'mail/SMTP.php';

    $mail = new PHPMailer(true);
    
    if(isset($_POST['send'])) {
        $Name = $_POST['name'];
        $Email = $_POST['email'];
        $PhoneNumber = $_POST['phone'];
        $CityCountry = $_POST['location'];
        $Message = $_POST['message'];

        if (empty($Name) || empty($Email) || empty($PhoneNumber) || empty($CityCountry) || empty($Message)) {
            header('location:contact.php?error');
        } else {
            try {
                //Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'mmulay27@gmail.com';                     // SMTP username
                $mail->Password   = '##Thi$h@st0be@R@nd0mP@ssword##';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            
                //Recipients
                $mail->setFrom('mmulay27@gmail.com', 'Mailer');
                $mail->addAddress('codewithchin@gmail.com', 'Receiver');     // Recipient
                
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Portfolio Message using Contact Form';
                $mail->Body    = "<b>From:</b> $Name <br> 
                                  <b>Email:</b> $Email <br> 
                                  <b>PhoneNumber:</b> $PhoneNumber <br> 
                                  <b>City, Country:</b> $CityCountry <br> 
                                  <b>Message:</b> $Message";
                    
                $mail->send();
                echo "<script type='text/JavaScript'>
                        alert('Thanks for contacting. Your message was sent successfully!');
                        </script>";
                header('location:contact.php?success');
            } catch (Exception $e) {
                echo "<script type='text/JavaScript'>
                        alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                        </script>";
            }
        }
    } else {
        header("location:contact.php");
    }
?>