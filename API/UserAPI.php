<?php

namespace GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Client;
use GorkaLaucirica\HipchatAPIv2Client\Model\User;

class UserAPI
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
     * Gets user by id, email or mention name
     * More info: https://www.hipchat.com/docs/apiv2/method/view_user
     *
     * @param string $id The id, email address, or mention name (beginning with an '@') of the user to view
     *
     * @return User
     */
    public function getUser($id)
    {
        $response = $this->client->get("/v2/user/$id");

        return new User($response);
    }
}
