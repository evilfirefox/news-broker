<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:19 AM
 */

namespace Vague\NewsBrokerBundle\Interfaces;


interface InputProviderInterface
{

    /**
     * @param string $source
     * @return string
     */
    public function getContent($source);
}