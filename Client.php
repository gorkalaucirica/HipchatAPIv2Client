<?php

namespace GorkaLaucirica\HipchatAPIv2Client;

use Buzz\Browser;
use Buzz\Client\Curl;
use GorkaLaucirica\HipchatAPIv2Client\Auth\AuthInterface;
use GorkaLaucirica\HipchatAPIv2Client\Exception\RequestException;

class Client
{
    protected $baseUrl = 'https://api.hipchat.com';

    /** @var AuthInterface */
    protected $auth;

    /**
     * Client constructor
     *
     * @param string        $baseUrl The base url to the api by default https://api.hipchat.com
     * @param AuthInterface $auth    Authetication you want to use to access the api
     *
     * @return self
     */
    public function __construct(AuthInterface $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Common get request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array  $query    Parameters to filter the response for example array('max-results' => 50)
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
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

        if ($browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($browser->getLastResponse()->getContent(), true));
        }

        return json_decode($response->getContent(), true);
    }

    /**
     * Common post request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array  $content  Parameters be posted for example:
     *                              array(
     *                                'name'                => 'Example name',
     *                                'privacy'             => 'private',
     *                                'is_archived'         => 'false',
     *                                'is_guest_accessible' => 'false',
     *                                'topic'               => 'New topic',
     *                              )
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
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
            throw new RequestException(json_decode($browser->getLastResponse()->getContent(), true));
        }

        return json_decode($response->getContent(), true);
    }

    /**
     * Common put request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array  $content  Parameters be putted for example:
     *                              array(
     *                                'name'                => 'Example name',
     *                                'privacy'             => 'private',
     *                                'is_archived'         => 'false',
     *                                'is_guest_accessible' => 'false',
     *                                'topic'               => 'New topic',
     *                              )
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
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
            throw new RequestException(json_decode($browser->getLastResponse()->getContent(), true));
        }

        return json_decode($response->getContent(), true);
    }

    public function delete($resource)
    {
        $curl = new Curl();
        $browser = new Browser($curl);

        $url = $this->baseUrl . $resource;

        $headers = array(
            'Authorization' => $this->auth->getCredential()
        );

        $response = $browser->delete($url, $headers);

        if ($browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($browser->getLastResponse()->getContent(), true));
        }

        return json_decode($response->getContent(), true);
    }
}
