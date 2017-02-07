<?php

/**
 * This example file, builds several example cards and sends them to the given Room (via $roomID), demonstrating the
 * basic usage of the Card classes.
 *
 * To run send the card, uncomment the line:
 * $room = $roomAPI->sendRoomNotification($roomID, $message);
 * at the end of each card block
 */

require_once __DIR__."/../vendor/autoload.php";

$roomID = 112233;
// See https://developer.atlassian.com/hipchat/guide/hipchat-rest-api/api-access-tokens to get your token
$oAuthToken = '__YOUR_TOKEN__HERE__';

use GorkaLaucirica\HipchatAPIv2Client\Auth\OAuth2;
use GorkaLaucirica\HipchatAPIv2Client\Client;
use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;
use GorkaLaucirica\HipchatAPIv2Client\Model\Card;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardImage;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardAttribute;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardFormat;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardThumbnail;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardStyle;
use GorkaLaucirica\HipchatAPIv2Client\Model\AttributeValueStyle;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardIcon;
use GorkaLaucirica\HipchatAPIv2Client\Model\CardActivity;


//All queries need the following two lines
$auth = new OAuth2($oAuthToken);
$client = new Client($auth);

/**
 * Direct implementations of the example cards at
 * https://developer.atlassian.com/hipchat/guide/sending-messages#SendingMessages-UsingCards
 */

/**
 * Card 1
 */
$message = new Message();
$message->setMessage("This is a implementation of example card 1");
$cardOne = new Card("Sample application card", CardStyle::application,
    "This is a description of an application object.\nwith 2 lines of text");
$cardOne->setFormat(CardFormat::medium);
$cardOne->setUrl("https://www.application.com/an-object");
$cardOne->setId("db797a68-0aff-4ae8-83fc-2e72dbb1a707");
$cardOneIcon = new CardIcon("http://bit.ly/1S9Z5dF");
$cardOne->setIcon($cardOneIcon);
$attr1 = new CardAttribute("value1");
$attr1->label = "attribute1";
$attr2 = new CardAttribute("value2");
$attr2->value->style = AttributeValueStyle::lozenge_complete;
$attr2->value->icon = "http://bit.ly/1S9Z5dF";
$attr2->label = "attribute2";
$cardOne->addAttribute($attr1);
$cardOne->addAttribute($attr2);
$message->setCard($cardOne);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

/**
 * Card 2
 */
echo "\n\n";

$message = new Message();
$message->setMessage("This is a implementation of example card 2");
$cardTwo = new Card("Sample application card", CardStyle::application,
    "This is a description of an application object.\nwith 2 lines of text");
$cardTwo->setFormat(CardFormat::medium);
$cardTwo->setUrl("https://www.application.com/an-object");
$cardTwo->setId("db797a68-0aff-4ae8-83fc-2e72dbb1a707");
$cardTwoIcon = new CardIcon("http://bit.ly/1S9Z5dF");
$cardTwo->setIcon($cardTwoIcon);
$attr1 = new CardAttribute("value1");
$attr1->label = "attribute1";
$attr2 = new CardAttribute("value2");
$attr2->value->style = AttributeValueStyle::lozenge_complete;
$attr2->value->icon = "http://bit.ly/1S9Z5dF";
$attr2->label = "attribute2";
$cardTwo->addAttribute($attr1);
$cardTwo->addAttribute($attr2);
$activity = new CardActivity("This is a notification about <b>an object</b>");
$cardTwo->setActivity($activity);
$message->setCard($cardTwo);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

/**
 * Card 3
 */
echo "\n\n";

$message = new Message();
$message->setMessage("This is a implementation of example card 3");
$cardThree = new Card("Sample image card", CardStyle::image, null);
$cardThree->setUrl("http://bit.ly/1TmKuKQ");
$cardThree->setId("172fe15d-d72e-4f78-8712-0ec74e7f9aa3");
$tempImage = new CardThumbnail("http://bit.ly/1TmKuKQ");
$tempImage->urlat2 = "http://bit.ly/1TmKuKQ";
$tempImage->height = 1193;
$tempImage->width = 564;
$cardThree->setThumbnail($tempImage);
$message->setCard($cardThree);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

/**
 * Card 4
 */
echo "\n\n";

$message = new Message();
$message->setMessage("This is a implementation of example card 4");
$cardFour = new Card("Sample link card", CardStyle::link,
    "This is some information about the link shared.\nin 2 lines of text");
