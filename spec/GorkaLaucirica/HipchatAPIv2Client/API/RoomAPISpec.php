<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Client;
use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
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

    function it_gets_rooms(Client $client)
    {
        $response = $this->getArrayResponse();
        $client->get("/v2/room", array())->shouldBeCalled()->willReturn($response);

        $this->getRooms()->shouldHaveCount(2);
    }

    function it_gets_room(Client $client)
    {
        $id = 123456;
        $response = $this->getResourceResponse();
        $client->get("/v2/room/$id")->shouldBeCalled()->willReturn($response);

        $this->getRoom($id)->shouldReturnAnInstanceOf('GorkaLaucirica\HipchatAPIv2Client\Model\Room');
    }

    function it_sends_room_notification(Client $client, Message $message)
    {
        $request = array("color" => "gray", "message" => "This is a test!!", 'notify' => false, 'message_format' => 'html');
        $message->toJson()->shouldBeCalled()->willReturn($request);
        $client->post("/v2/room/123456/notification", $request)->shouldBeCalled();
        $this->sendRoomNotification(123456, $message);
    }

    protected function getResourceResponse()
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

    protected function getArrayResponse()
    {
        return array(
            "items" => array(
                    array(
                        'id' => 1233,
                        'name' => 'test1',
                        'links' => array('self' => '', 'webhooks' => '', 'members' => '')
                    ),
                    array(
                        'id' => 1253,
                        'name' => 'test2',
                        'links' => array('self' => '', 'webhooks' => '', 'members' => '')
                    )
            )
        );

    }
}
