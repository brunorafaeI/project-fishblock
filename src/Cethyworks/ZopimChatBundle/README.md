Zopim Chat Bundle
=================

This bundle enable the [zopim chat](https://www.zopim.com/) <https://www.zopim.com/> on your symfony2 application, without modifying your templates.

### Features:
- enable chat by handler (explicitly set the conditions to enable the chat)
- send zopim parameters (explicitly set the parameters sent to zopim)
- optionally inject "demo" template when chat not enabled

### Todo:
- travis CI configuration
- configuration tests

## 1. Installation:
**- with deps**
```
[ZopimChat]
    git=https://github.com/Cethy/CethyworksZopimChatBundle.git
    target=/bundles/Cethyworks/ZopimChatBundle
```

**- with composer**

[...]

## 2. Enable the bundle:

Enable the bundle in the kernel:

``` php
<?php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'Cethyworks'       => __DIR__.'/../vendor/bundles',
));
```
``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Cethyworks\ZopimChatBundle\CethyworksZopimChatBundle(),
    );
}
```

## 3. Configuration (in app/config/config.yml):
**- basic**
```
cethyworks_zopim_chat:
    account_id: {your_zopim_account_id}
```
**- advanced**
```
cethyworks_zopim_chat:
    account_id: {your_zopim_account_id}
    chat_handler: {your_service_name}
    demo_template: 'fooBundle:bar:foobar.html.twig'
```
**note**

Your zopim account id is found in the ["widget customization"](https://dashboard.zopim.com/#Widget/embed_widget) tab:
``` js
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?{your_zopim_account_id}';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
```

## 4. Going further (Handler)
With the "advanced" configuration, you're able to build your own ChatHandler, it must implements Cethyworks\ZopimChatBundle\Handler\ChatHandlerInterface interface and his 2 method, **isEnabled** & **getParameters**.
Here is an example :

``` php
namespace foo\BarBundle\Handler;

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
```

## 5. Display demo template when chat disabled ()
If you fill the `demo_template` option, the bundle will automatically inject it at the end of the html tag if the chat is disabled. The template must be "twigable", it's the only limitation.