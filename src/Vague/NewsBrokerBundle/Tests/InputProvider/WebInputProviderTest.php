<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:49 AM
 */

namespace Vague\NewsBrokerBundle\Tests\InputProvider;

use Vague\NewsBrokerBundle\InputProvider\WebInputProvider;
use Vague\NewsBrokerBundle\Tests\BaseTestCase;

class WebInputProviderTest extends BaseTestCase
{
    const PATH_FILE = 'danfoss.html';

    /**
     * @param array $testData
     * @dataProvider getContentDataProvider
     */
    public function testGetContent(array $testData)
    {
        $object = $this->_createTestObject();
        $result = $object->getContent($testData[static::INDEX_URL]);
        $this->assertTrue(is_string($result));
        $this->assertEquals($testData[static::INDEX_CONTENT], $result);
    }

    public function getContentDataProvider()
    {
        $path = sprintf(static::MASK_FIXTURES_PATH, __DIR__, static::PATH_FIXTURES_RELATIVE, static::PATH_FILE);
        $content = file_get_contents($path);
        return array(
            array(
                'success' => array(
                    static::INDEX_URL => $path,
                    static::INDEX_CONTENT => $content,
                ),
            ),
        );
    }

    protected function _createTestObject()
    {
        return new WebInputProvider();
    }
}
