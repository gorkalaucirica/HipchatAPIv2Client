<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Model;

class User
{
    protected $xmppJid;

    protected $deleted;

    protected $name;

    protected $lastActive;

    protected $title;

    protected $links;

    //protected $presence;

    protected $created;

    protected $id;

    protected $mentionName;

    protected $groupAdmin;

    protected $timezone;

    protected $guest;

    protected $email;

    protected $photoUrl;

    /**
     * Builds a user object from server response if json given, otherwise creates an empty object
     * Works with partial and full user information.
     *
     * @param array $json json_decoded response in json given by the server
     * 
     */
    public function __construct($json = null)
    {
        if ($json) {
            $this->parseJson($json);
        } else {
            $this->groupAdmin = false;
            $this->timezone = 'UTC';
        }
    }

    /**
     * Parses response given by the API and maps the fields to User object
     *
     * @param array $json json_decoded response in json given by the server
     *
     * @return void
     */
    public function parseJson($json)
    {
        $this->mentionName = $json['mention_name'];
        $this->id = $json['id'];
        $this->name = $json['name'];
        if (isset($json['links'])) {
            $this->links = $json['links'];
        }
        if(isset($json['xmpp_jid'])) {
            $this->xmppJid = $json['xmpp_jid'];
            $this->deleted = $json['is_deleted'];
            $this->lastActive = $json['last_active'];
            $this->title = $json['title'];
            $this->created = new \Datetime($json['created']);
            $this->groupAdmin = $json['is_group_admin'];
            $this->timezone = $json['timezone'];
            $this->guest = $json['is_guest'];
            $this->email = $json['email'];
            $this->photoUrl = $json['photo_url'];
        }
    }

    public function toJson()
    {
        $json = array();
        $json['name'] = $this->name;
        $json['title'] = $this->title;
        $json['mention_name'] = $this->mentionName;
        $json['is_group_admin'] = $this->groupAdmin;
        $json['timezone'] = $this->timezone;
        $json['email'] = $this->email;

        return $json;
    }

    /**
     * Sets XMPP/Jabber ID of the user.
     *
     * @param string $xmppJid XMPP/Jabber ID of the user
     *
     * @return self
     */
    public function setXmppJid($xmppJid)
    {
        $this->xmppJid = $xmppJid;
        return $this;
    }

    /**
     * Returns XMPP/Jabber ID of the user.
     *
     * @return string
     */
    public function getXmppJid()
    {
        return $this->xmppJid;
    }

    /**
     * Sets whether the user has been deleted or not
     *
     * @param boolean $deleted Whether the user has been deleted or not
     *
     * @return self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Returns whether the user has been deleted or not
     *
     * @return boolean
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Sets user's full name
     *
     * @param string $name User's full name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Returns user's full name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets when the user was last active
     *
     * @param \Datetime $lastActive When the user was last active
     *
     * @return self
     */
    public function setLastActive($lastActive)
    {
        $this->lastActive = $lastActive;
        return $this;
    }

    /**
     * Returns when the user was last active
     *
     * @return \Datetime
     */
    public function getLastActive()
    {
        return $this->lastActive;
    }

    /**
     * Sets user's title
     *
     * @param mixed $title User's title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Returns user's title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets when the user was created
     *
     * @param \Datetime $created When the user was created
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * Returns when the user was created
     *
     * @return \Datetime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Sets user's ID
     *
     * @param mixed $id User's ID
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Returns user's ID
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets user's @mention name
     *
     * @param mixed $mentionName User's @mention name
     *
     * @return self
     */
    public function setMentionName($mentionName)
    {
        $this->mentionName = $mentionName;
        return $this;
    }

    /**
     * Returns user's @mention name
     *
     * @return mixed
     */
    public function getMentionName()
    {
        return $this->mentionName;
    }

    /**
     * Sets whether or not this user is an admin of the group
     *
     * @param boolean $groupAdmin Whether or not this user is an admin of the group
     *
     * @return self
     */
    public function setGroupAdmin($groupAdmin)
    {
        $this->groupAdmin = $groupAdmin;
        return $this;
    }

    /**
     * Returns whether or not this user is an admin of the group
     *
     * @return boolean
     */
    public function isGroupAdmin()
    {
        return $this->groupAdmin;
    }

    /**
     * Sets the desired user timezone
     *
     * @param string $timezone The desired user timezone
     *
     * @return self
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
        return $this;
    }

    /**
     * Returns the desired user timezone
     *
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * Sets whether or not this user is a guest or registered user
     *
     * @param boolean $guest Whether or not this user is a guest or registered user
     *
     * @return self
     */
    public function setGuest($guest)
    {
        $this->guest = $guest;
        return $this;
    }

    /**
     * Returns whether or not this user is a guest or registered user
     *
     * @return boolean
     */
    public function isGuest()
    {
        return $this->guest;
    }

    /**
     * Sets user's email
     *
     * @param string $email User's email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Returns user's email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets URL to user's photo.
     *
     * @param string $photoUrl URL to user's photo
     *
     * @return self
     */
    public function setPhotoUrl($photoUrl)
    {
        $this->photoUrl = $photoUrl;
        return $this;
    }

    /**
     * Returns URL to user's photo. 125px on the longest side
     *
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->photoUrl;
    }
}
