<?php
declare(strict_types=1);

namespace WShafer\PSR11FlySystem\Cache;

use League\Flysystem\Cached\Storage\Psr6Cache;

class Psr6CacheFactory extends ContainerAwareCacheAbstract
{
    public function __invoke(array $options)
    {
        $serviceName = $options['service'] ?? null;
        $key = $options['key'] ?? 'flysystem';
        $ttl = $options['ttl'] ?? null;

        $service = $this->getService($serviceName);
        return new Psr6Cache($service, $key, $ttl);
    }
}
