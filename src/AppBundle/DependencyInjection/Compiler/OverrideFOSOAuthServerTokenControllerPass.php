<?php

namespace AppBundle\DependencyInjection\Compiler;

use AppBundle\Controller\TokenController;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideFOSOAuthServerTokenControllerPass implements CompilerPassInterface
{
  /**
   * {@inheritdoc}
   */
  public function process(ContainerBuilder $container)
  {
    $definition = $container->getDefinition('fos_oauth_server.controller.token');
    $definition->setClass(TokenController::class);
    $definition->addArgument(new Reference('fos_oauth_server.client_manager'));
    $definition->addArgument(new Reference('fos_oauth_server.access_token_manager'));
    $definition->addArgument(new Reference('doctrine.orm.entity_manager'));
  }
}
