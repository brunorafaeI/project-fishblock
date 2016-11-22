<?php

namespace Cethyworks\ZopimChatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return \Symfony\Component\Config\Definition\ArrayNode The config tree
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cethyworks_zopim_chat');

        $rootNode
            ->children()
                ->scalarNode('account_id')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('chat_handler')
                    ->defaultValue('cethyworks_zopim_chat.handler.default')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('demo_template')
                    ->defaultValue(null)
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
