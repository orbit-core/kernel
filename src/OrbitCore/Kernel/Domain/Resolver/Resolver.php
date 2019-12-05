<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver;


use OrbitCore\Infrastructure\Resolver\Config\ConfigResolverInterface;
use OrbitCore\Infrastructure\Resolver\Dependency\DependencyProviderResolverInterface;
use OrbitCore\Infrastructure\Resolver\Facade\FacadeResolverInterface;
use OrbitCore\Infrastructure\Resolver\Factory\FactoryResolverInterface;
use OrbitCore\Infrastructure\Resolver\ResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\Config\ConfigResolver;
use OrbitCore\Kernel\Domain\Resolver\Dependency\DependencyProviderResolver;
use OrbitCore\Kernel\Domain\Resolver\Facade\FacadeResolver;
use OrbitCore\Kernel\Domain\Resolver\Factory\FactoryResolver;

class Resolver implements ResolverInterface
{
    /**
     * @return \OrbitCore\Infrastructure\Resolver\Config\ConfigResolverInterface
     */
    public function getConfigResolver(): ConfigResolverInterface
    {
        return new ConfigResolver(
            new ClassMetadataReader()
        );
    }

    public function getDependencyProviderResolver(): DependencyProviderResolverInterface
    {
        return new DependencyProviderResolver(
            new ClassMetadataReader()
        );
    }


    public function getFacadeResolver(): FacadeResolverInterface
    {
        return new FacadeResolver(
            new ClassMetadataReader()
        );
    }

    public function getFactoryResolver(): FactoryResolverInterface
    {
        return new FactoryResolver(
            new ClassMetadataReader()
        );
    }
}
