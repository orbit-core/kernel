<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Factory;


use OrbitCore\Infrastructure\Container\ContainerInterface;
use OrbitCore\Infrastructure\Factory\FactoryInterface;
use OrbitCore\Infrastructure\Resolver\Factory\FactoryResolverInterface;
use OrbitCore\Kernel\Domain\KernelFacade;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;
use OrbitCore\Kernel\Domain\Resolver\Dependency\DependencyProviderResolverTrait;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

/**
 * @method \OrbitCore\Kernel\Domain\KernelFacadeInterface getFacade()
 */
class FactoryResolver extends AbstractClassResolver implements FactoryResolverInterface
{
    use DependencyProviderResolverTrait;

    protected const CLASS_PATTERN = '%s\\%s\\%s\\%s%sFactory';

    protected static $cache = [];

    /**
     * @inheritDoc
     */
    public function resolve(object $source): FactoryInterface
    {
        $metadata = $this->metadataReader->getMetadata($source);

        if (!isset(static::$cache[$metadata['path']])) {
            $location = [
                $metadata['package'],
                $metadata['layer'],
                $metadata['package'],
                $metadata['layer']
            ];
            $factory = $this->resolveClass(static::CLASS_PATTERN, ...$location);

            $factory = new $factory();
            if (method_exists($factory, 'setResolver')) {
                $factory->setResolver(new Resolver());
            }
            if (method_exists($factory, 'setDependencyContainer')) {
                $factory->setDependencyContainer(
                    $this->getDependencyContainer($source)
                );
            }


            static::$cache[$metadata['path']] = $factory;
        }

        return static::$cache[$metadata['path']];
    }

    protected function getDependencyContainer(object $source): ContainerInterface
    {
        $facade = (new KernelFacade());
        $facade->setResolver(new Resolver());

        $container = $facade->getDependencyContainer();
        return $this->getDependencyProvider($source)->provideDependencies($container);
    }
}
