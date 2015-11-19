<?php
/**
 * Created by PhpStorm.
 * User: devastator
 * Date: 20/11/2015
 * Time: 12:57 AM
 */

namespace Vague\NewsBrokerBundle\InputProvider;

use Vague\NewsBrokerBundle\Interfaces\InputProviderInterface;

class CurlInputProvider implements InputProviderInterface
{
    const COMMAND_CURL = 'curl \'%s\' %s --data \'%s\'';
    const COMMAND_HEADER = ' -H \'%s: %s\'';

    /**
     * @var array
     */
    protected $headers = array();
    /**
     * @var string
     */
    protected $data;

    /**
     * @param string $source
     * @return string
     */
    public function getContent($source)
    {
        $command = sprintf(static::COMMAND_CURL, $source, $this->prepareHeaders(), $this->data);
        return exec($command);
    }

    public function addHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    protected function prepareHeaders()
    {
        $result = '';
        foreach ($this->headers as $name => $value) {
            $result .= sprintf(static::COMMAND_HEADER, $name, $value);
        }
        return $result;
    }
}