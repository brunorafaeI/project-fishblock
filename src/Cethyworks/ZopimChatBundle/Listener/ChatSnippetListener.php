<?php

namespace Cethyworks\ZopimChatBundle\Listener;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\TwigBundle\TwigEngine;

use Cethyworks\ZopimChatBundle\Handler\ChatHandlerInterface;

/**
 * Inject the chat snippet into the response body
 *
 * The onKernelResponse method must be connected to the kernel.response event.
 *
 * The chat snippet is only injected on well-formed HTML (with a proper </head> tag).
 * This means that the snippet will never be included in sub-requests or ESI requests.
 */
class ChatSnippetListener
{
    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var string
     */
    private $template;

    /**
     * @var ChatHandlerInterface
     */
    private $handler;

    /**
     * @var string
     */
    private $demoTemplate;

    /**
     * Constructor
     *
     * @param  TwigEngine          $templating   A TwigEngine instance
     * @param  string              $template     The template of the tracker
     *
     * @param ChatHandlerInterface $handler      The Chat Handler
     * @param string               $demoTemplate The template injected if the chat is disabled
     */
    public function __construct(TwigEngine $templating, $template, ChatHandlerInterface $handler, $demoTemplate = null)
    {
        $this->templating   = $templating;
        $this->template     = $template;

        $this->handler      = $handler;
        $this->demoTemplate = $demoTemplate;
    }

    /**
     * Defines the template
     *
     * @param  string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Listen to the kernel.response event
     *
     * @param  FilterResponseEvent $event FilterResponseEvent instance
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType())
        {
            return;
        }

        $request = $event->getRequest();
        $response = $event->getResponse();

        if ('3' === substr($response->getStatusCode(), 0, 1)
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $request->getRequestFormat()
            || $request->isXmlHttpRequest()
        ) {
            return;
        }

        if($this->handler->isEnabled())
        {
            $this->injectSnippet($response);
        }
        elseif($this->demoTemplate)
        {
            $this->injectDemoTemplate($response);
        }
    }

    /**
     * Injects the chat snippet into the given Response (end of the head tag)
     *
     * @param Response $response A Response instance
     */
    protected function injectSnippet(Response $response)
    {
        if (function_exists('mb_stripos'))
        {
            $posrFunction = 'mb_strpos';
            $substrFunction = 'mb_substr';
        }
        else
        {
            $posrFunction = 'strpos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();
        $pos = $posrFunction($content, '</head>');
        if (false !== $pos)
        {
            $snippet = $this->templating->render($this->template, array(
              'zopim_id'   => $this->handler->getZopimId(),
              'parameters' => $this->handler->getParameters()
            ));
            $snippet = "\n" . $snippet . "\n";

            $content = $substrFunction($content, 0, $pos) . $snippet . $substrFunction($content, $pos);
            $response->setContent($content);
        }
    }

    /**
     * Injects the demo template into the given Response (end of the html tag)
     *
     * @param Response $response A Response instance
     */
    protected function injectDemoTemplate(Response $response)
    {
        if (function_exists('mb_stripos'))
        {
            $posrFunction = 'mb_strripos';
            $substrFunction = 'mb_substr';
        }
        else
        {
            $posrFunction = 'strripos';
            $substrFunction = 'substr';
        }

        $content = $response->getContent();
        $pos = $posrFunction($content, '</body>');
        if(false !== $pos)
        {
            $snippet = $this->templating->render($this->demoTemplate);
            $snippet = "\n" . $snippet . "\n";

            $content = $substrFunction($content, 0, $pos) . $snippet . $substrFunction($content, $pos);
            $response->setContent($content);
        }
    }
}
