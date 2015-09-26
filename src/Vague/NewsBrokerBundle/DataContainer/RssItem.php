<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:31 AM
 */

namespace Vague\NewsBrokerBundle\DataContainer;


use Vague\NewsBrokerBundle\Interfaces\DataContainerInterface;

class RssItem implements DataContainerInterface
{

    /**
     * @var \DateTime
     */
    protected $_date;
    /**
     * @var string
     */
    protected $_title;
    /**
     * @var string
     */
    protected $_description;
    /**
     * @var string
     */
    protected $_url;
    /**
     * @var string
     */
    protected $_guid;
    /**
     * @var string
     */
    protected $_category;

    /**
     * @return \DateTime
     */
    public function getEventDate()
    {
        return $this->_date;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * @return string
     */
    public function getDescriptino()
    {
        return $this->_description;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @return string
     */
    public function getGUID()
    {
        return $this->_guid;
    }

    /**
     * @param \DateTime $eventDate
     */
    public function setEventDate(\DateTime $eventDate)
    {
        $this->_date = $eventDate;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->_title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }

    /**
     * @param string $guid
     */
    public function setGUID($guid)
    {
        $this->_guid = $guid;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->_category = $category;
    }
}