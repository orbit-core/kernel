<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Dependency\Plugin;


use OrbitCore\Infrastructure\Container\ContainerInterface;

interface DependencyHydratorPluginInterface
{
    public function hydrateDependencyContainer(ContainerInterface $container): ContainerInterface;
}
