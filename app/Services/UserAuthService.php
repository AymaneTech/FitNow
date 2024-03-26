<?php

namespace App\Services;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\InvalidEmailException;

class UserAuthService
{
    public function register($userInfo)
    {
        $user = User::create([
            "name" => $userInfo["name"],
            "email" => $userInfo["email"],
            "password" => Hash::make($userInfo["password"])
        ]);
        return $this->createToken($user);
    }
    public function login($credentials){
        if(! auth()->attempt($credentials->validated())){
            throw new InvalidEmailException("user not logged");
        }
        return $this->createToken($credentials->user());
    }

    private function createToken($user)
    {
        return $user->createToken($user->name. "-authToken")->plainTextToken;
    }
}
