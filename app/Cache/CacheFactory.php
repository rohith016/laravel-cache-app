<?php
namespace App\Cache;

use App\Cache\MemCache;
use App\Cache\RedisCache;

class CacheFactory{
    public static function create($provider)
    {
        switch ($provider) {
            case 'redis':
                return new RedisCache();
            case 'memcache':
                return new MemCache();
            default:
                throw new \InvalidArgumentException("Invalid cache provider: $provider");
        }
    }
}