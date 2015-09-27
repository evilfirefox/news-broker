<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:23 AM
 */

namespace Vague\NewsBrokerBundle\Interfaces;


interface DataContainerInterface
{

    /**
     * @return \DateTime
     */
    public function getEventDate();

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @return string
     */
    public function getDescription();

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getGUID();

    /**
     * @return string
     */
    public function getCategory();

    /**
     * @param \DateTime $eventDate
     */
    public function setEventDate(\DateTime $eventDate);

    /**
     * @param string $title
     */
    public function setTitle($title);

    /**
     * @param string $description
     */
    public function setDescription($description);

    /**
     * @param string $url
     */
    public function setUrl($url);

    /**
     * @param string $guid
     */
    public function setGUID($guid);

    /**
     * @param string $category
     */
    public function setCategory($category);
}