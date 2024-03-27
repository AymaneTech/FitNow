<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\UserAuthService;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class UserAuthController extends BaseController
{
    public function __construct(public UserAuthService $userAuthService)
    {
    }

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
}
