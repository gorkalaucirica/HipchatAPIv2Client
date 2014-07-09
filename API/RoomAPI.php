<?php

namespace GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Client;
use GorkaLaucirica\HipchatAPIv2Client\Model\Room;

class RoomAPI
{
    /** @var Client */
    protected $client;

    /**
     * Room api constructor
     *
     * @param Client $client that will be used to connect the server
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Gets room by id or name
     * More info: https://www.hipchat.com/docs/apiv2/method/get_room
     *
     * @param $id Room id or name
     *
     * @return Room
     */
    public function getRoom($id)
    {
        $response = $this->client->get("/v2/room/$id");

        return new Room($response);
    }
} 