<?php

namespace GorkaLaucirica\HipchatAPIv2Client\API;


/**
 * RoomStatistics
 *
 * @package   GorkaLaucirica\HipchatAPIv2Client\API
 * @author    Mathieu Bruneau <mbruneau@nuglif.com>
 * @copyright 2016 Nuglif
 */
class RoomStatistics
{

    /**
     * RoomStatistics constructor.
     *
     * @param string $json
     */
    public function __construct($json)
    {
        if ($json) {
            $this->parseJson($json);
        } else {
            $this->messages_sent = 0;
            $this->last_active = null;
        }
    }

    private function parseJson($json)
    {
        $this->messages_sent = $json['messages_sent'];
        $this->last_active = $json['last_active'];
    }

}
