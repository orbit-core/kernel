<?php
declare(strict_types=1);

namespace OrbitCoreTest\Kernel\Domain\Resolver;


use Codeception\TestCase\Test;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;
use OrbitCore\Kernel\Domain\Resolver\ClassMetadataReader;
use function foo\func;

/**
 * @group OrbitCore
 * @group Kernel
 * @group Domain
 * @group Resolver
 * @group ClassMetadataReaderTest
 */
class ClassMetadataReaderTest extends Test
{
    protected $tester;

    public function testGetMetadata()
    {
        $reader = new ClassMetadataReader();

        $metadata = $reader->getMetadata($this);

        $this->assertSame(
            'Kernel',
            $metadata['package']
        );
        $this->assertSame(
            'Domain',
            $metadata['layer']
        );
    }
}
