<?php
declare(strict_types=1);

namespace OrbitCoreTest\Kernel\Domain\Resolver\Config;

use Codeception\TestCase\Test;
use OrbitCore\Kernel\Domain\Resolver\ClassMetadataReader;
use OrbitCore\Kernel\Domain\Resolver\Config\ConfigResolver;
use OrbitCore\Kernel\KernelConfig;

/**
 * @group OrbitCore
 * @group Kernel
 * @group Domain
 * @group Resolver
 * @group Config
 * @group ConfigResolverTest
 */
class ConfigResolverTest extends Test
{
    public function testResolveConfig()
    {
        $resolver = new ConfigResolver(
            new ClassMetadataReader(),
            [
                'OrbitCore'
            ]
        );

        $config = $resolver->resolve($this);

        $this->assertInstanceOf(
            KernelConfig::class,
            $config
        );
    }
}
