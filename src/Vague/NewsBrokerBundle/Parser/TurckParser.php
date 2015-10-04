<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 03/10/2015
 * Time: 7:34 PM
 */

namespace Vague\NewsBrokerBundle\Parser;


use Vague\NewsBrokerBundle\DataContainer\RssItem;

class TurckParser extends BaseParser
{
    const XPATH_ROWS = '//body/table[2]/tr/td[1]/table/tr/td/table[2]/tr/td/table[not(@bgcolor)]';
    const XPATH_TITLE = 'tr[1]/td';
    const XPATH_DESCRIPTION = 'tr[2]/td[2]/a';
    const BASE_DOMAIN = 'http://www.turck.ru/';
    const REGEX_EXTRA_TRIM = '/^\s/iu';

    /**
     * @param string $source
     * @return array
     */
    public function parse($source)
    {
        $this->_initialize($source);
        $result = array();
        $rows = $this->_xpath->query(static::XPATH_ROWS);
        foreach ($rows as $row) {
            $item = new RssItem();
            $item->setTitle(preg_replace(static::REGEX_EXTRA_TRIM, '', trim($this->_xpath->query(static::XPATH_TITLE, $row)->item(0)->nodeValue)));
            $description = $this->_xpath->query(static::XPATH_DESCRIPTION, $row)->item(0);
            $url = sprintf(static::MASK_FULL_URL, static::BASE_DOMAIN, trim($description->attributes->getNamedItem(static::ATTRIBUTE_HREF)->nodeValue));
            $item->setUrl($url);
            $item->setGUID($url);
            $item->setDescription(trim($description->nodeValue));
            $result[] = $item;
        }
        return $result;
    }
}