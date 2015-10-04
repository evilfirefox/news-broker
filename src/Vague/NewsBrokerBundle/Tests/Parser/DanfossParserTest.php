<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:36 AM
 */

namespace Vague\NewsBrokerBundle\Tests\Parser;

use Vague\NewsBrokerBundle\Parser\DanfossParser;
use Vague\NewsBrokerBundle\Tests\BaseParserTestCase;

class DanfossParserTest extends BaseParserTestCase
{
    const PATH_FILE = 'danfoss.html';
    const VALUE_ROWS_COUNT = 10;
    const VALUE_CATEGORY = 'Corporate';
    const VALUE_DATE = '2015-Sep-24';
    const VALUE_TITLE = 'Danfoss’ innovative icon achieves international award';
    const VALUE_URL = 'http://www.danfoss.com/newsstories/cf/danfoss-innovative-icon-achieves-international-award/?ref=17179879839';
    const VALUE_DESCRIPTION = null;

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

        return array(
            array(
                'success' => array(
                    static::INDEX_CONTENT => $content,
                    static::INDEX_ROWS_COUNT => static::VALUE_ROWS_COUNT,
                    static::INDEX_RESULT => $this->_createMockRssItem(),
                ),
            )
        );
    }

    protected function _createTestObject()
    {
        return new DanfossParser();
    }
}
