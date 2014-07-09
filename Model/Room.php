<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Model;

class Room
{
    protected $id;

    //protected $statistics;

    protected $name;

    protected $links;

    protected $created;

    protected $isArchived;

    protected $privacy;

    protected $isGuestAccessible;

    protected $topic;

    protected $participants;

    protected $owner;

    protected $guestAccessUrl;

    /**
     * Builds a room object from server response if json given, otherwise creates an empty object
     *
     * @param array $json json_decoded response in json given by the server
     *
     * @return self
     */
    public function __construct($json = null)
    {
        if ($json) {
            $this->parseJson($json);
        }
    }

    /**
     * Parses response given by the API and maps the fields to Room object
     *
     * @param array $json json_decoded response in json given by the server
     *
     * @return void
     */
    public function parseJson($json)
    {
        $this->id = $json['id'];
    }
}