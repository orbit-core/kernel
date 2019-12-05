<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Facade;


use OrbitCore\Infrastructure\Facade\FacadeInterface;
use OrbitCore\Infrastructure\Resolver\Facade\FacadeResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

trait FacadeResolverTrait
{
    public function getFacade(object $source = null): FacadeInterface
    {
        if ($source === null) {
            $source = $this;
        }

        return $this->getFacadeResolver()->resolve($source);
    }

    protected function getFacadeResolver(): FacadeResolverInterface
    {
        return (new Resolver())->getFacadeResolver();
    }
}
