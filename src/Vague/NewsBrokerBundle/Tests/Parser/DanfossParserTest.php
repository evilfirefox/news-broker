<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:36 AM
 */

namespace Vague\NewsBrokerBundle\Tests\Parser;

use Vague\NewsBrokerBundle\DataContainer\RssItem;
use Vague\NewsBrokerBundle\Parser\DanfossParser;
use Vague\NewsBrokerBundle\Tests\BaseTestCase;

class DanfossParserTest extends BaseTestCase
{
    const INDEX_ROWS_COUNT = 'rows_count';
    const PATH_FILE = 'danfoss.html';
    const VALUE_ROWS_COUNT = 10;
    const VALUE_CATEGORY = 'Corporate';
    const VALUE_DATE = '2015-Sep-24';
    const VALUE_TITLE = 'Danfoss’ innovative icon achieves international award';
    const VALUE_URL = 'http://www.danfoss.com/newsstories/cf/danfoss-innovative-icon-achieves-international-award/?ref=17179879839';
    const CLASS_RSS_ITEM = '\Vague\NewsBrokerBundle\DataContainer\RssItem';
    const CLASS_DOM_EXCEPTION = '\Vague\NewsBrokerBundle\Exception\FailedToLoadDomException';

    /**
     * @param array $testData
     * @dataProvider parseDataProvider
     */
    public function testParse(array $testData)
    {
        $object = $this->_createTestObject();
        $result = $object->parse($testData[static::INDEX_CONTENT]);
        $this->assertEquals($testData[static::INDEX_ROWS_COUNT], count($result));
        $this->assertInstanceOf(static::CLASS_RSS_ITEM, $result[0]);
        $this->assertEquals($testData[static::INDEX_RESULT], $result[0]);
    }

    public function testParseFailure()
    {
        $object = $this->_createTestObject();
        try {
            $object->parse('');
            $this->fail('Exception should be thrown with no HTML found');
        } catch (\Exception $e) {
            $this->assertInstanceOf(static::CLASS_DOM_EXCEPTION, $e);
        }
    }

    public function parseDataProvider()
    {
        $content = file_get_contents(sprintf(static::MASK_FIXTURES_PATH, __DIR__, static::PATH_FIXTURES_RELATIVE, static::PATH_FILE));
        $item = new RssItem();
        $item->setEventDate(\DateTime::createFromFormat(DanfossParser::FORMAT_DATETIME, static::VALUE_DATE));
        $item->setTitle(static::VALUE_TITLE);
        $item->setUrl(static::VALUE_URL);
        $item->setGUID(static::VALUE_URL);
        $item->setCategory(static::VALUE_CATEGORY);

        return array(
            array(
                'success' => array(
                    static::INDEX_CONTENT => $content,
                    static::INDEX_ROWS_COUNT => static::VALUE_ROWS_COUNT,
                    static::INDEX_RESULT => $item,
                ),
            )
        );
    }

    protected function _createTestObject()
    {
        return new DanfossParser();
    }
}
