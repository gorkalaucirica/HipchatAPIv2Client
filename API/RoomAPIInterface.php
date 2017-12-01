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
use GorkaLaucirica\HipchatAPIv2Client\Model\Room;
use GorkaLaucirica\HipchatAPIv2Client\Model\Webhook;

interface RoomAPIInterface
{
    /**
     * List non-archived rooms for this group
     * More info: https://www.hipchat.com/docs/apiv2/method/get_all_rooms
     *
     * @param array $params Query string parameter(s), for example: array('max-results' => 30)
     *
     * @return array
     */
    public function getRooms($params = array());

    /**
     * Gets room by id or name
     * More info: https://www.hipchat.com/docs/apiv2/method/get_room
     *
     * @param string $id The id or name of the room
     *
     * @return Room
     */
    public function getRoom($id);

    /**
     * Fetch latest chat history for this room.
     * More info: https://www.hipchat.com/docs/apiv2/method/view_recent_room_history
     *
     * @param string $id The id or name of the room
     * @param array $params Query string parameter(s), for example: array('max-results' => 30)
     *
     * @return array
     */
    public function getRecentHistory($id, $params = array());

    /**
     * Creates a room
     * More info: https://www.hipchat.com/docs/apiv2/method/create_room
     *
     * @param Room $room New room to be persisted
     *
     * @return integer Just created room id
     */
    public function createRoom(Room $room);

    /**
     * Updates a room
     * More info: https://www.hipchat.com/docs/apiv2/method/update_room
     *
     * @param Room $room Existing room to be updated
     *
     * @return void
     */
    public function updateRoom(Room $room);

    /**
     * Deletes a room and kicks the current participants.
     * More info: https://www.hipchat.com/docs/apiv2/method/delete_room
     *
     * @param string $id The id or name of the room.
     *
     * @return void
     */
    public function deleteRoom($id);

    /**
     * Send a room a notification
     * More info: https://www.hipchat.com/docs/apiv2/method/send_room_notification
     *
     * @param string $id The id or name of the room
     * @param Message $message The message to be sent
     *
     * @return void
     */
    public function sendRoomNotification($id, Message $message);

    /**
     * Adds a member to a private room
     * More info: https://www.hipchat.com/docs/apiv2/method/add_member
     *
     * @param string $roomId The id or name of the room
     * @param string $memberId The id, email address, or mention name (beginning with an '@') of the user
     *
     * @return void
     */
    public function addMember($roomId, $memberId);

    /**
     * Removes a member from a private room.
     * More info: https://www.hipchat.com/docs/apiv2/method/remove_member
     *
     * @param string $roomId The id, email address, or mention name (beginning with an '@') of the user
     * @param string $memberId The id or name of the room
     *
     * @return void
     */
    public function removeMember($roomId, $memberId);

    /**
     * Invites a member to a public room
     * More info: https://www.hipchat.com/docs/apiv2/method/invite_user
     *
     * @param string $roomId The id or name of the room
     * @param string $memberId The id, email address, or mention name (beginning with an '@') of the user
     * @param string $reason The message displayed to a user when they are invited
     *
     * @return void
     */
    public function inviteUser($roomId, $memberId, $reason);

    /**
     * Set a topic on a room
     * More info: https://www.hipchat.com/docs/apiv2/method/set_topic
     *
     * @param string $roomId The id or name of the room
     * @param string $topic The topic to be set
     *
     * @return void
     */
    public function setTopic($roomId, $topic);

    /**
     * Creates a new webhook
     * More info: https://www.hipchat.com/docs/apiv2/method/create_webhook
     *
     * @param string $roomId The id or name of the room
     * @param Webhook $webhook The webhook to create
     *
     * @return int Just created webhook id
     */
    public function createWebhook($roomId, Webhook $webhook);

    /**
     * Deletes a new webhook
     * More info: https://www.hipchat.com/docs/apiv2/method/delete_webhook
     *
     * @param string $roomId The id or name of the room
     * @param string $webhookId The id of the webhook to delete
     *
     * @return void
     */
    public function deleteWebhook($roomId, $webhookId);

    /**
     * Gets all webhooks for this room
     * More info: https://www.hipchat.com/docs/apiv2/method/get_all_webhooks
     *
     * @param string $roomId The id or name of the room
     *
     * @TODO should return a Collection
     * @return array Array of Webhook
     */
    public function getAllWebhooks($roomId);
}