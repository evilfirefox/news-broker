<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 03/10/2015
 * Time: 8:53 PM
 */

namespace Vague\NewsBrokerBundle\Parser;

use Vague\NewsBrokerBundle\Exception\FailedToLoadDomException;
use Vague\NewsBrokerBundle\Interfaces\ParserInterface;

abstract class BaseParser implements ParserInterface
{
    const MESSAGE_DOM_EXCEPTION = 'Invalid source provided';
    const MASK_FULL_URL = '%s%s';
    const MASK_DATETIME = '%s-%s-%s';
    const MASK_UTF8_DOC = '<html><head><meta charset="UTF-8"></head><body>%s</body></html>';
    const ATTRIBUTE_HREF = 'href';
    /**
     * @var \DOMDocument
     */
    protected $_dom;
    /**
     * @var \DOMXPath
     */
    protected $_xpath;

    protected function _initialize($source, $requiresFix = false)
    {
        if ($requiresFix) {
            $source = $this->fixInvalidHtml($source);
        }
        $this->_dom = new \DOMDocument();
        if (!@$this->_dom->loadHTML($source)) {
            throw new FailedToLoadDomException(static::MESSAGE_DOM_EXCEPTION);
        }
        $this->_xpath = new \DOMXPath($this->_dom);
    }

    protected function fixInvalidHtml($source)
    {
        return sprintf(static::MASK_UTF8_DOC, $source);
    }

    /**
     * @param string $source
     * @return array
     */
    abstract public function parse($source);
}