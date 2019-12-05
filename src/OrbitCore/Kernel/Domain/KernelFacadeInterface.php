<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain;


use OrbitCore\Infrastructure\Container\ContainerInterface;

interface KernelFacadeInterface
{
    public function getDependencyContainer(): ContainerInterface;
}
