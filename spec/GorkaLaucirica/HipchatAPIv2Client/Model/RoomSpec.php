<?php

namespace spec\GorkaLaucirica\HipchatAPIv2Client\Model;

use GorkaLaucirica\HipchatAPIv2Client\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RoomSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('GorkaLaucirica\HipchatAPIv2Client\Model\Room');
    }

    function it_parses_full_json()
    {
        $json = array(
            'id' => '123556', 'name' => 'Test room', 'links' => array(), 'xmpp_jid' => '',
            'created' => '2014-02-10 10:02:10', 'is_archived' => true, 'privacy' => 'public',
            'is_guest_accessible' => false, 'topic' => '', 'participants' => array(),
            'owner' => array('mention_name' => '@test', 'id' => '123456', 'name' => 'Test', 'links' => array()),
            'guest_access_url' => ''
        );
        $this->parseJson($json);
        $this->getId()->shouldReturn('123556');
        $this->isGuestAccessible()->shouldReturn(false);
        $this->getOwner()->getMentionName()->shouldReturn('@test');
    }

    function it_parses_partial_json()
    {
        $json = array('id' => '123556', 'name' => 'Test room', 'links' => array());
        $this->parseJson($json);
        $this->getId()->shouldReturn('123556');
    }

    function it_serializes_to_array_for_post()
    {
        $user = new User();
        $user->setId(111);
        $this->setName('POST test')
            ->setGuestAccessible(false)
            ->setPrivacy('private')
            ->setOwner($user);

        $this->toJson()->shouldHaveCount(4);
    }

    function it_serializes_to_array_for_put()
    {
        $this->setId('123556')
            ->setName('Test name')
            ->setArchived(false)
            ->setPrivacy('private')
            ->setGuestAccessible(false)
            ->setTopic('Testing');
        $user = new User();
        $user->setId('1222');
        $this->setOwner($user);

        $this->toJson()->shouldHaveCount(6);
    }

    function its_id_is_mutable()
    {
        $this->setId('112233')->shouldReturn($this);
        $this->getId()->shouldReturn('112233');
    }

    function its_xmppJid_is_mutable()
    {
        $this->setXmppJid('123@conf.hipchat.com')->shouldReturn($this);
        $this->getXmppJid()->shouldReturn('123@conf.hipchat.com');
    }

    function its_name_is_mutable()
    {
        $this->setName('Test!')->shouldReturn($this);
        $this->getName()->shouldReturn('Test!');
    }

    function its_links_are_mutable()
    {
        $this->setLinks(array('self' => 'api.hipchat.com/v2/room/112233'))->shouldReturn($this);
        $this->getLinks()->shouldReturn(array('self' => 'api.hipchat.com/v2/room/112233'));
    }

    function its_created_is_mutable()
    {
        $datetime = new \DateTime();
        $this->setCreated($datetime)->shouldReturn($this);
        $this->getCreated()->shouldReturn($datetime);
    }

    function its_archived_is_mutable()
    {
        $this->setArchived(true)->shouldReturn($this);
        $this->isArchived()->shouldReturn(true);
    }

    function its_privacy_is_mutable()
    {
        $this->setPrivacy('public')->shouldReturn($this);
        $this->getPrivacy()->shouldReturn('public');
    }

    function its_guest_accessible_is_mutable()
    {
        $this->setGuestAccessible(true)->shouldReturn($this);
        $this->isGuestAccessible()->shouldReturn(true);
    }

    function its_topic_is_mutable()
    {
        $this->setTopic('We are testing')->shouldReturn($this);
        $this->getTopic()->shouldReturn('We are testing');
    }

    function its_participants_are_mutable()
    {
        $user = new User();
        $this->setParticipants(array($user))->shouldReturn($this);
        $this->getParticipants()->shouldReturn(array($user));
    }

    function its_owner_is_mutable()
    {
        $user = new User();
        $this->setOwner($user)->shouldReturn($this);
        $this->getOwner()->shouldReturn($user);
    }

    function its_guest_access_url_is_mutable()
    {
        $this->setGuestAccessUrl('http://qweqw.com/asdasd')->shouldReturn($this);
        $this->getGuestAccessUrl()->shouldReturn('http://qweqw.com/asdasd');
    }



}
