<?php

namespace App\Http\Controllers;

use App\Actions\RegisterUserAction;
use App\Actions\UserLoginAction;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;

class UserAuthController extends Controller
{
    public function __construct(public UserAuthService $userAuthService){}

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $token = $this->userAuthService->register($request->validated());

        return response()->json(["message" => $token, 200]);
    }

    public function login(UserLoginRequest $request)
    {
        $token = $this->userAuthService->login($request);
        return response()->json(["message" => $token, 200]);
    }
}
