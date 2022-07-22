<?php

namespace App\Libraries;

class Email
{
    public static function send($from,$to,$subject,$message)
    {
        $config = Array(
            'protocol' => $_ENV['email.protocol'],
            'SMTPHost' => $_ENV['email.SMTPHost'],
            'SMTPPort' => $_ENV['email.SMTPPort'],
            'SMTPUser' => $_ENV['email.SMTPUser'],
            'SMTPPass' => $_ENV['email.SMTPPass'],
            'CRLF' => "\r\n",
            'newline' => "\r\n"
        );
        $html_view = view('email',$message);
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom($from, 'Your Name');
        $email->setTo($to);

        $email->setSubject($subject);
        // $email->setMessage($message);
        // $email->setAltMessage('<h1>This is the alternative message</h1>');
        $email->setMessage($html_view);
        $email->setHeader('Content-Type', 'text/html');
        $email->send();
    }
}
