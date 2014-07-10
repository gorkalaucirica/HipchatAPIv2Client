#Hipchat v2 Api Client

PHP Library to process calls to Hipchat's v2 REST API

[![Latest Stable Version](https://poser.pugx.org/gorkalaucirica/hipchat-v2-api-client/v/stable.svg)](https://packagist.org/packages/gorkalaucirica/hipchat-v2-api-client)
[![Total Downloads](https://poser.pugx.org/gorkalaucirica/hipchat-v2-api-client/downloads.svg)](https://packagist.org/packages/gorkalaucirica/hipchat-v2-api-client)
[![Latest Unstable Version](https://poser.pugx.org/gorkalaucirica/hipchat-v2-api-client/v/unstable.svg)](https://packagist.org/packages/gorkalaucirica/hipchat-v2-api-client)
[![License](https://poser.pugx.org/gorkalaucirica/hipchat-v2-api-client/license.svg)](https://packagist.org/packages/gorkalaucirica/hipchat-v2-api-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gorkalaucirica/HipchatAPIv2Client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gorkalaucirica/HipchatAPIv2Client/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/6c8dd8cc-f8d8-4d1c-b089-d52dd29a1ef7/mini.png)](https://insight.sensiolabs.com/projects/6c8dd8cc-f8d8-4d1c-b089-d52dd29a1ef7)

*This package is work in progress and some functionality is not available yet.*

##Installation

The recommended way to install Hipchatv2ApiClient is through composer. Just create a composer.json file and run the php
composer.phar install command to install it:

    "require": {
        "gorkalaucirica/hipchat-v2-api-client": "dev-master"
    }

##Usage

All queries need the following two lines. The first one is to authenticate yourself and the second one creates a
client that is used by the API classes to perform requests to the API. That is enough to start, now check the API calls
section to see how to use the `$client` to send requests to the API.

    $auth = new OAuth2('tokenYouCanGetInHipchatSite');
    $client = new Client($auth);

##API calls

All API call methods are located in the API folder. All of them have been documented and all have a link to Hipchat v2
API documentation. Some examples:

####Getting user by mention name:

    $userAPI = new UserAPI($client);
    $user = $userAPI->getUser('@gorkalaucirica');

####Getting all rooms

    $roomAPI = new RoomAPI($client);
    $room = $roomAPI->getRooms(array('max-results' => 30));

##TODO

* Still many calls are missing (will be added as soon as posible)

