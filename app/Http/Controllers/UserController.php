<?php

namespace App\Http\Controllers;

use App\Dto\UserDto;
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
        $response  = $this->service->getAllUsers($request -> ip ?? "127.0.0.1");
        if ($response->success) {
            return response()->json([
                'status' => 'success',
                'data' => $response->data,
                'message' => $response->message,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $response->message,
                'data' => $response->data,
            ], 400);
        }
    }

    /**
     * Summary of createUser
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function createUser(Request $request){
        $userDTO = new UserDto(
            $request -> input('name'),
            $request -> input('email'),
            $request -> input('password'),
            $request -> input('phoneNumber'),
        );

        // $userDto = UserDto::toObject($request -> all());


        // dd($userDTO, $userDto);

        $user = $this->service->createUser($userDTO);

        return response()->json($user, 200);
    }
}
