<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 03/10/2015
 * Time: 8:31 PM
 */

namespace Vague\NewsBrokerBundle\Tests;


use Vague\NewsBrokerBundle\DataContainer\RssItem;

abstract class BaseParserTestCase extends BaseTestCase
{
    const FORMAT_DATETIME = 'Y-M-d';
    const INDEX_ROWS_COUNT = 'rows_count';
    const CLASS_RSS_ITEM = '\Vague\NewsBrokerBundle\DataContainer\RssItem';
    const CLASS_DOM_EXCEPTION = '\Vague\NewsBrokerBundle\Exception\FailedToLoadDomException';
    const VALUE_CATEGORY = null;
    const VALUE_DATE = null;
    const VALUE_TITLE = null;
    const VALUE_URL = null;
    const VALUE_DESCRIPTION = null;

    protected function _createMockRssItem()
    {
        $item = new RssItem();
        if (!is_null(static::VALUE_DATE)) {
            $item->setEventDate(\DateTime::createFromFormat(static::FORMAT_DATETIME, static::VALUE_DATE));
        }
        $item->setTitle(static::VALUE_TITLE);
        $item->setUrl(static::VALUE_URL);
        $item->setGUID(static::VALUE_URL);
        $item->setCategory(static::VALUE_CATEGORY);
        $item->setDescription(static::VALUE_DESCRIPTION);
        return $item;
    }
}