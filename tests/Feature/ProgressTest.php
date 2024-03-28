<?php

namespace Feature;

use App\Models\User;
use Tests\TestCase;

class ProgressTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testApiReturnProgressList(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->getJson("api/progress");

        $response->assertStatus(200);
    }

    public function testReturnOneProgress()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->get("api/progress/5");

        $response->assertStatus(200);
    }

    public function testUpdateProgres()
    {
        $user = User::factory()->create();
        $dataArray = [
            "height" => "111111",
            "weight" => "111",
            "measurements" => json_encode(["chest_size" => "90", "waist_size" => "80"]),
            "performance" => json_encode(["workout_duration" => "30", "number_of_reps" => "10", "distance_covered" => "5000"])
        ];
        $response = $this->actingAs($user)
        ->patch("api/progress/5", $dataArray);

        $response->assertStatus(200);
    }

    public function testApiCreateProgress()
    {
        $user = User::factory()->create();
        $dataArray = [
            "height" => "111111",
            "weight" => "111",
            "measurements" => json_encode(["chest_size" => "90", "waist_size" => "80"]),
            "performance" => json_encode(["workout_duration" => "30", "number_of_reps" => "10", "distance_covered" => "5000"])
        ];

        $response = $this->actingAs($user)
            ->post("api/progress", $dataArray);

        $response->assertStatus(200);
    }

    public function testDeleteProgress()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->delete("api/progress/5");

        $response->assertStatus(200);
    }
}
