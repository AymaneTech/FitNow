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
        $token = $user->createToken('test-token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->getJson("api/progress");

        $response->assertStatus(200);
    }

    public function testReturnOneProgress()
    {
        $token = "11|8jyyRRvbhGWvWhQQJYdkj8jET6z8hpWLoH1jEd279712b811";
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->get("api/progress/5");

        $response->assertStatus(200);
    }

    public function testUpdateProgres()
    {
        $token = "11|8jyyRRvbhGWvWhQQJYdkj8jET6z8hpWLoH1jEd279712b811";
        $dataArray = [
            "height" => "111111",
            "weight" => "111",
            "measurements" => json_encode(["chest_size" => "90", "waist_size" => "80"]),
            "performance" => json_encode(["workout_duration" => "30", "number_of_reps" => "10", "distance_covered" => "5000"])
        ];
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->patch("api/progress/5", $dataArray);

        $response->assertStatus(200);
    }

    public function testApiCreateProgress()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;
        $dataArray = [
            "height" => "111111",
            "weight" => "111",
            "measurements" => json_encode(["chest_size" => "90", "waist_size" => "80"]),
            "performance" => json_encode(["workout_duration" => "30", "number_of_reps" => "10", "distance_covered" => "5000"])
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->post("api/progress", $dataArray);

        $response->assertStatus(200);
    }

    public function testDeleteProgress()
    {
        $token = "11|8jyyRRvbhGWvWhQQJYdkj8jET6z8hpWLoH1jEd279712b811";
        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
            ->delete("api/progress/5");

        $response->assertStatus(200);
    }
}
