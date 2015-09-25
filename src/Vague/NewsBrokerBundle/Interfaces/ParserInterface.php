<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:20 AM
 */

namespace Vauge\NewsBrokerBundle\Interfaces;


interface ParserInterface
{

    /**
     * @param string $source
     * @return mixed
     */
    public function parse($source);
}