<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Dependency;


use OrbitCore\Infrastructure\Dependency\ProviderInterface;
use OrbitCore\Infrastructure\Resolver\Dependency\DependencyProviderResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

trait DependencyProviderResolverTrait
{
    public function getDependencyProvider(object $source = null): ProviderInterface
    {
        if ($source === null) {
            $source = $this;
        }

        return $this->getDependencyProviderResolver()->resolve($source);
    }

    protected function getDependencyProviderResolver(): DependencyProviderResolverInterface
    {
        return (new Resolver())->getDependencyProviderResolver();
    }
}
