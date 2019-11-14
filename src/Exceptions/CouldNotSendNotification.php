<?php

namespace Mateusjatenee\Wavy\Exceptions;

class CouldNotSendNotification extends \Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static("Notification was not sent. Plivo responded with `{$response['status']}");
    }
}