$cardFour->setUrl("http://www.website.com/some-article");
$cardFour->setId("172fe15d-d72e-4f78-8712-0ec74e7f9aa3");
$tempImage = new CardThumbnail("http://bit.ly/1TmKuKQ");
$tempImage->urlat2 = "http://bit.ly/1TmKuKQ";
$tempImage->height = 1193;
$tempImage->width = 564;
$cardFour->setThumbnail($tempImage);
$tempIcon = new CardIcon("http://bit.ly/1Qrfs1M");
$cardFour->setIcon($tempIcon);
$message->setCard($cardFour);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

/**
 * Card 5
 */
echo "\n\n";

$message = new Message();
$message->setMessage("This is a implementation of example card 5");
$cardFive = new Card("Sample media card. Click me.", CardStyle::media,
    "Click on the title to open the image in the HipChat App");
$cardFive->setUrl("https://s3.amazonaws.com/uploads.hipchat.com/6/26/z6i8a5djb9mvq7m/bonochat.png");
$cardFive->setId("6492f0a6-9fa0-48cd-a3dc-2b19a0036e99");
$tempImage = new CardThumbnail("https://s3.amazonaws.com/uploads.hipchat.com/6/26/z6i8a5djb9mvq7m/bonochat.png");
$tempImage->urlat2 = "https://s3.amazonaws.com/uploads.hipchat.com/6/26/z6i8a5djb9mvq7m/bonochat.png";
$tempImage->height = 3313;
$tempImage->width = 577;
$cardFive->setThumbnail($tempImage);
$message->setCard($cardFive);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

echo "\n\n";

/**
 * Some extra cards
 */

/**
 * This is the nearly biggest card that one can generate
 */
$message = new Message();
$card = new Card("A Giant Card", CardStyle::application, "This is a very large card with\ntwo lines.");
$card->setFormat(CardFormat::medium);
$card->setUrl("https://www.hipchat.com/docs/apiv2/");
$cardIcon = new \GorkaLaucirica\HipchatAPIv2Client\Model\CardIcon(
    "http://d39kbiy71leyho.cloudfront.net/wp-content/uploads/2016/05/09170020/cats-politics-TN.jpg");
$cardIcon->urlat2 = "http://d39kbiy71leyho.cloudfront.net/wp-content/uploads/2016/05/09170020/cats-politics-TN.jpg";
$card->setIcon($cardIcon);
$thumbnail = new \GorkaLaucirica\HipchatAPIv2Client\Model\CardThumbnail(
    "http://d39kbiy71leyho.cloudfront.net/wp-content/uploads/2016/05/09170020/cats-politics-TN.jpg");
$image = new \GorkaLaucirica\HipchatAPIv2Client\Model\CardImage(
    "https://i.ytimg.com/vi/56ucT_Hw4bg/hqdefault.jpg");
$card->setImages($image);

$tempIcon = new CardIcon("http://d39kbiy71leyho.cloudfront.net/wp-content/uploads/2016/05/09170020/cats-politics-TN.jpg");
$tempIcon->urlat2 = "http://d39kbiy71leyho.cloudfront.net/wp-content/uploads/2016/05/09170020/cats-politics-TN.jpg";
$card->setIcon($tempIcon);

//Add some attributes
$tempAttribute = new CardAttribute("Suit");
$tempAttribute->label = "Clothing Type";
$tempAttribute->value->style = AttributeValueStyle::lozenge_complete;
$card->addAttribute($tempAttribute);
$tempAttribute = new CardAttribute("White");
$tempAttribute->label = "Background Color";
$attrIcon = new CardIcon("http://bit.ly/1S9Z5dF");
$tempAttribute->value->icon = $attrIcon;
$card->addAttribute($tempAttribute);

$message->setCard($card);

$message->setMessageFormat("text");
$message->setMessage("You don't appear to be on a client that supports Cards. But rest asured this would have been a
big card");
echo json_encode($message->toJson());

$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

echo "\n\n";
/**
 * An Image Card
 */
$message = new Message();
$message->setMessage("This is a image card.");
$card = new Card("An Image Card", CardStyle::image, "This is simply an image card.");
$tempImage = new CardThumbnail("http://purrfectcatbreeds.com/wp-content/uploads/2014/06/persian-cat7.jpg");
$tempImage->urlat2 = "http://purrfectcatbreeds.com/wp-content/uploads/2014/06/persian-cat7.jpg";
$tempImage->height = 500;
$tempImage->width = 500;
$card->setThumbnail($tempImage);
$card->setUrl("https://hipchat.com");
$message->setCard($card);
echo json_encode($message->toJson());
$roomAPI = new RoomAPI($client);
//$room = $roomAPI->sendRoomNotification($roomID, $message);

