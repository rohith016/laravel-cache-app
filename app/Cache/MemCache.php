<?php
namespace App\Cache;

use Illuminate\Support\Facades\Cache;

class MemCache implements CacheInterface{
    protected $memcache;

    public function __construct()
    {
        $this->memcache = Cache::store('memcached');
    }
    /**
     * Set a value in Memcache.
     *
     * @param string $key
     * @param mixed $value
     * @param int|null $expiration
     * @return bool
     */
    public function set(string $key, $value, int $expiration = null): bool
    {
        try {
            return $this->memcache->put($key, $value, $expiration);
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }

    /**
     * Get a value from Memcache.
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key) : array
    {
        try {
            return $this->memcache->get($key);
        } catch (\Throwable $th) {
            // Handle the exception
            return [];
        }
    }

    /**
     * Delete a key from Memcache.
     *
     * @param string $key
     * @return bool
     */
    public function delete(string $key): bool
    {
        try {
            return $this->memcache->forget($key);
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }

    /**
     * Check if a key exists in Memcache.
     *
     * @param string $key
     * @return bool
     */
    public function exists(string $key): bool
    {
        try {
            return $this->memcache->has($key);
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }

    /**
     * Set the expiration time for a key.
     *
     * @param string $key
     * @param int $expiration
     * @return bool
     */
    public function expire(string $key, int $expiration): bool
    {
        try {
            $value = $this->get($key);
            return $this->set($key, $value, $expiration);
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }

    /**
     * Increment a value in Memcache.
     *
     * @param string $key
     * @param int $value
     * @return int
     */
    public function increment(string $key, int $value = 1): int
    {
        try {
            return $this->memcache->increment($key, $value);
        } catch (\Throwable $th) {
            // Handle the exception
            return 0;
        }
    }

    /**
     * Decrement a value in Memcache.
     *
     * @param string $key
     * @param int $value
     * @return int
     */
    public function decrement(string $key, int $value = 1): int
    {
        try {
            return $this->memcache->decrement($key, $value);
        } catch (\Throwable $th) {
            // Handle the exception
            return 0;
        }
    }

    /**
     * Flush all keys in Memcache.
     *
     * @return bool
     */
    public function flushAll(): bool
    {
        try {
            return $this->memcache->flush();
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }
    /**
     * keys function
     *
     * @param string $pattern
     * @return array
     */
    public function keys(string $pattern): array
    {
        return [];
    }
    /**
     * ttl function
     *
     * @param string $key
     * @return integer
     */
    public function ttl(string $key): int
    {
       return 1;
    }
}