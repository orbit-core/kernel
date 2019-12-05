<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain;


use OrbitCore\Infrastructure\Container\ContainerInterface;
use OrbitCore\Infrastructure\Resolver\ResolverInterface;
use OrbitCore\Kernel\Domain\Dependency\ContainerBuilderInterface;
use OrbitCore\Kernel\Domain\Resolver\ClassMetadataReaderInterface;

interface KernelDomainFactoryInterface
{
    public function createDependencyContainer(): ContainerInterface;

    public function createDependencyContainerBuilder(): ContainerBuilderInterface;

    public function createResolver(): ResolverInterface;

    public function getDependencyHydratorPlugins(): array;
}
