<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain;


use OrbitCore\Infrastructure\Container\ContainerInterface;
use OrbitCore\Infrastructure\Facade\AbstractFacade;
use OrbitCore\Infrastructure\Factory\FactoryInterface;

/**
 * @method \OrbitCore\Kernel\Domain\KernelDomainFactory getFactory()
 */
class KernelFacade extends AbstractFacade implements KernelFacadeInterface
{
    public function getDependencyContainer(): ContainerInterface
    {
        return $this->getFactory()
            ->createDependencyContainerBuilder()
            ->getDependencyContainer();
    }
}
