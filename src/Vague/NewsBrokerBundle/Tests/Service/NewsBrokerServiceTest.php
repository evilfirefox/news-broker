<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 27/09/2015
 * Time: 4:14 PM
 */

namespace Vague\NewsBrokerBundle\Tests\Service;


use Vague\NewsBrokerBundle\Service\NewsBrokerService;
use Vague\NewsBrokerBundle\Tests\BaseTestCase;

class NewsBrokerServiceTest extends BaseTestCase
{
    const INDEX_KEY = 'key';
    const VALUE_KEY = 'testKey';
    const VALUE_URL = 'testUrl';
    const VALUE_CONTENT = 'content';
    const CLASS_INPUT_PROVIDER = 'Vague\NewsBrokerBundle\Interfaces\InputProviderInterface';
    const CLASS_PARSER = 'Vague\NewsBrokerBundle\Interfaces\ParserInterface';

    /**
     * @param array $testData
     * @dataProvider processDataProvider
     */
    public function testProcess(array $testData)
    {
        $inputProviderMock = $this->getMockBuilder(static::CLASS_INPUT_PROVIDER)
            ->getMock();
        $inputProviderMock->expects($this->once())
            ->method('getContent')
            ->with($this->equalTo($testData[static::INDEX_URL]))
            ->will($this->returnValue($testData[static::INDEX_CONTENT]));
        $parserMock = $this->getMockBuilder(static::CLASS_PARSER)
            ->getMock();
        $parserMock->expects($this->once())
            ->method('parse')
            ->with($this->equalTo($testData[static::INDEX_CONTENT]))
            ->will($this->returnValue(array()));

        $object = $this->_createTestObject();
        $object->registerInputProvider($testData[static::INDEX_KEY], $testData[static::INDEX_URL], $inputProviderMock);
        $object->registerParser($testData[static::INDEX_KEY], $parserMock);
        $result = $object->process($testData[static::INDEX_KEY]);
        $this->assertTrue(is_array($result));
    }

    public function processDataProvider()
    {
        return array(
            array(
                'success' => array(
                    static::INDEX_KEY => static::VALUE_KEY,
                    static::INDEX_URL => static::VALUE_URL,
                    static::INDEX_CONTENT => static::VALUE_CONTENT,
                ),
            ),
        );
    }

    /**
     * @return NewsBrokerService
     */
    protected function _createTestObject()
    {
        return new NewsBrokerService();
    }
}
