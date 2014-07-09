<?php

namespace GorkaLaucirica\HipchatAPIv2Client;

use Buzz\Browser;
use Buzz\Client\Curl;
use GorkaLaucirica\HipchatAPIv2Client\Auth\AuthInterface;
use GorkaLaucirica\HipchatAPIv2Client\Exception\BadRequestException;

class Client
{
    protected $baseUrl;

    /** @var AuthInterface */
    protected $auth;

    public function __construct($baseUrl, AuthInterface $auth)
    {
        $this->baseUrl = $baseUrl;
        $this->auth = $auth;
    }

    public function get($resource, $query = array())
    {
        $curl = new Curl();
        $browser = new Browser($curl);

        $url = $this->baseUrl . $resource;
        if (count($query) > 0) {
            $url .= "?";
        }

        foreach ($query as $key => $value) {
            $url .= "$key=$value&";
        }

        $headers = array("Authorization" => $this->auth->getCredential());

        $response = $browser->get($url, $headers);

        if ($browser->getLastResponse()->getStatusCode() != 200) {
            throw new BadRequestException();
        }

        return json_decode($response->getContent(), true);
    }

    public function post($resource, $content)
    {
        $curl = new Curl();
        $browser = new Browser($curl);

        $url = $this->baseUrl . $resource;

        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->auth->getCredential()
        );

        $response = $browser->post($url, $headers, json_encode($content));

        if ($browser->getLastResponse()->getStatusCode() > 299) {
            throw new BadRequestException($response);
        }

        return json_decode($response->getContent(), true);
    }

    public function put($resource, $content)
    {
        $curl = new Curl();
        $browser = new Browser($curl);

        $url = $this->baseUrl . $resource;

        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->auth->getCredential()
        );

        $response = $browser->put($url, $headers, json_encode($content));

        if ($browser->getLastResponse()->getStatusCode() > 299) {
            throw new BadRequestException($response);
        }

        return json_decode($response->getContent(), true);
    }
}