<?php

namespace UserCredentialsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use UserCredentialsBundle\Security\Factory\CustomSecurityFactory;

class UserCredentialsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new CustomSecurityFactory());
    }
}
