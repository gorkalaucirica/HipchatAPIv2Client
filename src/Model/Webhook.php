<?php

namespace GorkaLaucirica\HipchatAPIv2Client\Model;

class Webhook
{

    /**
     * The unique identifier for the created entity
     * @var string|null
     */
    protected $id = null;

    /**
     * The URL to send the webhook POST to
     * @var string
     */
    protected $url;

    /**
     * The regular expression pattern to match against messages.
     * Only applicable for message events.
     * @var string
     */
    protected $pattern;

    /**
     * The event to listen for
     * Valid values:
     *    room_message, room_notification, room_exit, room_enter, room_topic_change.
     * @var string
     */
    protected $event;

    /**
     * The label for this webhook
     * @var string
     */
    protected $name;

    /**
     * URLs to retrieve webhook information
     * @var array
     */
    protected $links;

    /**
     * Webhook constructor
     */
    public function __construct($json = null)
    {
        if ($json) {
            $this->parseJson($json);
        } else {
            $this->url = '';
            $this->pattern = '';
            $this->event = 'room_message';
            $this->name = '';
            $this->links = '';
        }
    }

    public function parseJson($json)
    {
        $this->id = isset($json['id']) ? $json['id'] : null;
        $this->url = $json['url'];
        $this->pattern = $json['pattern'];
        $this->event = $json['event'];
        $this->name = $json['name'];
        $this->links = (isset($json['links']) && is_array($json['links'])) ? $json['links'] : array();
    }


    /**
     * Serializes Webhook object
     *
     * @return array
     */
    public function toJson()
    {
        $json = array();
        $json['id'] = $this->id;
        $json['url'] = $this->url;
        $json['pattern'] = $this->pattern;
        $json['event'] = $this->event;
        $json['name'] = $this->name;
        $json['links'] = $this->links;

        return $json;
    }

    /**
     * Gets the unique identifier for the created entity
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the unique identifier for the created entity
     * @param null|string $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the event to listen for
     *
     * @return string
     */
    public function getEvent() {
        return $this->event;
    }

    /**
     * Sets the event to listen for
     *
     * @param string $event
     * @return self
     */
    public function setEvent($event) {
        $this->event = $event;
        return $this;
    }

    /**
     * Gets the URLs to retrieve webhook information
     * @return array
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Sets the URLs to retrieve webhook information
     * @param array $links
     * @return self
     */
    public function setLinks($links)
    {
        $this->links = $links;
        return $this;
    }

    /**
     * Gets the label for this webhook
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the label for this webhook
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the regular expression pattern to match against messages.
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Sets the regular expression pattern to match against messages.
     * @param string $pattern
     * @return self
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Gets the URL to send the webhook POST to
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the URL to send the webhook POST to
     * @param string $url
     * @return self
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

}
