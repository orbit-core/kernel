<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Factory;


use OrbitCore\Infrastructure\Factory\FactoryInterface;
use OrbitCore\Infrastructure\Resolver\Factory\FactoryResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

trait FactoryResolverTrait
{
    public function getFactory(object $source = null): FactoryInterface
    {
        if ($source === null) {
            $source = $this;
        }

        return $this->getFactoryResolver()->resolve($source);
    }

    protected function getFactoryResolver(): FactoryResolverInterface
    {
        return (new Resolver())->getFactoryResolver();
    }
}
