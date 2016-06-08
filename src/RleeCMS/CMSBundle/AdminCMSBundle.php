<?php

namespace RleeCMS\CMSBundle;

use RleeCMS\CMSBundle\DependencyInjection\Compiler\OverrideServiceCompilerPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AdminCMSBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideServiceCompilerPass());
    }
}
