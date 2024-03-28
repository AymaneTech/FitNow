<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserAuthController extends BaseController
{
    public function __construct(public UserAuthService $userAuthService)
    {}

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $token = $this->userAuthService->register($request->validated());
        return $this->sendResponse("user registered successfully",  $token);
    }

    public function login(UserLoginRequest $request)
    {
        try {
            $token = $this->userAuthService->login($request);
        }catch (\Exception $e){
            return $this->sendError("user not found");
        }
        return $this->sendResponse("user logged ",$token);
    }

    public function logout(Request $request)
    {
        auth()->user("sanctum")->tokens()->delete();
        return $this->sendResponse("logout !");
    }
}
