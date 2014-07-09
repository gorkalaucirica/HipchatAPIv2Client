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
     * List non-archived rooms for this group
     * More info: https://www.hipchat.com/docs/apiv2/method/get_all_rooms
     *
     * @param array $params Query string parameter(s), for example: array('max-results' => 30)
     *
     * @return array
     */
    public function getRooms($params = array())
    {
        $response = $this->client->get("/v2/room", $params);

        $rooms = array();
        foreach ($response['items'] as $response) {
            $rooms[] = new Room($response);
        }
        return $rooms;
    }

    /**
     * Gets room by id or name
     * More info: https://www.hipchat.com/docs/apiv2/method/get_room
     *
     * @param string $id The id or name of the room
     *
     * @return Room
     */
    public function getRoom($id)
    {
        $response = $this->client->get("/v2/room/$id");

        return new Room($response);
    }

}
