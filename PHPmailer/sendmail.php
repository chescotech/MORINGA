<?php

class email {

    function send_mail_old($email, $message, $subject) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->AddAddress($email);
        $mail->Username = "chescotechmail@gmail.com";
        $mail->Password = "aert@Ches_co@0202";
        $mail->SetFrom('chescotechmail@gmail.com', "Shaarz Cosmetics Limited");
        $mail->AddReplyTo('chescotechmail@gmail.com', "Shaarz Cosmetics Limited");
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function send_mail($email, $message, $subject, $companyName) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";                 
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        //$mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->AddAddress($email);
        $mail->Username = "chescotechmail@gmail.com";
        $mail->Password = "aert@Ches_co@0202";
        $mail->SetFrom('chescotechmail@gmail.com', $companyName);
        $mail->AddReplyTo('chescotechmail@gmail.com', $companyName);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

    function sendEmailWithAttachment($email, $message, $subject, $payslip) {
        require_once('mailer/class.phpmailer.php');
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        //$mail->SMTPSecure = "ssl";      
        //$mail->AddEmbeddedImage("logo.png", 1);
        $mail->IsHTML(true);
        $mail->AddAttachment($payslip);
        $mail->Host = "mail.crystaline.co.zm";
        $mail->Port = 25;
        $mail->AddAddress($email);
        $mail->Username = "payroll@crystaline.co.zm";
        $mail->Password = "payroll@978";
        $mail->SetFrom('payroll@crystaline.co.zm', $subject);
        $mail->AddReplyTo('payroll@crystaline.co.zm', $subject);
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }

}
?>

