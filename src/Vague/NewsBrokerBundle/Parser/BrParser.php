<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 04/10/2015
 * Time: 2:58 PM
 */

namespace Vague\NewsBrokerBundle\Parser;

use Vague\NewsBrokerBundle\DataContainer\RssItem;

class BrParser extends BaseParser
{
    const REGEX_UTF_SYMBOLS = '/\\u(\w+)/i';
    const REGEX_FEED_ID = '/pid\=(\d+)/i';
    const REPLACEMENT = '&#$1;';
    const INDEX_CONTENT = 'bodytext';
    const INDEX_EVENT_DATE = 'date';
    const INDEX_TITLE = 'title';
    const INDEX_URI = 'pagepath';
    const XPATH_DESCRIPTION = '//div[@class="teaserContainer"]/div[@class="bottomPart"]/p';
    const REGEX_DESCRIPTION = '/\<p\s+class=\"[^\"]+\"\s*\>([\w\s\&;,.-]+)\<\/p\>/i';
    const URL_BASE = 'http://www.br-automation.com';

    /**
     * @param string $source
     * @return array
     */
    public function parse($source)
    {
        $data = json_decode($source, true);
        $result = array();
        if (isset($data['records'])) {
            foreach ($data['records'] as $record) {
                $container = new RssItem();
                $container->setTitle($record[static::INDEX_TITLE]);
                $container->setEventDate(new \DateTime($record[static::INDEX_EVENT_DATE]));
                $container->setDescription($this->parseDescription($record[static::INDEX_CONTENT]));
                $url = $this->prepareUrl($record[static::INDEX_URI]);
                $container->setUrl($url);
                $container->setGUID($url);
                $result[] = $container;
            }
        }
        return $result;
    }

    public function getNewsFeedId($source)
    {
        preg_match(static::REGEX_FEED_ID, $source, $m);
        return $m[1];
    }

    protected function parseDescription($description)
    {
        $this->_initialize($description);
        return $this->_xpath->query(static::XPATH_DESCRIPTION)->item(0)->nodeValue;
    }

    protected function prepareUrl($uri)
    {
        return sprintf(static::MASK_FULL_URL, static::URL_BASE, $uri);
    }
}