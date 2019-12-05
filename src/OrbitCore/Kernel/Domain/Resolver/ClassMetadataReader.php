<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver;


class ClassMetadataReader implements ClassMetadataReaderInterface
{
    protected static $cache = [];

    /**
     * @inheritDoc
     */
    public function getMetadata(object $source): array
    {
        $ident = get_class($source);

        if (!isset(static::$cache[$ident])) {
            $parts = explode('\\', $ident);

            return [
                'path' => $ident,
                'package' => $parts[1],
                'layer' => $parts[2]
            ];
        }

        return static::$cache[$ident];
    }
}
