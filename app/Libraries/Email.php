<?php

namespace App\Libraries;

use App\Models\UserModel;

class Email
// fitur triger ke google email
{
    public static function send($from, $to, $subject, $message)
    // terkirim ke email yang dituju, menggunakan akun email.
    {
        $config = array(
            'protocol' => $_ENV['email.protocol'],
            'SMTPHost' => $_ENV['email.SMTPHost'],
            'SMTPPort' => $_ENV['email.SMTPPort'],
            'SMTPUser' => $_ENV['email.SMTPUser'],
            'SMTPPass' => $_ENV['email.SMTPPass'],
            'SMTPCrypto' => $_ENV['email.SMTPCrypto'],
            'CRLF' => "\r\n",
            'newline' => "\r\n"
        );
        $html_view = view('email', $message);

        // $user = new UserModel();
        // $pic = $user->getUser($message['penanggung_jawab'],'no_employee');
        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom($from, $message['ses_nama']);
        $email->setTo($to);

        $email->setSubject($subject);
        // $email->setMessage($message);
        // $email->setAltMessage('<h1>This is the alternative message</h1>');
        $email->setMessage($html_view);
        $email->setHeader('Content-Type', 'text/html');
        $email->send();
    }
}
