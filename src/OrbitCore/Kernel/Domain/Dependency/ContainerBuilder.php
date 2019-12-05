<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Dependency;


use OrbitCore\Infrastructure\Container\ContainerInterface;

class ContainerBuilder implements ContainerBuilderInterface
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \OrbitCore\Kernel\Domain\Dependency\Plugin\DependencyHydratorPluginInterface[]
     */
    protected $dependencyHydratorPlugins;

    /**
     * ContainerBuilder constructor.
     *
     * @param \OrbitCore\Infrastructure\Container\ContainerInterface $container
     * @param \OrbitCore\Kernel\Domain\Dependency\Plugin\DependencyHydratorPluginInterface[] $dependencyHydratorPlugins
     */
    public function __construct(
        ContainerInterface $container,
        array $dependencyHydratorPlugins
    ) {
        $this->container = $container;
        $this->dependencyHydratorPlugins = $dependencyHydratorPlugins;
    }

    public function getDependencyContainer(): ContainerInterface
    {
        foreach ($this->dependencyHydratorPlugins as $hydratorPlugin) {
            $this->container = $hydratorPlugin->hydrateDependencyContainer($this->container);
        }

        return $this->container;
    }
}
