<?php
/**
 * User: chipwasson
 * Date: 1/25/17
 * Time: 6:47 PM
 */

namespace GorkaLaucirica\HipchatAPIv2Client\Model;


class Card
{
    /**
     * @var CardStyle $style @required
     * Type of the card
     * Valid length range: 1 - 16.
     * Valid values: file, image, application, link, media.
     */
    protected $style;
    /**
     * @var string $description @required
     *
     */
    protected $description;
    /**
     * @var CardFormat $format
     * Application cards can be compact (1 to 2 lines) or medium (1 to 5 lines)
     * Valid length range: 1 - 25.
     * Valid values: compact, medium.
     */
    protected $format;
    /**
     * @var string $url
     */
    protected $url;
    /**
     * @var string $title @required
     */
    protected $title;
    /**
     * @var CardThumbnail $thumbnail
     */
    protected $thumbnail;
    /**
     * @var CardActivity $activity
     */
    protected $activity;
    /**
     * @var CardAttribute[] $attributes
     */
    protected $attributes;
    /**
     * @var string $id @required
     */
    protected $id;
    /**
     * @var CardIcon $icon
     */
    protected $icon;
    /**
     * @var CardImage $images
     */
    protected $images;

    /**
     * @return CardStyle
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param CardStyle $style
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return CardFormat
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param CardFormat $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return CardThumbnail
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param CardThumbnail $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return CardActivity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * @param CardActivity $activity
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }

    /**
     * @return CardAttribute[]
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param CardAttribute $attribute
     */
    public function addAttribute($attribute)
    {
        if (!isset($this->attributes)){
            $this->attributes = array();
        }
        $this->attributes[] = $attribute;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return CardIcon
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param CardIcon $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @return CardImage
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param CardImage $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    public function toArray(){
        $result = array();
        if ($this->style) $result['style'] = $this->style;
        if ($this->description) $result['description'] = $this->description;
        if ($this->format) $result['format'] = $this->format;
        if ($this->url) $result['url'] = $this->url;
        if ($this->title) $result['title'] = $this->title;
        if ($this->thumbnail) $result['thumbnail'] = $this->thumbnail->toArray();
        if ($this->activity) $result['activity'] = $this->activity;
        if ($this->attributes) {
            $result['attributes'] = array();
            foreach ($this->attributes as $attribute) {
                $result['attributes'][] = $attribute->toArray();
            }
        }
        if ($this->images) $result['images'] = $this->images->toArray();
        if ($this->id) $result['id'] = $this->id;
        if ($this->icon) $result['icon'] = $this->icon->toArray();
        return $result;
    }

}

class CardImage {
    /**
     * @var string $image Image url
     */
    public $image;

    public function toArray(){
        $result = array();
        if ($this->image) $result['image'] = $this->image;
        return $result;
    }
}

class CardAttribute {
    /**
     * @var CardAttributeValue $value @required
     * @var string $label Valid length range: 1 - 50.
     */
    public $value;
    public $label;

    public function __construct()
    {
        $this->value = new CardAttributeValue();
    }

    public function toArray(){
        $result = array();
        if ($this->value) $result['value'] = $this->value;
        if ($this->label) $result['label'] = $this->label;
        return $result;
    }
}

class CardAttributeValue {
    /**
     * @var string $url Url to be opened when a user clicks on the label. Valid length range: 1 - unlimited.
     * @var AttributeValueStyle $style
     * @var string $label
     * @var CardIcon $icon
     */
    public $url;
    public $style;
    public $label;
    public $icon;

    public function toArray(){
        $result = array();
        if ($this->url) $result['url'] = $this->url;
        if ($this->style) $result['style'] = $this->style;
        if ($this->label) $result['label'] = $this->label;
        if ($this->icon) $result['icon'] = $this->icon;
        return $result;
    }
}

/**
 * The activity will generate a collapsable card of one line showing
 * the html and the ability to maximize to see all the content.
 *
 * @package GorkaLaucirica\HipchatAPIv2Client\Model
 */
class CardActivity {
    /**
     * @var string $html Html for the activity to show in one line a summary of the action that happened
     * Valid length range: 1 - unlimited. @required
     * @var CardIcon $icon
     */
    public $html;
    public $icon;

    public function toArray(){
        $result = array();
        if ($this->html) $result['html'] = $this->html;
        if ($this->icon) $result['icon'] = $this->icon;
        return $result;
    }
}

/**
 * An object with the following properties.
 * @package GorkaLaucirica\HipchatAPIv2Client\Model
 */
class CardIcon {
    /**
     * @var string $url The url where the icon is Valid length range: 1 - unlimited. @required
     * @var string $urlat2 The url for the icon in retina. Valid length range: 1 - unlimited.
     */
    public $url;
    public $urlat2;

    public function toArray(){
        $result = array();
        if ($this->url) $result['url'] = $this->url;
        if ($this->urlat2) $result['urlat2'] = $this->urlat2;
        return $result;
    }
}

/**
 * An object with the following properties.
 * @package GorkaLaucirica\HipchatAPIv2Client\Model
 */
class CardThumbnail {
    /**
     * @var string $url The thumbnail url. Valid length range: 1 - 250. @required
     * @var integer $width The original width of the image
     * @var string $urlat2 The thumbnail url in retina. Valid length range: 1 - 250.
     * @var integer $height The original height of the image
     */
    public $url;
    public $width;
    public $urlat2;
    public $height;

    public function toArray(){
        $result = array();
        if ($this->url) $result['value'] = $this->url;
        if ($this->width) $result['width'] = $this->width;
        if ($this->urlat2) $result['urlat2'] = $this->urlat2;
        if ($this->height) $result['height'] = $this->height;
        return $result;
    }
}

abstract class CardStyle {
    const file = "file";
    const image = "image";
    const application = "application";
    const link = "link";
    const media = "media";
}

abstract class CardFormat {
    const compact = "compact";
    const medium = "medium";
}

abstract class AttributeValueStyle {
    const lozenge_success = "lozenge-success";
    const lozenge_error = "lozenge-error";
    const lozenge_current = "lozenge-current";
    const lozenge_complete = "lozenge-complete";
    const lozenge_moved = "lozenge-moved";
    const lozenge = "lozenge";
}