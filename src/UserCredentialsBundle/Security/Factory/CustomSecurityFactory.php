<?php
/**
 * Created by PhpStorm.
 * User: persei
 * Date: 11/6/16
 * Time: 10:34 PM
 */

namespace UserCredentialsBundle\Security\Factory;


use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class CustomSecurityFactory implements SecurityFactoryInterface
{
    /**
     * @param ContainerBuilder $container
     * @param string $id
     * @param array $config
     * @param string $userProvider
     * @param string $defaultEntryPoint
     * @return array
     */
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.custom.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('custom.security.authentication.provider'))
            ->replaceArgument(0, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.custom.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('custom.security.authentication.listener'));

        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    /**
     * @return string
     */
    public function getPosition()
    {
        return 'pre_auth';
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return 'custom';
    }

    public function addConfiguration(NodeDefinition $builder)
    {

    }
}