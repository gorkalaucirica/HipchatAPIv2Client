<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAPISpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\API\UserAPI');
    }

    function it_gets_room(Client $client)
    {
        $mentionName = '@test';
        $response = $this->getTestResponse();
        $client->get("/v2/user/$mentionName")->shouldBeCalled()->willReturn($response);

        $this->getUser($mentionName)->shouldReturnAnInstanceOf('GorkaLaucirica\HipchatAPIv2Client\Model\User');
    }

    protected function getTestResponse()
    {
        return array(
            'xmpp_jid' => '',
            'is_deleted' => false,
            'name' => 'Sr. Test',
            'last_active' => '2014-07-09 13:51:54',
            'title' => 'Tester',
            'presence' => array(),
            'created' => '2014-07-05 13:51:54',
            'id' => 123435,
            'mention_name' => '@test',
            'is_group_admin' => false,
            'timezone' => 'UTC+1',
            'is_guest'=> false,
            'email' => 'test@test.com',
            'photo_url' => 'http://test.com/test.jpg'
        );
    }
}
