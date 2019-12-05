<?php
declare(strict_types=1);

namespace OrbitCoreTest\Kernel\Domain\Resolver\Factory;


use Codeception\TestCase\Test;
use OrbitCore\ConfigDomain\Domain\ConfigDomainDependencyProvider;
use OrbitCore\ConfigDomain\Domain\ConfigDomainDomainFactory;
use OrbitCore\ConfigDomain\Domain\ConfigDomainFacade;
use OrbitCore\ConfigDomain\Domain\Container\ConfigContainer;
use OrbitCore\Kernel\Domain\KernelDomainFactory;
use OrbitCore\Kernel\Domain\Resolver\ClassMetadataReader;
use OrbitCore\Kernel\Domain\Resolver\Factory\FactoryResolver;

/**
 * @group OrbitCore
 * @group Kernel
 * @group Domain
 * @group Resolver
 * @group Factory
 * @group FactoryResolverTest
 */
class FactoryResolverTest extends Test
{
    public function testResolveOwnFactory()
    {
        $resolver = new FactoryResolver(
            new ClassMetadataReader(),
            [
                'OrbitCore'
            ]
        );

        $factory = $resolver->resolve($this);

        $this->assertInstanceOf(
            KernelDomainFactory::class,
            $factory
        );
    }

    public function testResolveFactoryWithDependencies()
    {
        $resolver = new FactoryResolver(
            new ClassMetadataReader(),
            [
                'OrbitCore'
            ]
        );

        $factory = $resolver->resolve(new ConfigDomainFacade());

        $this->assertInstanceOf(
            ConfigDomainDomainFactory::class,
            $factory
        );

        $this->assertInstanceOf(
            ConfigContainer::class,
            $factory->getDependency(ConfigDomainDependencyProvider::CONFIG_CONTAINER)
        );
    }
}
