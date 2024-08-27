<?php

namespace App\Dto;

use App\Models\User;
class UserDto{

    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $phoneNumber
    ){}
    /**
     * Summary of toArray
     * @param \App\Models\User $user
     * @return array
     */
    public static function toArray(User $user) : array
    {
        return [
            "name" => $user -> name,
            "email" => $user -> email,
            "phoneNumber" => $user -> phoneNumber,
        ];
    }
    /**
     * Summary of toObject
     * @param array $user
     * @return void
     */
    public static function toObject(array $user) : self
    {
        return new self(
            name: $user['name'],
            email: $user['email'],
            password: $user['password'],
            phoneNumber: $user['phoneNumber']
        );
    }

}