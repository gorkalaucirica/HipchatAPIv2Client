<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client;

use GorkaLaucirica\HipchatAPIv2Client\Auth\AuthInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function let(AuthInterface $auth)
    {
        $this->beConstructedWith('https://api.hipchat.com/v2',$auth);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\Client');
    }
}
