<?php
/**
 * Created by solutionDrive GmbH.
 *
 * @author:    Tobias Lückel <tl@solutionDrive.de>
 * @date:      01.12.17
 * @time:      13:09
 * @copyright: 2017 solutionDrive GmbH
 */

namespace GorkaLaucirica\HipchatAPIv2Client\API;

use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
use GorkaLaucirica\HipchatAPIv2Client\Model\User;

interface UserAPIInterface
{
    /**
     * List all users in the group
     * More info: https://www.hipchat.com/docs/apiv2/method/get_all_users
     *
     * @param array $parameters The following are accepted: start-index, max-results, include-guests, include-deleted
     *
     * @return array of Users
     */
    public function getAllUsers($parameters = array());

    /**
     * Gets user by id, email or mention name
     * More info: https://www.hipchat.com/docs/apiv2/method/view_user
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user to view
     *
     * @return User
     */
    public function getUser($userId);

    /**
     * Creates a new user
     * More info: https://www.hipchat.com/docs/apiv2/method/create_user
     *
     * @param User $user User to be created
     * @param string $password User's password
     *
     * @return mixed
     */
    public function createUser(User $user, $password);

    /**
     * Update a user
     * More info: https://www.hipchat.com/docs/apiv2/method/update_user
     *
     * @param User $user User to be updated
     */
    public function updateUser(User $user);

    /**
     * Delete a user.
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user to delete
     */
    public function deleteUser($userId);

    /**
     * Sends a user a private message
     * More info: https://www.hipchat.com/docs/apiv2/method/private_message_user
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user to send a message to
     * @param mixed $message The message to send as plain text
     */
    public function privateMessageUser($userId, $message);

    /**
     * Fetch latest chat history for the 1:1 chat with the user
     * More info: https://www.hipchat.com/docs/apiv2/method/view_recent_privatechat_history
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user
     * @param mixed $parameters Optional parameters, check above documentation for more info
     *
     * @return array Message
     */
    public function getRecentPrivateChatHistory($userId, array $parameters = array());

    /**
     * Fetch one specific message by id
     * More info: https://www.hipchat.com/docs/apiv2/method/get_privatechat_message
     *
     * @param string $user The id, email address, or mention name (beginning with an '@') of the user
     * @param string $messageId The id of the message to retrieve
     * @param array $parameters Optional parameters, check above documentation for more info
     *
     * @return Message
     */
    public function getPrivateChatMessage($user, $messageId, array $parameters = array());

    /**
     * Gets a user photo
     * More info: https://www.hipchat.com/docs/apiv2/method/get_photo
     *
     * @param string $userId The id, email address, or mention name (beginning with an '@') of the user
     * @param string $size The size to retrieve ("small" or "big")
     *
     * @return string
     */
    public function getPhoto($userId, $size);
}