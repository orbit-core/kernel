<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Domain\Resolver;

interface ClassMetadataReaderInterface
{
    /**
     * Retrieve namespace information based on source class
     * [
     *    'path' => ...
     *    'package' => ...
     *    'layer' => ...
     * ]
     *
     * @param object $source
     *
     * @return array
     * @throws \ReflectionException
     */
    public function getMetadata(object $source): array;
}
