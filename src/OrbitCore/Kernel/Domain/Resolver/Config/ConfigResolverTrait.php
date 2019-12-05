<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Config;


use OrbitCore\Infrastructure\Config\ConfigInterface;
use OrbitCore\Infrastructure\Resolver\Config\ConfigResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

trait ConfigResolverTrait
{
    public function getConfig(object $source = null): ConfigInterface
    {
        if ($source === null) {
            $source = $this;
        }

        return $this->getConfigResolver()->resolve($source);
    }

    protected function getConfigResolver(): ConfigResolverInterface
    {
        return (new Resolver())->getConfigResolver();
    }
}
