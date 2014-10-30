<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebhookSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\Model\Webhook');
    }

    function it_parses_full_json()
    {
        $json = array(
            'id' => '123556',
            'url' => 'http://example.com/webhook',
            'pattern' => '/phpspec/',
            'event' => 'room_message',
            'name' => 'phpspec-webhok',
            'links' => array('self' => 'http://example.com'),
        );
        $this->parseJson($json);
        $this->getId()->shouldReturn('123556');
    }

    function it_serializes_to_array()
    {
        $this->setId('123212')
            ->seturl('http://example.com/webhook')
            ->setPattern('/phpspec/')
            ->setEvent('room_message')
            ->setName('phpspec_serialize')
            ->setLinks(array('self' => 'http://example.com'));

        $this->toJson()->shouldHaveCount(6);
    }

    function its_id_is_mutable()
    {
        $this->setId('112233')->shouldReturn($this);
        $this->getId()->shouldReturn('112233');
    }

    function its_url_is_mutable()
    {
        $this->setUrl('http://example.com/webhook')->shouldReturn($this);
        $this->getUrl()->shouldReturn('http://example.com/webhook');
    }

    function its_pattern_is_mutable()
    {
        $this->setPattern('/phpspec/')->shouldReturn($this);
        $this->getPattern()->shouldReturn('/phpspec/');
    }

    function its_event_is_mutable()
    {
        $this->setEvent('room_enter')->shouldReturn($this);
        $this->getEvent()->shouldReturn('room_enter');
    }

    function its_name_is_mutable()
    {
        $this->setName('phpspec_test')->shouldReturn($this);
        $this->getName()->shouldReturn('phpspec_test');
    }

    function its_links_is_mutable()
    {
        $links = array('self' => 'http://example.com');
        $this->setLinks($links)->shouldReturn($this);
        $this->getLinks()->shouldReturn($links);
    }
}
