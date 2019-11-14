<?php

namespace NotificationChannels\Plivo\Test;

use Mateusjatenee\Wavy\WavyMessage;
use NotificationChannels\Plivo\WavyMessage;

class WavyMessageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Mateusjatenee\Wavy\WavyMessage */
    protected $message;

    /** @test */
    public function setUp()
    {
        parent::setUp();

        $this->message = new WavyMessage();
    }

    /** @test */
    public function it_can_accept_a_message_when_constructing_a_message()
    {
        $message = new WavyMessage('myMessage');

        $this->assertEquals('myMessage', $message->content);
    }

    /** @test */
    public function it_can_set_the_content()
    {
        $this->message->content('myMessage');

        $this->assertEquals('myMessage', $this->message->content);
    }

    /** @test */
    public function it_can_set_the_from_number()
    {
        $this->message->from('1234567890');

        $this->assertEquals('1234567890', $this->message->from);
    }
}
