<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Model;

class Message
{
    protected $color;

    protected $message;

    protected $notify;

    protected $messageFormat;

    const COLOR_YELLOW = 'yellow';
    const COLOR_GREEN = 'green';
    const COLOR_RED = 'red';
    const COLOR_PURPLE = 'purple';
    const COLOR_GRAY = 'gray';
    const COLOR_RANDOM = 'random';

    const FORMAT_HTML = 'html';
    const FORMAT_TEXT = 'text';

    /**
     * Message constructor
     */
    public function __construct()
    {
        $this->color = self::COLOR_YELLOW;
        $this->messageFormat = self::FORMAT_HTML;
        $this->message = "";
        $this->notify = false;

    }

    /**
     * Serializes Message object
     *
     * @return array
     */
    public function toJson()
    {
        $json = array();
        $json['color'] = $this->color;
        $json['message'] = $this->message;
        $json['notify'] = $this->notify;
        $json['message_format'] = $this->messageFormat;

        return $json;

    }
    /**
     * Sets background color for message
     *
     * @param string $color Background color for message
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * Returns background color for message
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets the message body
     *
     * @param string $message The message body
     *
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Returns the message body
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets whether or not this message should trigger a notification
     *
     * @param boolean $notify Whether or not this message should trigger a notification
     *
     * @return self
     */
    public function setNotify($notify)
    {
        $this->notify = $notify;
        return $this;
    }

    /**
     * Returns whether or not this message should trigger a notification for people in the room
     * (change the tab color, play a sound, etc). Each recipient's notification preferences are taken into account.
     *
     * @return boolean
     */
    public function isNotify()
    {
        return $this->notify;
    }

    /**
     * Sets how the message is treated by the server and rendered inside HipChat applications
     *
     * @param string $messageFormat How the message is treated by the server and rendered inside HipChat applications
     *
     * @return self
     */
    public function setMessageFormat($messageFormat)
    {
        $this->messageFormat = $messageFormat;
        return $this;
    }

    /**
     * Returns how the message is treated by the server and rendered inside HipChat applications
     *
     * @return string
     */
    public function getMessageFormat()
    {
        return $this->messageFormat;
    }


}