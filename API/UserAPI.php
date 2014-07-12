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
     * List all users in the group
     * More info: https://www.hipchat.com/docs/apiv2/method/get_all_users
     *
     * @param array $parameters The following are accepted: start-index, max-results, include-guests, include-deleted
     *
     * @return array of Users
     */
    public function getAllUsers($parameters = array())
    {
        $response = $this->client->get('/v2/user', $parameters);

        $users = array();
        foreach ($response['items'] as $response) {
            $users[] = new User($response);
        }
        return $users;
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

    /**
     * Sends a user a private message
     * More info: https://www.hipchat.com/docs/apiv2/method/private_message_user
     *
     * @param string $user    The id, email address, or mention name (beginning with an '@')
     *                        of the user to send a message to
     * @param string $message The message to send as plain text
     *
     * @return void
     */
    public function privateMessageUser($user, $message)
    {
        $this->client->post(sprintf('/v2/user/%s/message', $user), array('message' => $message));
    }
}
