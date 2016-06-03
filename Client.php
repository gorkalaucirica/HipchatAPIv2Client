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

    /** @var Browser */
    protected $browser;

    protected $rateLimit_Remaining = 500;
    protected $rateLimit_Reset = null;

    /**
     * Client constructor
     *
     * @param AuthInterface $auth Authentication you want to use to access the api
     * @param Browser $browser Client you want to use, by default browser with curl will be used
     *
     * @return self
     */
    public function __construct(AuthInterface $auth, Browser $browser = null)
    {
        $this->auth = $auth;
        if ($browser === null) {
            $client = new Curl();
            $this->browser = new Browser($client);
        }
        else {
            $this->browser = $browser;
        }
    }

    /**
     * Set the base URL for the requests. Defaults to the public API
     *     but this allows it to work with internal implementations too
     *
     * @param string $url URL to the HipChat server endpoint
     */
    public function setBaseUrl($url)
    {
        $this->baseUrl = $url;
    }

    /**
     * Common get request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array $query Parameters to filter the response for example array('max-results' => 50)
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
    public function get($resource, $query = array())
    {
        $url = $this->baseUrl . $resource;
        if (count($query) > 0) {
            $url .= "?";
        }

        foreach ($query as $key => $value) {
            $url .= "$key=$value&";
        }

        $headers = array("Authorization" => $this->auth->getCredential());
        $this->applyRateLimit();
        $response = $this->browser->get($url, $headers);

        if ($this->browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($this->browser->getLastResponse()->getContent(), true));
        }
        $this->updateRateHeaders($this->browser->getLastResponse()->getHeaders());

        return json_decode($response->getContent(), true);
    }

    /**
     * Common post request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array $content Parameters be posted for example:
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
        $url = $this->baseUrl . $resource;

        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->auth->getCredential()
        );

        $response = $this->browser->post($url, $headers, json_encode($content));
        $this->applyRateLimit();
        if ($this->browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($this->browser->getLastResponse()->getContent(), true));
        }
        $this->updateRateHeaders($this->browser->getLastResponse()->getHeaders());

        return json_decode($response->getContent(), true);
    }

    /**
     * Common put request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array $content Parameters be putted for example:
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
    public function put($resource, $content = array())
    {
        $url = $this->baseUrl . $resource;
        $headers = array(
            'Content-Type' => 'application/json',
            'Authorization' => $this->auth->getCredential()
        );

        $response = $this->browser->put($url, $headers, json_encode($content));
        $this->applyRateLimit();
        if ($this->browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($this->browser->getLastResponse()->getContent(), true));
        }
        $this->updateRateHeaders($this->browser->getLastResponse()->getHeaders());

        return json_decode($response->getContent(), true);
    }

    /**
     * Common delete request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
    public function delete($resource)
    {
        $url = $this->baseUrl . $resource;

        $headers = array(
            'Authorization' => $this->auth->getCredential()
        );

        $response = $this->browser->delete($url, $headers);
        $this->applyRateLimit();
        if ($this->browser->getLastResponse()->getStatusCode() > 299) {
            throw new RequestException(json_decode($this->browser->getLastResponse()->getContent(), true));
        }
        $this->updateRateHeaders($this->browser->getLastResponse()->getHeaders());

        return json_decode($response->getContent(), true);
    }

    protected function applyRateLimit()
    {

        if ( is_null($this->rateLimit_Reset)) {
            return ;
        }

        // Calculate number of seconds before reset
        $now = time();
        $remaining_time = $this->rateLimit_Reset - $now;

        if( $this->rateLimit_Remaining <= 0) {
            $sleep = $remaining_time;
        } else {
            // We are a little optimistic and floor so we don't delay when not needed
            $sleep = floor($remaining_time / $this->rateLimit_Remaining);
        }
        var_dump("Sleep time: " . $sleep);

        sleep($sleep);

    }

    protected function updateRateHeaders($headers)
    {
        //$pattern = 'X-Ratelimit-Remaining';
        $filter = function ($value) use (&$pattern) {
            if (substr($value,0,strlen($pattern)) == $pattern) {
                return true;
            } else{
                return false;
            }
        };
        $pattern = 'X-Ratelimit-Remaining';
        $remaining = array_filter($headers, $filter);
        if(count($remaining) == 1) {
            $matches = null;
            preg_match('~\w+: (?P<digit>\d+)~', current($remaining), $matches);
            $this->rateLimit_Remaining = $matches['digit'];
        }

        $pattern = 'X-Ratelimit-Reset';
        $reset = array_filter($headers, $filter);
        if(count($reset) == 1) {
            $matches = null;
            preg_match('~\w+: (?P<digit>\d+)~', current($reset), $matches);
            $this->rateLimit_Reset = $matches['digit'];
        }
    }
}
