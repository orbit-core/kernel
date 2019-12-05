<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Dependency;


use OrbitCore\Infrastructure\Dependency\ProviderInterface;
use OrbitCore\Infrastructure\Resolver\Dependency\DependencyProviderResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;

class DependencyProviderResolver extends AbstractClassResolver implements DependencyProviderResolverInterface
{
    protected const CLASS_PATTERN = '%s\\%s\\%s\\%sDependencyProvider';

    protected static $cache = [];

    /**
     * @inheritDoc
     */
    public function resolve(object $source): ProviderInterface
    {
        $metadata = $this->metadataReader->getMetadata($source);

        if (!isset(static::$cache[$metadata['path']])) {
            $location = [
                $metadata['package'],
                $metadata['layer'],
                $metadata['package']
            ];
            $dependencyProviderClass = $this->resolveClass(static::CLASS_PATTERN, ...$location);

            $dependencyProvider = new $dependencyProviderClass();

            static::$cache[$metadata['path']] = $dependencyProvider;
        }

        return static::$cache[$metadata['path']];
    }
}
