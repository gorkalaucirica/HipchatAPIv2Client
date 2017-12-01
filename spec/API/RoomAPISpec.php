<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\ClientInterface;
use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
use GorkaLaucirica\HipchatAPIv2Client\Model\Room;
use GorkaLaucirica\HipchatAPIv2Client\Model\Webhook;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomAPISpec extends ObjectBehavior
{
    function let(ClientInterface $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI');
    }

    function it_gets_rooms(ClientInterface $client)
    {
        $response = $this->getArrayResponse();
        $client->get("/v2/room", array())->shouldBeCalled()->willReturn($response);

        $this->getRooms()->shouldHaveCount(2);
    }

    function it_gets_room(ClientInterface $client)
    {
        $id = 123456;
        $response = $this->getResourceResponse();
        $client->get("/v2/room/$id")->shouldBeCalled()->willReturn($response);

        $this->getRoom($id)->shouldReturnAnInstanceOf('GorkaLaucirica\HipchatAPIv2Client\Model\Room');
    }

    function it_gets_room_history(ClientInterface $client)
    {
        $id = 123456;
        $response = $this->getMessageHistoryArrayResponse();
        $client->get("/v2/room/$id/history/latest", array())->shouldBeCalled()->willReturn($response);

        $this->getRecentHistory($id)->shouldHaveCount(2);
    }

    function it_creates_room(ClientInterface $client, Room $room)
    {
        $request = array(
            'name' => 'Test name', 'privacy' => 'private', 'guest_access' => false,
            'owner_user_id' => '1222'
        );
        $room->toJson()->shouldBeCalled()->willReturn($request);
        $client->post("/v2/room", $request)->shouldBeCalled();
        $this->createRoom($room);
    }

    function it_updates_room(ClientInterface $client, Room $room)
    {
        $request = array(
            'name' => 'Test name', 'is_archived' => false, 'privacy' => 'private', 'is_guest_accessible' => false,
            'topic' => 'Testing', 'owner' => array('id' => '1222')
        );
        $room->getId()->shouldBeCalled()->willReturn(123456);
        $room->toJson()->shouldBeCalled()->willReturn($request);
        $client->put("/v2/room/123456", $request)->shouldBeCalled();
        $this->updateRoom($room);
    }

    function it_deletes_room(ClientInterface $client)
    {
        $client->delete('/v2/room/123456')->shouldBeCalled();
        $this->deleteRoom('123456');
    }

    function it_sends_room_notification(ClientInterface $client, Message $message)
    {
        $request = array(
            "color" => "gray", "message" => "This is a test!!", 'notify' => false, 'message_format' => 'html'
        );
        $message->toJson()->shouldBeCalled()->willReturn($request);
        $client->post("/v2/room/123456/notification", $request)->shouldBeCalled();
        $this->sendRoomNotification(123456, $message);
    }

    function it_adds_member(ClientInterface $client)
    {
        $client->put('/v2/room/665432/member/122334')->shouldBeCalled();
        $this->addMember('665432', '122334');
    }

    function it_removes_member(ClientInterface $client)
    {
        $client->delete('/v2/room/665432/member/122334')->shouldBeCalled();
        $this->removeMember('665432', '122334');
    }

    function it_invites_users(ClientInterface $client) {
        $request = array('reason' => 'Reason given');
        $client->post('/v2/room/654321/invite/122233', $request)->shouldBeCalled();
        $this->inviteUser(654321, 122233, 'Reason given');
    }

    function it_sets_topic(ClientInterface $client) {
        $request = array('topic' => 'New topic');
        $client->put('/v2/room/665432/topic', $request)->shouldBeCalled();
        $this->setTopic(665432, 'New topic');
    }

    function it_creates_webhook(ClientInterface $client, Webhook $webhook) {
        $request = array(
            'url' => 'http://example.com/webhook',
            'pattern' => '/phpspec/',
            'event' => 'room_message',
            'name' => '112233',
        );
        $webhook->toJson()->shouldBeCalled()->willReturn($request);
        $client->post('/v2/room/123456/webhook', $request)->shouldBeCalled();
        $this->createWebhook('123456', $webhook);
    }

    function it_deletes_webhook(ClientInterface $client) {
        $client->delete('/v2/room/123456/webhook/112233')->shouldBeCalled();
        $this->deleteWebhook('123456', '112233');
    }

    function it_gets_webhooks(ClientInterface $client, Webhook $webhook) {
        $response = $this->getWebhookArrayResponse();
        $client->get('/v2/room/234567/webhook')->shouldBeCalled()->willReturn($response);
        $this->getAllWebhooks('234567')->shouldHaveCount(2);
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

    protected function getMessageHistoryArrayResponse()
    {
        return array(
            "items" => array(
                    array(
                        'id' => 1233,
                        'color' => 'yellow',
                        'from' => 'Tester',
                        'message' => 'test1',
                        'notify' => false,
                        'message_format' => 'html',
                        'date' => '2014-02-10 10:02:10'
                    ),
                    array(
                        'id' => 1234,
                        'color' => 'red',
                        'from' => 'Tester',
                        'message' => 'test1',
                        'notify' => false,
                        'message_format' => 'html',
                        'date' => '2014-02-10 10:02:10'
                    )
            )
        );

    }

    protected function getWebhookArrayResponse()
    {
        return array(
            'items' => array(
                array(
                    'url' => 'http://example.com/dummywebhook',
                    'pattern' => '/phpspec_delete_webhook/',
                    'event' => 'room_message',
                    'name' => '332123',
                ),
                array(
                    'url' => 'http://example.com/dummywebhook2',
                    'pattern' => '/phpspec_delete_webhook2/',
                    'event' => 'room_message',
                    'name' => '432123',
                )
            )
        );

    }
}
