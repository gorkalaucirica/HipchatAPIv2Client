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
        $error = $response['error'];
        $this->responseCode = $error['code'];
        $this->message = $error['message'];
        $this->type = $error['type'];
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
