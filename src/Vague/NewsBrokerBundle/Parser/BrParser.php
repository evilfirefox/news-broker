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
        $data = json_decode($this->convertEncoding($source), true);
        $result = array();
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
        return $result;
    }

    public function getNewsFeedId($source)
    {
        preg_match(static::REGEX_FEED_ID, $source, $m);
        return $m[1];
    }

    protected function parseDescription($description)
    {
        $this->_initialize($description, true);
        return $this->_xpath->query(static::XPATH_DESCRIPTION)->item(0)->nodeValue;
    }

    protected function prepareUrl($uri)
    {
        return sprintf(static::MASK_FULL_URL, static::URL_BASE, $uri);
    }

    protected function convertEncoding($source)
    {
        return strtr($source, array("\\u0430" => "а", "\\u0431" => "б", "\\u0432" => "в",
                "\\u0433" => "г", "\\u0434" => "д", "\\u0435" => "е", "\\u0451" => "ё", "\\u0436" => "ж", "\\u0437" => "з", "\\u0438" => "и",
                "\\u0439" => "й", "\\u043a" => "к", "\\u043b" => "л", "\\u043c" => "м", "\\u043d" => "н", "\\u043e" => "о", "\\u043f" => "п",
                "\\u0440" => "р", "\\u0441" => "с", "\\u0442" => "т", "\\u0443" => "у", "\\u0444" => "ф", "\\u0445" => "х", "\\u0446" => "ц",
                "\\u0447" => "ч", "\\u0448" => "ш", "\\u0449" => "щ", "\\u044a" => "ъ", "\\u044b" => "ы", "\\u044c" => "ь", "\\u044d" => "э",
                "\\u044e" => "ю", "\\u044f" => "я", "\\u0410" => "А", "\\u0411" => "Б", "\\u0412" => "В", "\\u0413" => "Г", "\\u0414" => "Д",
                "\\u0415" => "Е", "\\u0401" => "Ё", "\\u0416" => "Ж", "\\u0417" => "З", "\\u0418" => "И", "\\u0419" => "Й", "\\u041a" => "К",
                "\\u041b" => "Л", "\\u041c" => "М", "\\u041d" => "Н", "\\u041e" => "О", "\\u041f" => "П", "\\u0420" => "Р", "\\u0421" => "С",
                "\\u0422" => "Т", "\\u0423" => "У", "\\u0424" => "Ф", "\\u0425" => "Х", "\\u0426" => "Ц", "\\u0427" => "Ч", "\\u0428" => "Ш",
                "\\u0429" => "Щ", "\\u042a" => "Ъ", "\\u042b" => "Ы", "\\u042c" => "Ь", "\\u042d" => "Э", "\\u042e" => "Ю", "\\u042f" => "Я")
        );
    }
}