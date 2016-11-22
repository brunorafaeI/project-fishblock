<?php

namespace Acme\FishBlockBundle\Handler;

use Cethyworks\ZopimChatBundle\Handler\ChatHandlerInterface;
use Symfony\Component\Security\Core\SecurityContext;

class ChatHandler implements ChatHandlerInterface
{
    /**
     * @var type SecurityContext
     */
    protected $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }


    public function isEnabled()
    {
        return 'premium' == $this->getUser()->getType();
    }

    public function getParameters()
    {
        $user = $this->getUser();

        return array(
            'firstname' => $user->getFirstname(),
            'email'     => $user->getEmail(),
            'notes'     => $this->generateNotes($user)
        );
    }

    /**
     * @return Foo/UserBundle/User
     */
    protected function getUser()
    {
        if(null === $token = $this->securityContext->getToken())
        {
            return null;
        }

        return $token->getUser();
    }
}