<html>
  <head>
    <title>Alien Abducted Me - Report an Abduction</title>
  </head>
  <body>
    <h2>Aliens Abducted Me - Report an Abduction</h2>

      <?php
        $name = $_POST['firstname'];
        $when_it_hppened = $_POST['other'];
        $when_it_hppened = $_POST['whenithappened'];
        $how_long = $_POST['howlong'];
        $how_many = $_POST['howmany'];
        $alien_description = $_POST['aliendescription'];
        $what_they_did = $_POST['whattheydid'];
        $fang_spotted = $_POST['fangspotted'];
        $other = $_POST['other'];
        $email = $_POST['email'];

        $dbc = mysqli_connect('localhost', 'uroot', 'student', 'srevin')
        or die('Error connecting to MySQL server.');

        $to = 'stanrevin@yahoo.com';
        $subject = 'Aliens Abducted Me - Abduction Report';
        $message = "$name was abducted s$when_it_hppened and was gone for $how_long.\n" .
                "Number of aliens: $how_many\n" .
                "Alien description: $alien_description\n";
                "What they did: $what_they_did\n" .
                "Fang spotted: $fang_spotted\n" .
                "Other comments: $other";

        $host = "smtp.mail.yahoo.com";
        $username = "stanrevin@yahoo.com";
        $password = "fOr?356rest9294";
        $SMTPAuthorization = true;
        $SMTPSecure = "ssl";
        $Port = 465;

        require_once('/opt/lampp/lib/php/class.phpmailer.php');
        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "smtp.mail.yahoo.com\"";
        $mail->Port = 465;
        $mail->Username = "stanrevin@yahoo.com;
        $mail->Password = 'fOr?356rest9294';

        $mail->SetFrom('@email', 'Web App');
        $mail->Subject = $subject";
        $mail->MsgHTML($message);
        $mail->AddAddress($to, $name);


        if($mail->Send()) {
            echo "Message sent!";
        } else {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }


        echo 'Thanks for submitting the form. <br/>';
        echo 'You were abducted ' . $when_it_hppened . '<br/>';
        echo ' and you were gone for ' . $how_long . '<br/>';
        echo 'Describe them: ' . $alien_description . '<br/>';
        echo 'Was Fang there? ' . $fang_spotted . '<br/>';
        echo 'Your email address is ' . $email;


      ?>
  </body>
</html>\