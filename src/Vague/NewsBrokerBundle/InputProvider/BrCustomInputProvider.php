<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 29/11/2015
 * Time: 11:57 AM
 */

namespace Vague\NewsBrokerBundle\InputProvider;


use Vague\NewsBrokerBundle\Interfaces\InputProviderInterface;
use Vague\NewsBrokerBundle\Parser\BrParser;

class BrCustomInputProvider implements InputProviderInterface
{
    const MASK_DATA = 'method=getTeaserList&L=19&params[type]=doc.news&params[itemsPerPage]=20&params[page]=1&params[parentPage]=%s';

    /**
     * @var WebInputProvider
     */
    protected $webInputProvider;
    /**
     * @var CurlInputProvider
     */
    protected $curlInputProvider;
    /**
     * @var BrParser
     */
    protected $parser;
    /**
     * @var string
     */
    protected $mainSource;

    function __construct(WebInputProvider $webInputProvider, CurlInputProvider $curlInputProvider, BrParser $parser, $mainSource)
    {
        $this->webInputProvider = $webInputProvider;
        $this->curlInputProvider = $curlInputProvider;
        $this->mainSource = $mainSource;
        $this->parser = $parser;
    }

    /**
     * @param string $source
     * @return string
     */
    public function getContent($source)
    {
        $mainSource = $this->webInputProvider->getContent($this->mainSource);
        $feedId = $this->parser->getNewsFeedId($mainSource);
        $this->curlInputProvider->setData(sprintf(static::MASK_DATA, $feedId));
        return $this->curlInputProvider->getContent($source);
    }
}