<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:23 AM
 */

namespace Vauge\NewsBrokerBundle\Interfaces;


interface NewsBrokerServiceInterface
{

    /**
     * @return mixed
     */
    public function process();
}