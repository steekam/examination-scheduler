<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('send_email'))
{
     /**
     * @param Array $settings an associative array with email data
     * 
     * @return Boolean TRUE | FALSE whether email is sent
     */
        function send_email($settings = array()){

            $mail = new PHPMailer;
            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'stepwany8@gmail.com';   // SMTP username
            $mail->Password = 'REStaTiOnsCuSeB';        // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail-> setFrom("noreply@examscheduler.com", "Exam Scheduler"); 

            $mail->addAddress($settings['to']);   
            $mail->Subject = $settings['subject'];
            $mail->Body    = $settings['body'];

            $mail->IsHTML(true);

            return $mail->send();
        }
}