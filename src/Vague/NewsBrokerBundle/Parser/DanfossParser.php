<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:16 AM
 */

namespace Vague\NewsBrokerBundle\Parser;


use Vague\NewsBrokerBundle\DataContainer\RssItem;

class DanfossParser extends BaseParser
{
    const FORMAT_DATETIME = 'Y-M-d';
    const XPATH_ROWS = '//div[@class="tl-table"]/div[@class="tl-row"]';
    const XPATH_URL = 'div[@class="col1 name-type"]/a';
    const XPATH_CATEGORY = 'div[@class="col2 keywords"]';
    const XPATH_DATE_YEAR = 'div[@class="col0 date"]/div[@class="date-year"]';
    const XPATH_DATE_MONTH = 'div[@class="col0 date"]/div[@class="date-month"]';
    const XPATH_DATE_DAY = 'div[@class="col0 date"]/div[@class="date-number"]';
    const BASE_DOMAIN = 'http://www.danfoss.com';

    /**
     * @param string $source
     * @return mixed
     */
    public function parse($source)
    {
        $this->_initialize($source);
        $result = array();
        $rowsList = $this->_xpath->query(static::XPATH_ROWS);
        foreach ($rowsList as $row) {
            $item = new RssItem();
            $target = $this->_xpath->query(static::XPATH_URL, $row)->item(0);
            $url = sprintf(static::MASK_FULL_URL, static::BASE_DOMAIN, trim($target->attributes->getNamedItem('href')->nodeValue));
            $year = trim($this->_xpath->query(static::XPATH_DATE_YEAR, $row)->item(0)->nodeValue);
            $month = trim($this->_xpath->query(static::XPATH_DATE_MONTH, $row)->item(0)->nodeValue);
            $day = trim($this->_xpath->query(static::XPATH_DATE_DAY, $row)->item(0)->nodeValue);
            $eventDate = \DateTime::createFromFormat(static::FORMAT_DATETIME, sprintf(static::MASK_DATETIME, $year, $month, $day));
            $item->setEventDate($eventDate);
            $item->setTitle(trim($target->nodeValue));
            $item->setUrl($url);
            $item->setGUID($url);
            $item->setCategory(trim($this->_xpath->query(static::XPATH_CATEGORY, $row)->item(0)->nodeValue));
            $result[] = $item;
        }
        return $result;
    }
}