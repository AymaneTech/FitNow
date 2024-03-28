<?php

namespace Feature;

use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testUserDuplication(): void
    {
        $user1 = User::make([
            "name" => "aymane",
            "email" => "elmainiaymane@gmail.com",
        ]);
        $user2 = User::make([
            "name" => "yahya",
            "email" => "yahya@gmail.com",
        ]);

        $this->assertTrue($user1->email != $user2->email);
    }
    public function testUserRegister()
    {
        $userData = [
            'name' => 'aymane',
            'email' => Str::random(3) . 'aymane@gmail.com',
            'password' => '123',
            'password_confirmation' => '123',
        ];

        $response = $this->post('/api/register', $userData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'name' => $userData['name'],
            'email' => $userData['email'],
        ]);
    }

    public function testUserLogin()
    {
        $user = User::factory()->create();
        $response = $this->post("/api/login", [
            "email" => $user->email,
            "password" => "password",
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_type' => 'App\Models\User',
            'tokenable_id' => $user->id,
        ]);
    }
}
