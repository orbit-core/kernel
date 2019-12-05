<?php
declare(strict_types=1);

namespace OrbitCore\Kernel\Adapter\Config;


use OrbitCore\ConfigDomain\Domain\ConfigDomainFacade;
use OrbitCore\Infrastructure\Config\ConfigBridgeInterface;
use OrbitCore\Kernel\Domain\Resolver\Resolver;
use OrbitCore\Kernel\KernelConfig;

class ConfigAdapter implements ConfigBridgeInterface
{
    /**
     * @var self
     */
    protected static $instance;

    protected static $defaultNamespaces = [
        'OrbitCustom',
        'OrbitSatallite',
        'OrbitApp',
        'OrbitCore'
    ];

    /**
     * @var \OrbitCore\ConfigDomain\Domain\ConfigDomainFacadeInterface
     */
    protected $config;

    public function __construct()
    {
        $this->config = new ConfigDomainFacade();
        $this->config->setResolver(
            new Resolver()
        );
    }

    public static function getInstance(): self
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public static function getNamespaces(): array
    {
        $namespaces = getenv(KernelConfig::KERNEL_NAMESPACES) ? static::extractNamespaces(getenv(KernelConfig::KERNEL_NAMESPACES)) : static::$defaultNamespaces;
        return $namespaces;
    }

    public function get(string $name)
    {
        return $this->config->getConfigValue($name);
    }

    protected static function extractNamespaces(string $namespaces): array
    {
        return explode(',', $namespaces);
    }
}
