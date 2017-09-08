<?php

namespace Src;


use Mailgun\Mailgun;

class MailgunEmailer
{
    private $subject;
    private $message;
    private $recipients;

    /**
     * MailgunEmailer constructor.
     */
    public function __construct($subject, $message, $recipients)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->recipients = $recipients;
    }

    /**
     * @return mixed
     */
    public function getUri()
    {
        return "https://api.mailgun.net/v3/".DOMAIN."/messages";
    }

    /**
     * @return mixed
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return "Njuskalo Bot <postmaster@".DOMAIN.">;";
    }

    public function callMailgun()
    {
        $mailgun = Mailgun::create(API_KEY);

        $mailgun->messages()->send(DOMAIN, [
                'from' => $this->getFrom(),
                'to' => implode(',', $this->getRecipients()),
                'subject' => 'New apartments found!',
                'text' => $this->message
            ]
        );
    }
}