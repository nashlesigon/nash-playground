<?php

namespace Playground\MainBundle\Services\Mailer;

class NotificationSender
{
    public function send(\Swift_Mailer $mailer, $subject, $body, $to)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom('no-reply@nashlesigon.com')
            ->setTo($to)
            ->setContentType('text/html')
            ->setBody($body);

        $mailer->send($message);
    }
}