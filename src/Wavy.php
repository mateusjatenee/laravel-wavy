<?php

namespace Mateusjatenee\Wavy;

use GuzzleHttp\Client;

class Wavy
{
    /** @var string */
    protected $username;

    /** @var string */
    protected $authToken;

    /**
     * Create a new Wavy instance.
     *
     * @param array $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->username = $config['username'];
        $this->authToken = $config['auth_token'];
    }

    public function send($to, $message)
    {
        $guzzle = new Client;

        $response = $guzzle->post('https://api-messaging.movile.com/v1/send-sms', [
            'headers' => [
                'authenticationtoken' => $this->authToken,
                'username' => $this->username,
            ],
            'json' => [
                'destination' => $to,
                'messageText' => $message,
            ],
        ]);

        return [
            'status' => $response->getStatusCode(),
        ];
    }
}
