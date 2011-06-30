<?php

namespace IMAG\LdapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition,
  Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
  public function getConfigTree()
  {
    $treeBuilder = new TreeBuilder();
    $rootNode = $treeBuilder->root('imag_ldap');
    $rootNode
        ->children()
          ->arrayNode('client')
            ->children()
              ->scalarNode('host')->isRequired()->cannotBeEmpty()->end()
              ->scalarNode('port')->defaultValue(389)->end()
            ->end()
          ->end()
          ->arrayNode('user')
            ->children()
              ->scalarNode('base_dn')->isRequired()->cannotBeEmpty()->end()
              ->scalarNode('filter')->defaultValue('(ou=people)')->end()
              ->scalarNode('name_attribute')->defaultValue('uid')->end()
            ->end()
          ->end()
          ->arrayNode('role')
            ->children()
              ->scalarNode('base_dn')->isRequired()->cannotBeEmpty()->end()
              ->scalarNode('filter')->defaultValue('(ou=group)')->end()
              ->scalarNode('name_attribute')->defaultValue('cn')->end()
              ->scalarNode('user_attribute')->defaultValue('member')->end()
            ->end()
          ->end()
        ->end()
        ;

    return $treeBuilder->buildTree();      
  }
}
