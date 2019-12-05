<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver\Config;


use OrbitCore\Infrastructure\Config\ConfigInterface;
use OrbitCore\Infrastructure\Resolver\Config\ConfigResolverInterface;
use OrbitCore\Kernel\Adapter\Config\ConfigAdapter;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;

class ConfigResolver extends AbstractClassResolver implements ConfigResolverInterface
{
    protected const CLASS_PATTERN = '%s\\%s\\%sConfig';

    protected static $cache = [];

    /**
     * @inheritDoc
     */
    public function resolve(object $source): ConfigInterface
    {
        $metadata = $this->metadataReader->getMetadata($source);

        if (!isset(static::$cache[$metadata['path']])) {
            $location = [
                $metadata['package'],
                $metadata['package']
            ];
            $configClass = $this->resolveClass(static::CLASS_PATTERN, ...$location);

            $config = new $configClass();
            if (method_exists($config, 'setConfig')) {
                $config->setConfig(ConfigAdapter::getInstance());
            }

            static::$cache[$metadata['path']] = $config;
        }

        return static::$cache[$metadata['path']];
    }
}
