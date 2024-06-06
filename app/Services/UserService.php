<?php
namespace App\Services;

use App\Models\User;
use App\Cache\CacheFactory;

class UserService{
    /**
     * protected variable
     *
     * @var [type]
     */
    protected $cacheFactory;
    /**
     * __construct function
     *
     * @param CacheFactory $cacheFactory
     */
    public function __construct(CacheFactory $cacheFactory){
        $cacheType = config("cache.system_cache") ?? "redis";
        $this->cacheFactory = $cacheFactory::create($cacheType);
    }
    /**
     * getAllUsers function
     *
     * @param [type] $id
     * @return void
     */
    public function getAllUsers($ip) : mixed
    {
        try {
            $keyName = $ip . "-cached-users-lists";
            // check the cache value exist or not
            $checkCache = $this->cacheFactory->exists($keyName);

            if($checkCache){
                // if exist then get the data from cache
                $userData = json_decode($this->cacheFactory->get($keyName), true);
            } else {
                $userData = User::all();
                if(count($userData) > 0){
                    // if not exist create new entry and save the data
                    $this->cacheFactory->set($keyName, $userData);
                }
            }

            return $userData;
        } catch (\Throwable $th) {
            // throw $th;
            return null;
        }
        
    }


    public static function test(){
        return "service called";
    }
}
