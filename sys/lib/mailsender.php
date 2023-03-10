<?php

namespace sys\lib;


class Mailsender
{
    public $to;
    public $from;
    public $subject;
    public $message;
    public $header;

    public function __construct($to)
    {
        $this->to = $to;
        $this->from = 'Remote app Admin: @gmail.com';
        $this->subject = 'Confirmation';
        $this->message = $this->create_message();
        $this->header = $this->create_header();
    }


    private function create_message()
    {
        $html = "<html>
                    <body>
                        <h4>Confirmation</h4>
                        <a href='http://localhost/mvc/distant-app0/authentication/confirm/'
                            $this->to'>press me</a>
                    </body>
                </html>";
    }

    private function create_header()
    {
        return "MIME-Version: 1.0\r\n
                Content-type: text/html; charset=utf-8\r\n
                From: $this->from\r\n";
    }

    public function send()
    {
        mail($this->to, $this->subject, $this->message, $this->header);
    }
}
