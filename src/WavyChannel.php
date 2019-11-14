<?php

namespace Mateusjatenee\Wavy;

use Illuminate\Notifications\Notification;
use Mateusjatenee\Wavy\Exceptions\CouldNotSendNotification;
use Mateusjatenee\Wavy\Wavy;
use Mateusjatenee\Wavy\WavyMessage;

class WavyChannel
{
    /**
     * @var \Mateusjatenee\Wavy\Wavy;
     */
    protected $wavy;

    /**
     * @return  void
     */
    public function __construct(Wavy $wavy)
    {
        $this->wavy = $wavy;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \Mateusjatenee\Wavy\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        if (!$to = $notifiable->routeNotificationFor('wavy')) {
            return;
        }

        $message = $notification->toWavy($notifiable);

        if (is_string($message)) {
            $message = new WavyMessage($message);
        }

        $response = $this->wavy->send($to, trim($message->content));

        if ($response['status'] > 299) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($response);
        }

        return $response;
    }
}
