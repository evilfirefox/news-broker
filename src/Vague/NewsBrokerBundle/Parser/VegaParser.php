<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 30/11/2015
 * Time: 8:22 PM
 */

namespace Vague\NewsBrokerBundle\Parser;


use Vague\NewsBrokerBundle\DataContainer\RssItem;

class VegaParser extends BaseParser
{
    const BASIC_URL = 'http://www.vega.com';
    const XPATH_ROWS = '//article';
    const XPATH_TITLE = './/a[@class="headline"]';
    const XPATH_URL = './/p[@class="news-link"]/a';
    const XPATH_DESCRIPTION = './/div[@class="col-sm-12"]';
    const XPATH_DATE = './/span[@class="date pull-right"]';

    /**
     * @param string $source
     * @return array
     */
    public function parse($source)
    {
        $this->_initialize($source);
        $rows = $this->_xpath->query(static::XPATH_ROWS);
        $result = array();
        foreach ($rows as $article) {
            $rssItem = new RssItem();
            $rssItem->setTitle(trim($this->_xpath->query(static::XPATH_TITLE, $article)->item(0)->nodeValue));
            $url = sprintf(static::MASK_FULL_URL, static::BASIC_URL, trim($this->_xpath->query(static::XPATH_URL, $article)->item(0)->attributes->getNamedItem('href')->nodeValue));
            $rssItem->setGUID($url);
            $rssItem->setUrl($url);
            $descriptionNode = $this->_xpath->query(static::XPATH_DESCRIPTION, $article)->item(0);
            $descriptionNode->removeChild($descriptionNode->childNodes->item(1));
            $rssItem->setDescription(trim($descriptionNode->nodeValue));
            $rssItem->setEventDate(new \DateTime($this->_xpath->query(static::XPATH_DATE, $article)->item(0)->nodeValue));
            $result[] = $rssItem;
        }
        return $result;
    }
}