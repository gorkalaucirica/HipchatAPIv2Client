<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\Model;

use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MessageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\Model\Message');
    }

    function it_encodes_to_json()
    {
        $this->setColor(Message::COLOR_GRAY);
        $this->setMessage('This is a test!!');
        $this->toJson()->shouldReturn(
            array("color" => "gray", "message" => "This is a test!!", 'notify' => false, 'message_format' => 'html')
        );
    }

    function its_color_is_mutable()
    {
        $this->setColor(Message::COLOR_GRAY)->shouldReturn($this);
        $this->getColor()->shouldReturn(Message::COLOR_GRAY);
    }

    function its_message_is_mutable()
    {
        $this->setMessage('This is a test')->shouldReturn($this);
        $this->getMessage()->shouldReturn('This is a test');
    }

    function its_notify_is_mutable()
    {
        $this->setNotify(true)->shouldReturn($this);
        $this->isNotify()->shouldReturn(true);
    }

    function its_format_is_mutable()
    {
        $this->setMessageFormat(Message::FORMAT_TEXT)->shouldReturn($this);
        $this->getMessageFormat()->shouldReturn(Message::FORMAT_TEXT);
    }
}
