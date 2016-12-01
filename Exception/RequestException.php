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
     * @param array|string $response json_decoded array with the error response given by the server
     *                               or an error message string
     */
    public function __construct($response)
    {
        if (is_array($response)) {
            $error = isset($response['error']) ? $response['error'] : null;

            $this->responseCode = isset($error['code']) ? $error['code'] : null;
            $this->message      = isset($error['message']) ? $error['message'] : null;
            $this->type         = isset($error['type']) ? $error['type'] : null;
        } elseif (is_string($response)) {
            $this->message = $response;
        }
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
