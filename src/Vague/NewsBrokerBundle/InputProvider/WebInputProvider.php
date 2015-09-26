<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 26/09/2015
 * Time: 12:37 AM
 */

namespace Vague\NewsBrokerBundle\InputProvider;


use Vague\NewsBrokerBundle\Interfaces\InputProviderInterface;

class WebInputProvider implements InputProviderInterface
{

    /**
     * @param string $source
     * @return string
     */
    public function getContent($source)
    {
        return file_get_contents($source);
    }
}