<?php

namespace Cethyworks\ZopimChatBundle\Handler;

interface ChatHandlerInterface
{
    /**
     * Used by the ChatListener to know if the chat is enabled
     * 
     * @return boolean
     */
    public function isEnabled();

    /**
     * Used by the ChatListener to get the zopim id (you can handle more than one id like this)
     *
     * @return string
     */
    public function getZopimId();

    /**
     * Used by the ChatListener to add parameters to the chat
     * 
     * @return array
     */
    public function getParameters();
}