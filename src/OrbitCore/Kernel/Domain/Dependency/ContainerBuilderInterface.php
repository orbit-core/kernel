<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Dependency;


use OrbitCore\Infrastructure\Container\ContainerInterface;

interface ContainerBuilderInterface
{
    public function getDependencyContainer(): ContainerInterface;
}
