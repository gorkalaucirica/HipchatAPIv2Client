<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\ClientInterface;
use GorkaLaucirica\HipchatAPIv2Client\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserAPISpec extends ObjectBehavior
{
    function let(ClientInterface $ClientInterface)
    {
        $this->beConstructedWith($ClientInterface);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\API\UserAPI');
    }

    function it_gets_all_users(ClientInterface $ClientInterface)
    {
        $response = array('items' => array(array(
            'mention_name' => '@test', 'id' => '123456', 'links' => array(), 'name' => 'Test')),
            'startIndex' => 0, 'maxResults' => 50, 'links' => array()
        );

        $ClientInterface->get('/v2/user', array())->shouldBeCalled()->willReturn($response);

        $this->getAllUsers()->shouldHaveCount(1);
    }

    function it_gets_user(ClientInterface $ClientInterface)
    {
        $mentionName = '@test';
        $response = $this->getTestResponse();
        $ClientInterface->get("/v2/user/$mentionName")->shouldBeCalled()->willReturn($response);

        $this->getUser($mentionName)->shouldReturnAnInstanceOf('GorkaLaucirica\HipchatAPIv2Client\Model\User');
    }

    function it_creates_user(ClientInterface $ClientInterface, User $user)
    {
        $request = array(
            'name' => 'Test', 'title' => 'Tester', 'mention_name' => 'test', 'is_group_admin' => false,
            'email' => 'test@test.com');
        $user->toJson()->shouldBeCalled()->willReturn($request);
        $request['password'] = 'test1234';
        $ClientInterface->post('/v2/user', $request)->shouldBeCalled()->willReturn(array('id' => '123456', 'links' => array()));

        $this->createUser($user, 'test1234')->shouldReturn('123456');
    }

    function it_updates_user(ClientInterface $ClientInterface, User $user)
    {
        $request = array(
            'id' => '123456', 'name' => 'Test', 'title' => 'Tester', 'mention_name' => 'test',
            'is_group_admin' => false, 'email' => 'test@test.com');
        $user->toJson()->shouldBeCalled()->willReturn($request);
        $user->getId()->shouldBeCalled()->willReturn('123456');
        $ClientInterface->put('/v2/user/123456', $request)->shouldBeCalled();

        $this->updateUser($user, 'test1234');
    }

    function it_deletes_user(ClientInterface $ClientInterface)
    {
        $ClientInterface->delete('/v2/user/test')->shouldBeCalled();

        $this->deleteUser('test');
    }

    function it_sends_private_message_user(ClientInterface $ClientInterface)
    {
        $ClientInterface->post('/v2/user/123456/message', array('message' => 'Im testing!!'))->shouldBeCalled();
        $this->privateMessageUser('123456', 'Im testing!!');
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
            'is_guest' => false,
            'email' => 'test@test.com',
            'photo_url' => 'http://test.com/test.jpg'
        );
    }
}
