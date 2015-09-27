<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 27/09/2015
 * Time: 3:26 PM
 */

namespace Vague\NewsBrokerBundle\Service;

use Vague\NewsBrokerBundle\Interfaces\InputProviderInterface;
use Vague\NewsBrokerBundle\Interfaces\NewsBrokerServiceInterface;
use Vague\NewsBrokerBundle\Interfaces\ParserInterface;

class NewsBrokerService implements NewsBrokerServiceInterface
{
    /**
     * @var array
     */
    protected $_inputProviders = array();
    /**
     * @var array
     */
    protected $_sourceIds = array();
    /**
     * @var array
     */
    protected $_parsers = array();

    /**
     * @param string $key
     * @param string $sourceId
     * @param InputProviderInterface $provider
     */
    public function registerInputProvider($key, $sourceId, InputProviderInterface $provider)
    {
        $this->_inputProviders[$key] = $provider;
        $this->_sourceIds[$key] = $sourceId;
    }

    /**
     * @param string $key
     * @param ParserInterface $parser
     */
    public function registerParser($key, ParserInterface $parser)
    {
        $this->_parsers[$key] = $parser;
    }

    /**
     * @param string $key
     * @return array
     */
    public function process($key)
    {
        $source = $this->_inputProviders[$key]->getContent($this->_sourceIds[$key]);
        return $this->_parsers[$key]->parse($source);
    }
}