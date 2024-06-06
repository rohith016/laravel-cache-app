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
    public function getAllUsers($ip): array
    {
        try {
            $keyName = $ip . "-cached-users-lists";

            $checkCache = $this->cacheFactory->exists($keyName);
            if($checkCache){
                $userData = json_decode($this->cacheFactory->get($keyName), true);
            } else {
                $userData = User::all();
                if(count($userData) > 0){
                    $this->cacheFactory->set($keyName, $userData);
                }
            }

            return $userData;
        } catch (\Throwable $th) {
            // throw $th;
            return [];
        }
        
    }


    public static function test(){
        return "service called";
    }
}
