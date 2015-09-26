<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 11:48 AM
 */

namespace Vague\NewsBrokerBundle\Tests;


abstract class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    const MASK_FIXTURES_PATH = '%s/%s/%s';
    const PATH_FIXTURES_RELATIVE = '../fixtures';
    const INDEX_CONTENT = 'content';
    const INDEX_URL = 'uri';
    const INDEX_RESULT = 'result';

    /**
     * @return mixed
     */
    abstract protected function _createTestObject();
}