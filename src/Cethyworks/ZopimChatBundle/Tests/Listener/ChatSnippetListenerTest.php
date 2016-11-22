<?php

namespace Cethyworks\ZopimChatBundle\Tests\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

use Cethyworks\ZopimChatBundle\Listener\ChatSnippetListener;

class ChatSnippetListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getInjectSnippetTests
     */
    public function testInjectSnippet($content, $expected)
    {
        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $m = new \ReflectionMethod($listener, 'injectSnippet');
        $m->setAccessible(true);

        $response = new Response($content);

        $m->invoke($listener, $response);
        $this->assertEquals($expected, $response->getContent());
    }

    public function getInjectSnippetTests()
    {
        return array(
            array('<html><head></head><body></body></html>', "<html><head>\nSNIPPET\n</head><body></body></html>"),
            array('<html>
            <head></head>
            <body>
            <textarea><html><head></head><body></body></html></textarea>
            </body>
            </html>', "<html>
            <head>\nSNIPPET\n</head>
            <body>
            <textarea><html><head></head><body></body></html></textarea>
            </body>
            </html>"),
        );
    }

    public function testSnippetIsInjected()
    {
        $response = new Response('<html><head></head><body></body></html>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(), HttpKernelInterface::MASTER_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals("<html><head>\nSNIPPET\n</head><body></body></html>", $response->getContent());
    }
    
    public function testSnippetIsNotInjectedBecauseHandleIsDisabled()
    {
        $response = new Response('<html><head></head><body></body></html>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(), HttpKernelInterface::MASTER_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(false), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals("<html><head></head><body></body></html>", $response->getContent());
    }

    /**
     * @depends testSnippetIsInjected
     */
    public function testSnippetIsNotInjectedOnRedirection()
    {
        foreach (array(301, 302) as $statusCode) {
            $response = new Response('<html><head></head><body></body></html>', $statusCode);
            $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(), HttpKernelInterface::MASTER_REQUEST, $response);

            $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
            $listener->onKernelResponse($event);

            $this->assertEquals('<html><head></head><body></body></html>', $response->getContent());
        }
    }

    /**
     * @depends testSnippetIsInjected
     */
    public function testSnippetIsNotInjectedWhenOnSubRequest()
    {
        $response = new Response('<html><head></head><body></body></html>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(), HttpKernelInterface::SUB_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals('<html><head></head><body></body></html>', $response->getContent());
    }

    /**
     * @depends testSnippetIsInjected
     */
    public function testSnippetIsNotInjectedOnUncompleteHtmlResponses()
    {
        $response = new Response('<div>Some content</div>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(), HttpKernelInterface::MASTER_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals('<div>Some content</div>', $response->getContent());
    }

    /**
     * @depends testSnippetIsInjected
     */
    public function testSnippetIsNotInjectedOnXmlHttpRequests()
    {
        $response = new Response('<html><head></head><body></body></html>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(true), HttpKernelInterface::MASTER_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals('<html><head></head><body></body></html>', $response->getContent());
    }

    /**
     * @depends testSnippetIsInjected
     */
    public function testSnippetIsNotInjectedOnNonHtmlRequests()
    {
        $response = new Response('<html><head></head><body></body></html>');

        $event = new FilterResponseEvent($this->getKernelMock(), $this->getRequestMock(false, 'json'), HttpKernelInterface::MASTER_REQUEST, $response);

        $listener = new ChatSnippetListener($this->getTemplatingMock(), '', $this->getChatHandlerMock(), 'zopimId');
        $listener->onKernelResponse($event);

        $this->assertEquals('<html><head></head><body></body></html>', $response->getContent());
    }

    protected function getChatHandlerMock($enabled = true)
    {
        $chatHandler = $this->getMock('\aba\ChatBundle\Handler\ChatHandler', array(), array(), '', false);
        
        $chatHandler->expects($this->any())
            ->method('isEnabled')
            ->will($this->returnValue($enabled));

        $chatHandler->expects($this->any())
            ->method('getParameters')
            ->will($this->returnValue(array()));
        
        return $chatHandler;
    }
    
    protected function getRequestMock($isXmlHttpRequest = false, $requestFormat = 'html')
    {
        $session = $this->getMock('Symfony\Component\HttpFoundation\Session', array(), array(), '', false);
        $request = $this->getMock(
            'Symfony\Component\HttpFoundation\Request',
            array('getSession', 'isXmlHttpRequest', 'getRequestFormat'),
            array(), '', false
        );
        $request->expects($this->any())
            ->method('isXmlHttpRequest')
            ->will($this->returnValue($isXmlHttpRequest));
        $request->expects($this->any())
            ->method('getRequestFormat')
            ->will($this->returnValue($requestFormat));
        $request->expects($this->any())
            ->method('getSession')
            ->will($this->returnValue($session));

        return $request;
    }

    protected function getTemplatingMock()
    {
        $templating = $this->getMock('Symfony\Bundle\TwigBundle\TwigEngine', array(), array(), '', false);
        $templating->expects($this->any())
            ->method('render')
            ->will($this->returnValue('SNIPPET'));

        return $templating;
    }

    protected function getKernelMock()
    {
        return $this->getMock('Symfony\Component\HttpKernel\Kernel', array(), array(), '', false);
    }
}
