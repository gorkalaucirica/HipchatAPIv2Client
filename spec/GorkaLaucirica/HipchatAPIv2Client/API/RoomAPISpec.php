<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomAPISpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI');
    }

    function it_gets_room(Client $client)
    {
        $id = 123456;
        $response = $this->getTestResponse();
        $client->get("/v2/room/$id")->shouldBeCalled()->willReturn($response);

        $this->getRoom($id)->shouldReturnAnInstanceOf('GorkaLaucirica\HipchatAPIv2Client\Model\Room');
    }

    protected function getTestResponse()
    {
        return array(
            'xmpp_jid' => '',
            'statistics' => '',
            'name' => '',
            'links' => array('self' => '', 'webhooks' => '', 'members' => ''),
            'created' => '2014-07-09 11:12:22',
            'is_archived' => true,
            'privacy' => 'public',
            'is_guest_accessible' => false,
            'topic' => '',
            'participants' => array(
                array('mention_name' => '@test', 'id' => '13123', 'links' => array('self' => ''), 'name' => '')
            ),
            'owner' => array('mention_name' => '@test', 'id' => '13123', 'links' => array('self' => ''), 'name' => ''),
            'id' => 123456,
            'guest_access_url' => ''
        );
    }
}
