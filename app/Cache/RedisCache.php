<?php
namespace App\Cache;

use Illuminate\Support\Facades\Redis;

class RedisCache implements CacheInterface{
    /**
     * getKeyData function
     *
     * @param string $key
     * @return array
     */
    public function get(string $key): mixed
    {
        try {
            return Redis::get($key);
        } catch (\Throwable $th) {
            return [];
        }
    }
    /**
     * setKeyData function
     *
     * @param string $key
     * @param [type] $data
     * @param integer|null $exp
     * @return boolean
     */
    public function set(string $key, $data, int $exp = null): bool 
    {
        try {
            if ($exp) {
                Redis::setex($key, $exp, $data);
            }

            Redis::set($key, $data);
            
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
    /**
     * removeKey function
     *
     * @return void
     */
    public function delete(string $key): int
    {
        try {
            return Redis::del($key);
        } catch (\Throwable $th) {
            return 0;
        }
    }
    /**
     * exists function
     *
     * @param string $key
     * @return boolean
     */
    public function exists(string $key): bool
    {
        try {
            return Redis::exists($key);
        } catch (\Throwable $th) {
            return false;
        }
    }
    /**
     * expire function
     *
     * @param string $key
     * @param integer|null $exp
     * @return boolean
     */
    public function expire(string $key, int $exp = null): bool
    {
        try {
            return Redis::expire($key, $exp);
        } catch (\Throwable $th) {
            return false;
        }
    }
    /**
     * ttl function
     *
     * @param string $key
     * @return integer
     */
    public function ttl(string $key): int
    {
        try {
            return Redis::ttl($key);
        } catch (\Throwable $th) {
            //throw $th;
            return -1;
        }
    }
    /**
     * flushAll function
     *
     * @return boolean
     */
    public function flushAll(): bool
    {
        try {
            return Redis::flushAll();
        } catch (\Throwable $th) {
            // Handle the exception
            return false;
        }
    }
    /**
     * increment function
     *
     * @param string $key
     * @param integer $value
     * @return integer
     */
    public function increment(string $key, int $value = 1): int
    {
        try {
            return Redis::incrby($key, $value);
        } catch (\Throwable $th) {
            // Handle the exception
            return 0;
        }
    }
    /**
     * decrement function
     *
     * @param string $key
     * @param integer $value
     * @return integer
     */
    public function decrement(string $key, int $value = 1): int
    {
        try {
            return Redis::decrby($key, $value);
        } catch (\Throwable $th) {
            // Handle the exception
            return 0;
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
        try {
            return Redis::keys($pattern);
        } catch (\Throwable $th) {
            // Handle the exception
            return [];
        }
    }
}