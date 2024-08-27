<?php
namespace App\Services;

use App\Dto\UserDto;
use App\Models\User;
use App\Cache\CacheFactory;
use App\Services\ServiceResponse;

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
     * @param [type] $ip
     * @return ServiceResponse
     */
    public function getAllUsers($ip) : ServiceResponse
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

            return ServiceResponse::success($userData, 'Users retrived successfully');
        } catch (\Throwable $th) {
            return ServiceResponse::error('An error occurred: ' . $th->getMessage());
        }
        
    }
    /**
     * Summary of createUser
     * @param \App\Dto\UserDto $userDto
     * @return \App\Services\ServiceResponse
     */
    public function createUser(UserDto $userDto) : ServiceResponse
    {
        try {

            $user = new User();
            $user->name = $userDto->name;
            $user->email = $userDto->email;
            $user->password = $userDto->password;
            $user->phoneNumber = $userDto->phoneNumber;
            $user->save();

            return ServiceResponse::success($user, 'Users created successfully');

        } catch (\Throwable $th) {
            //throw $th;
            return ServiceResponse::error('An error occurred: ' . $th->getMessage());

        }
    }

    public function getUser($userId) : ServiceResponse
    {
        $user = User::find($userId);
        if(!$user)
            return ServiceResponse::error('Invalid User Request');

        $userData = UserDto::toArray($user);

        return ServiceResponse::success($userData, 'Users retrieved successfully');


    }
}
