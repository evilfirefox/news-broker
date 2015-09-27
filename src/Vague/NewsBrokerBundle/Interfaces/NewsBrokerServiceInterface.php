<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:23 AM
 */

namespace Vague\NewsBrokerBundle\Interfaces;


interface NewsBrokerServiceInterface
{

    /**
     * @param string $key
     * @param string $sourceId
     * @param InputProviderInterface $provider
     */
    public function registerInputProvider($key, $sourceId, InputProviderInterface $provider);

    /**
     * @param string $key
     * @param ParserInterface $parser
     */
    public function registerParser($key, ParserInterface $parser);

    /**
     * @param string $key
     * @return array
     */
    public function process($key);
}