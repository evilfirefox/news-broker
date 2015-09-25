<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:19 AM
 */

namespace Vauge\NewsBrokerBundle\Interfaces;


interface InputProviderInterface
{

    /**
     * @return string
     */
    public function getContent();
}