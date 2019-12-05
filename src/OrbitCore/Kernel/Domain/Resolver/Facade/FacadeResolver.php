<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Facade;


use OrbitCore\Infrastructure\Facade\FacadeInterface;
use OrbitCore\Infrastructure\Resolver\Facade\FacadeResolverInterface;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;
use OrbitCore\Kernel\Domain\Resolver\Resolver;

class FacadeResolver extends AbstractClassResolver implements FacadeResolverInterface
{
    protected const CLASS_PATTERN = '%s\\%s\\Domain\\%sFacade';

    protected static $cache = [];

    /**
     * @inheritDoc
     */
    public function resolve(object $source): FacadeInterface
    {
        $metadata = $this->metadataReader->getMetadata($source);

        if (!isset(static::$cache[$metadata['path']])) {
            $location = [
                $metadata['package'],
                $metadata['package']
            ];
            $facade = $this->resolveClass(static::CLASS_PATTERN, ...$location);

            $facade = new $facade();
            if (method_exists($facade, 'setResolver')) {
                $facade->setResolver(new Resolver());
            }

            static::$cache[$metadata['path']] = $facade;
        }

        return static::$cache[$metadata['path']];
    }
}
