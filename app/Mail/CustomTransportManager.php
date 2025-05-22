<?php

namespace App\Mail;

use Illuminate\Mail\TransportManager;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class CustomTransportManager extends TransportManager
{
    protected function createSmtpDriver()
    {
        $config = $this->config->get('mail.mailers.smtp');

        // Create the SMTP transport
        $transport = new EsmtpTransport(
            $config['host'],
            $config['port'],
            !empty($config['encryption']) && $config['encryption'] === 'ssl'
        );

        if (isset($config['username'])) {
            $transport->setUsername($config['username']);
        }

        if (isset($config['password'])) {
            $transport->setPassword($config['password']);
        }

        // The critical part - disable SSL verification
        $streamOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ];
        $transport->setStreamOptions($streamOptions);

        return $transport;
    }
}