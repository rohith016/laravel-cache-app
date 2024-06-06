<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
class UserController extends Controller
{
    /**
     * __construct function
     *
     * @param UserService $service
     */
    public function __construct(public UserService $service){}
    /**
     * index function
     *
     * @param Request $request
     * @return array
     */
    public function getUsers(Request $request): mixed
    {
        $resultData = $this->service->getAllUsers($request -> ip ?? "127.0.0.1");
        return response()->json($resultData, 200);
    }
}
