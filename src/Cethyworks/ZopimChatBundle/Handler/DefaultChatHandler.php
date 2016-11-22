<?php

namespace Cethyworks\ZopimChatBundle\Handler;

use Cethyworks\ZopimChatBundle\Handler\ChatHandlerInterface;

class DefaultChatHandler implements ChatHandlerInterface
{
    protected $zopimId;

    /**
     * @param string $zopimId
     */
    public function __construct($zopimId)
    {
        $this->zopimId = $zopimId;
    }

    public function isEnabled()
    {
        return true;
    }
    
    public function getParameters()
    {
        return array();
    }

    public function getZopimId()
    {

    }
}