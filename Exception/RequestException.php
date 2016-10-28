<?php
/**
 * Created by PhpStorm.
 * User: gorkalaucirica
 * Date: 09/07/14
 * Time: 12:33
 */

namespace GorkaLaucirica\HipchatAPIv2Client\Exception;


class RequestException extends \Exception
{
    protected $responseCode;

    protected $message;

    protected $type;

    /**
     * Request exception constructor
     *
     * @param string $response json_decoded array with the error response given by the server
     */
    public function __construct($response)
    {
        $error = isset($response['error']) ? $response['error'] : null;
        $this->responseCode = isset($response['code']) ? $error['code'] : null;
        $this->message = isset($response['message']) ? $error['message'] : null;
        $this->type = isset($response['type']) ? $error['type'] : null;
    }

    /**
     * Returns responseCode
     *
     * @return mixed
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     * Returns type
     *
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}
