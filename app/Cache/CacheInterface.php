<?php
namespace App\Cache;

interface CacheInterface{
    public function get(string $key);
    public function set(string $key, $data, int $exp = 0);
    public function delete(string $key);
    public function exists(string $key);
    public function expire(string $key, int $exp = null);
    public function ttl(string $key);
    public function flushAll();
    public function increment(string $key, int $value = 1);
    public function decrement(string $key, int $value = 1);
    public function keys(string $pattern);
}