<?php
declare(strict_types=1);

namespace OrbitCoreTest\Kernel\Domain\Resolver;


use Codeception\TestCase\Test;
use OrbitCore\Kernel\Domain\Resolver\AbstractClassResolver;

/**
 * @group OrbitCore
 * @group Kernel
 * @group Domain
 * @group Resolver
 * @group AbstractClassResolverTest
 */
class AbstractClassResolverTest extends Test
{
    public function testClassResolver()
    {
        $classResolver = $this->make(
            AbstractClassResolver::class,
            [
                'namespaces' => [
                    'OrbitCoreTest'
                ]
            ]
        );

        $name = $classResolver->resolveClass(
            '%s\\%s\\%s\\Resolver\\AbstractClassResolverTest',
            ...[
                'Kernel',
                'Domain'
            ]
        );

        $this->assertSame(
            AbstractClassResolverTest::class,
            $name
        );
    }
}
