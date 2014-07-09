<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\Auth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class OAuth2Spec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('aojqe89yf23jn273n23gy3u23932f89');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\Auth\OAuth2');
    }

    function it_returns_credential()
    {
        $this->getCredential()->shouldReturn('Bearer aojqe89yf23jn273n23gy3u23932f89');
    }
}
