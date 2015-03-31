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
     * Creates a new user
     * More info: https://www.hipchat.com/docs/apiv2/method/create_user
     *
     * @param User $user User to be created
     * @param string $password User's password
     *
     * @return mixed
     */
    public function createUser(User $user, $password)
    {
        $request = $user->toJson();
        $request['password'] = $password;
        $response = $this->client->post('/v2/user', $request);
        return $response['id'];
    }

    /**
     * Update a user
     * More info: https://www.hipchat.com/docs/apiv2/method/update_user
     *
     * @param User $user User to be updated
     *
     * @return void
     */
    public function updateUser(User $user)
    {
        $request = $user->toJson();
        $this->client->put(sprintf('/v2/user/%s', $user->getId()), $request);
    }

    /**
     * Delete a user
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user to delete.
     *
     * @return void
     */
    public function deleteUser($userId)
    {
        $this->client->delete(sprintf('/v2/user/%s', $userId));
    }

    /**
     * Sends a user a private message
     * More info: https://www.hipchat.com/docs/apiv2/method/private_message_user
     *
     * @param string $user The id, email address, or mention name (beginning with an '@')
     *                        of the user to send a message to
     * @param mixed $message The message to send as plain text
     *
     * @return void
     */
    public function privateMessageUser($user, $message)
    {
        if (is_string($message)) {
            $content = array('message' => $message);
        }
        else { // Assuming its a Message
            $content = $message->toJson();
        }
        $this->client->post(sprintf('/v2/user/%s/message', $user), $content);
    }
    
    /**
     * Fetch latest chat history for the 1:1 chat with the user
     * More info: https://www.hipchat.com/docs/apiv2/method/view_recent_privatechat_history
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@')
     *                        of the user to send a message to
     * @param mixed $parameters Optional parameters, check above documentation for more info
     *
     * @return array Message
     */
    public function getRecentPrivateChatHistory($userId, array $parameters = array())
    {
        $response = $this->client->get(
            sprintf('/v2/user/%s/history/latest', $userId),
            $parameters
        );

        $messages = array();
        foreach ($response['items'] as $response) {
            $messages[] = new Message($response);
        }

        return $messages;
    }
}
