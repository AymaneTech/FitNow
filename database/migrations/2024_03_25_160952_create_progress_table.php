<?php

use App\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->string("height");
            $table->string("weight");
//            this json gonna handle info like : chest size, waist size
            $table->json("measurements");
//             and this gonna handle info like : workout duration, number of reps, distance covered, etc.
            $table->json("performance");
            $table->foreignId("user_id")
                ->constrained("users");
            $table->string("status")->default(Status::UNCOMPLETED->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progress');
    }
};
