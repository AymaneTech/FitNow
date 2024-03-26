<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserAuthService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class UserAuthController extends Controller
{
    public function __construct(public UserAuthService $userAuthService)
    {
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $token = $this->userAuthService->register($request->validated());

        return response()->json(["message" => $token, 200]);
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $token = $this->userAuthService->login($request);
        }catch (\Exception $e){
            return response()->json(["message" => "user not found", 200]);
        }
        return response()->json(["message" => $token, 200]);
    }
}
