<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Dependency;


use OrbitCore\Infrastructure\Container\ContainerInterface;
use OrbitCore\Infrastructure\Container\Exception\DependencyNotExistException;
use OrbitCore\Infrastructure\Resolver\ResolverInterface;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    protected $dependencies;

    /**
     * @var ResolverInterface
     */
    protected $resolver;

    public function __construct(ResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }

    public function getResolver(): ResolverInterface
    {
        return $this->resolver;
    }

    public function get(string $name)
    {
        if (!isset($this->dependencies[$name])) {
            throw new DependencyNotExistException(sprintf(
                'Dependency "%s" does not exist',
                $name
            ));
        }

        if (method_exists($this->dependencies[$name], '__invoke')) {
            return $this->dependencies[$name]($this);
        }

        return $this->dependencies[$name];
    }

    public function set(string $name, $dependency): ContainerInterface
    {
        $this->dependencies[$name] = $dependency;

        return $this;
    }
}
