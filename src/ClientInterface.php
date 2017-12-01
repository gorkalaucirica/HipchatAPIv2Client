<?php
/**
 * Created by solutionDrive GmbH.
 *
 * @author:    Tobias Lückel <tl@solutionDrive.de>
 * @date:      01.12.17
 * @time:      13:11
 * @copyright: 2017 solutionDrive GmbH
 */

namespace GorkaLaucirica\HipchatAPIv2Client;

interface ClientInterface
{
    /**
     * Set the base URL for the requests. Defaults to the public API
     *     but this allows it to work with internal implementations too
     *
     * @param string $url URL to the HipChat server endpoint
     *
     * @deprecated Use constructor to change default baseUrl instead, will be removed in 2.0
     */
    public function setBaseUrl($url);

    /**
     * Common get request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     * @param array $query Parameters to filter the response for example array('max-results' => 50)
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
    public function get($resource, $query = array());

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
    public function post($resource, $content);

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
    public function put($resource, $content = array());

    /**
     * Common delete request for all API calls
     *
     * @param string $resource The path to the resource wanted. For example v2/room
     *
     * @return array Decoded array containing response
     * @throws Exception\RequestException
     */
    public function delete($resource);
}