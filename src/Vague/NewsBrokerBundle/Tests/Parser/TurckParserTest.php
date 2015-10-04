<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 03/10/2015
 * Time: 7:44 PM
 */

namespace Vague\NewsBrokerBundle\Tests\Parser;


use Vague\NewsBrokerBundle\Parser\TurckParser;
use Vague\NewsBrokerBundle\Tests\BaseParserTestCase;

class TurckParserTest extends BaseParserTestCase
{
    const PATH_FILE = 'turck.html';
    const VALUE_ROWS_COUNT = 5;
    const VALUE_CATEGORY = null;
    const VALUE_DATE = null;
    const VALUE_TITLE = 'Новое поколение интерфейсных модулей серии IMX';
    const VALUE_DESCRIPTION = 'Компания Turck представляет новое поколение барьеров искрозащиты IMX.';
    const VALUE_URL = 'http://www.turck.ru/news_803.htm';

    /**
     * @param array $testData
     * @dataProvider parserDataProvider
     */
    public function testParse(array $testData)
    {
        $object = $this->_createTestObject();
        $result = $object->parse($testData[static::INDEX_CONTENT]);
        $this->assertEquals(static::VALUE_ROWS_COUNT, count($result));
        $this->assertInstanceOf(static::CLASS_RSS_ITEM, $result[1]);
        $this->assertEquals($testData[static::INDEX_RESULT], $result[1]);
    }

    public function parserDataProvider()
    {
        $content = file_get_contents(sprintf(static::MASK_FIXTURES_PATH, __DIR__, static::PATH_FIXTURES_RELATIVE, static::PATH_FILE));
        return array(
            array(
                'success' => array(
                    static::INDEX_CONTENT => $content,
                    static::INDEX_ROWS_COUNT => static::VALUE_ROWS_COUNT,
                    static::INDEX_RESULT => $this->_createMockRssItem(),
                ),
            ),
        );
    }

    /**
     * @return TurckParser
     */
    protected function _createTestObject()
    {
        return new TurckParser();
    }
}
