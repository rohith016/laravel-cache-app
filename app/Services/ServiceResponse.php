<?php

namespace App\Services;

class ServiceResponse{
    public $success;
    public $data;
    public $message;
    /**
     * __construct function
     *
     * @param [type] $success
     * @param [type] $data
     * @param [type] $message
     */
    public function __construct($success, $data = null, $message = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->message = $message;
    }
    /**
     * success function
     *
     * @param [type] $data
     * @param [type] $message
     * @return void
     */
    public static function success($data = null, $message = null) : ServiceResponse
    {
        return new self(true, $data, $message);
    }
    /**
     * error function
     *
     * @param [type] $message
     * @param [type] $data
     * @return void
     */
    public static function error($message, $data = null) : ServiceResponse
    {
        return new self(false, $data, $message);
    }

}